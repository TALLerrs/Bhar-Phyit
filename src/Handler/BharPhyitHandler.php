<?php

namespace Tallerrs\BharPhyit\Handler;

use Throwable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Tallerrs\BharPhyit\Jobs\BharPhyitReporter;
use Illuminate\Foundation\Exceptions\Handler as ExceptionsHandler;
use Spatie\LaravelIgnition\Recorders\QueryRecorder\QueryRecorder;

class BharPhyitHandler extends ExceptionsHandler
{
    /**
     * Hashed String Base On $throwable
     * 
     * @var string
     */
    protected string $hash;

    /**
     * Report the exception and store it in the BharPhyit error log.
     *
     * @param \Throwable $exception The exception to be reported.
     *
     * @return void
     */
    public function report(Throwable $exception)
    {
        if ($this->shouldReport($exception)) {
            $queries = app()->make(QueryRecorder::class)->getQueries();
            BharPhyitReporter::dispatch($exception, $this->hash, $queries);
        }

        parent::report($exception);
    }

    /**
     * Determine if the exception should be reported.
     *
     * @param  \Throwable  $e
     * 
     * @return bool
     */
    public function shouldReport(Throwable $e)
    {
        if ((!config('bhar-phyit.enabled')) && $this->isExceptException($e)) {
            return false;
        } else {
            $this->hash = $this->hashError($e);

            $lock = Cache::lock($this->hash, 30);

            return $lock->get();
        }
    }

    /**
     * Generate Hashed String Base On $throwable
     * 
     * @param \Throwable $throwable
     * 
     * @return string
     */
    protected function hashError(Throwable $throwable): string
    {
        return hash('sha256', $throwable->getMessage() . $throwable->getLine() . request()->getRequestUri() . request()->method());
    }

    /**
     * 
     * check error is include in config except
     * 
     * @param \Throwable $throwable
     * @return bool
     * 
     */
    protected function isExceptException(Throwable $throwable): bool
    {
        $dontReport = array_merge(config('bhar-phyit.except', []), $this->internalDontReport);

        if (! is_null(Arr::first($dontReport, fn ($type) => $throwable instanceof $type))) {
            return true;
        }

        return false;
    }
}
