<?php

namespace Tallerrs\BharPhyit\Handler;

use Throwable;
use Illuminate\Http\UploadedFile;
use Tallerrs\BharPhyit\Models\BharPhyitErrorLog;
use Tallerrs\BharPhyit\Enums\BharPhyitErrorLogStatus;
use Spatie\LaravelIgnition\Recorders\QueryRecorder\QueryRecorder;
use Illuminate\Foundation\Exceptions\Handler as ExceptionsHandler;
use Illuminate\Support\Facades\Cache;

class BharPhyitHandler extends ExceptionsHandler
{
    /**
     * Queries recorded during the exception handling.
     * 
     * @var array
     */
    protected array $queries = [];

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
            $this->storeBharPhyitErrorLog($exception);
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
        if (((!config('bhar-phyit.enabled')) && $this->isExceptException($e))) {
            return false;
        } else {
            $hash = $this->hashError($e);

            $lock = Cache::lock($hash, 30);

            return $lock->get();
        }
    }
    
    /**
     * Store the exception in the BharPhyit error log.
     * 
     * @param \Throwable $throwable The exception to be stored.
     * 
     * @return void
     */
    protected function storeBharPhyitErrorLog(Throwable $throwable): void
    {
        $hash = $this->hashError($throwable);

        $unsolvedErrorLog = $this->getUnresolveErrorLog($throwable, $hash);

        if ($unsolvedErrorLog->isSnoozed()) {
            return;
        }

        $this->queries = app()->make(QueryRecorder::class)->getQueries();

        $unsolvedErrorLog->details()->create([
            'payload' => json_encode($this->filterHidden($this->filterPayload(request()->all()))),
            'user_id' => auth()->id(),
            'queries' => json_encode($this->queries),
            'headers' => json_encode($this->filterHidden(request()->header())),
        ]);

        $this->updateOccurence($unsolvedErrorLog);

        $this->sendNotifications($unsolvedErrorLog);
    }

    /**
     * Get BharPhyitErrorLog
     * 
     * @param \Throwable $throwable
     * @param string $hash
     * 
     * @return \Tallerrs\BharPhyit\Models\BharPhyitErrorLog
     */
    protected function getUnresolveErrorLog(Throwable $throwable, string $hash): BharPhyitErrorLog
    {
        $errorRecord = BharPhyitErrorLog::query()
            ->where('hash', $hash)
            ->whereIn('status', BharPhyitErrorLogStatus::unresolveStatuses())
            ->first();

        if (empty($errorRecord)) {
            $errorRecord = BharPhyitErrorLog::create([
                'hash' => $hash,
                'error_type' => get_class($throwable),
                'title' => $throwable->getMessage(),
                'body' => json_encode($throwable->getTrace()),
                'sql' => 1,//$this->formatSql($throwable),
                'url' => request()->fullUrl(),
                'line' => $throwable->getLine(),
                'file_path' => $throwable->getFile(),
                'error_code_lines' => json_encode(array_filter($this->getErrorCodeLines($throwable))),
                'method' => request()->method(),
                'occurrences' => 0,
                'status' => BharPhyitErrorLogStatus::UNREAD,
                'additionals' => json_encode([]),
                'last_occurred_at' => null,
            ]);
        }

        return $errorRecord;
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
     * Update Occurence
     * 
     * @param \Tallerrs\BharPhyit\Models\BharPhyitErrorLog $errorRecord
     * 
     * @return bool
     */
    protected function updateOccurence(BharPhyitErrorLog $errorRecord): bool
    {
        return $errorRecord->update([
            'occurrences' => $errorRecord->occurrences + 1,
            'last_occurred_at' => now(),
        ]);
    }

    /**
     * Summary of getErrorCodeLines
     * 
     * @param \Throwable $throwable
     * 
     * @return array
     */
    protected function getErrorCodeLines(Throwable $throwable): array
    {
        $errorCodeLines = [];
        $errorLine = $throwable->getLine();

        $beforeErrorLine = 10;

        $fileLines = file($throwable->getFile());

        if ($errorLine < $beforeErrorLine) {
            $beforeErrorLine = count($fileLines);
        }

        /**
         * Before = before error line + error line
         */
        for ($i = $beforeErrorLine; $i >= 0; $i--) {
            $errorCodeLines[] = $this->getLineInfo($fileLines, $errorLine, $i);
        }

        $afterErrorLine = 5;

        if (count($fileLines) < ($errorLine + $afterErrorLine)) {
            $afterErrorLine = count($fileLines) - $errorLine;
        }

        /**
         * After Error line
         */
        for ($i = 1; $i <= $afterErrorLine; $i++) {
            $errorCodeLines[] = $this->getLineInfo($fileLines, $errorLine, $i, false);
        }

        return $errorCodeLines;
    }

    protected function getLineInfo(array $fileLines, int $errorLine, $i, bool $beforeError = true): array
    {
        $currentLine = $beforeError ? $errorLine - $i : $errorLine + $i;

        $index = $currentLine - 1;

        if (!array_key_exists($index, $fileLines)) {
            return [];
        }

        return [
            'line_number' => $currentLine,
            'code' => $fileLines[$index],
            'is_error_line' => (bool) ($beforeError ? ($currentLine == $errorLine) : false),
        ];
    }

    protected function filterHidden(array $payload = []): array
    {
        collect($payload)->each(function ($value, $key) use (&$payload): void {
            if (is_array($value)) {
                $this->filterHidden($value);
            }

            if (in_array($key, config('bhar-phyit.hidden', []))) {
                $payload[$key] = '*****';
            }
        })->toArray();

        return $payload;
    }

    protected function filterPayload(array $payload = []): array
    {
        return collect($payload)->map(function ($value) {
            if ($this->shouldFilter($value)) {
                return '...';
            }

            return $value;
        })->toArray();
    }

    protected function shouldFilter(mixed $value): bool
    {
        return $value instanceof UploadedFile;
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
        return in_array(get_class($throwable), config('bhar-phyit.except', []));
    }

    /**
     * Send notifications for the given BharPhyit error log.
     *
     * @param BharPhyitErrorLog $bharPhyitErrorLog The error log to send notifications for.
     *
     * @return void
     */
    protected function sendNotifications(BharPhyitErrorLog $bharPhyitErrorLog): void
    {
        (new \Tallerrs\BharPhyit\Notifications\ExceptionNotification())
            ->setNotificationChannels($this->enableReportChannels())
            ->send($bharPhyitErrorLog);
    }

      /**
     * Get the list of enabled report channels.
     *
     * @return array The list of enabled report channels.
     */
    protected function enableReportChannels(): array
    {
        return collect(config('bhar-phyit.channels'))->where('enabled',true)->keys()->toArray();
    }

    /**
     * to format sql and use it to show in Bhar Phyit Detail
     * 
     * @param \Throwable $throwable
     * @return ?string
     */
    protected function formatSql(Throwable $throwable): ?string
    {
        $sql = $throwable->getSql();

        // Get the actual values used in the query
        $bindings = $throwable->getBindings();

        // Combine SQL and values
        return vsprintf(str_replace('?', "'%s'", $sql), $bindings);
    }
}