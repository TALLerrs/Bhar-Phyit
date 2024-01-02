<?php

namespace Tallerrs\BharPhyit\Exceptions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Exceptions\Handler as ExceptionsHandler;
use Illuminate\Http\UploadedFile;
use Monolog\Handler\AbstractProcessingHandler;
use Spatie\LaravelIgnition\Recorders\QueryRecorder\QueryRecorder;
use Monolog\LogRecord;
use Tallerrs\BharPhyit\Enums\BharPhyitErrorLogStatus;
use Tallerrs\BharPhyit\Models\BharPhyitErrorLog;
use Throwable;

class BharPhyitHandler extends ExceptionsHandler
{
    public function report(Throwable $exception)
    {
        if ($this->shouldReport($exception)) {
            $this->storeBharPhyitErrorLog($exception);
        }

        parent::report($exception);
    }

    protected array $queries = [];

    protected function write(LogRecord $record): void
    {
        if (! config('bhar-phyit.enabled')) {
            return;
        }

        $exception = data_get($record, 'context.exception');

        if ($exception && $exception instanceof Throwable) {
            if ($this->isExceptException($exception)) {
                return;
            }

            $this->queries = app()->make(QueryRecorder::class)->getQueries();

            $this->storeBharPhyitErrorLog($exception);
        }
    }

    protected function storeBharPhyitErrorLog(Throwable $throwable): void
    {
        $unsolvedErrorLog = $this->getUnresolveErrorLog($throwable);

        if ($unsolvedErrorLog->isSnoozed()) {
            return;
        }

        $unsolvedErrorLog->details()->create([
            'payload' => json_encode($this->filterHidden($this->filterPayload(request()->all()))),
            'user_id' => auth()->id(),
            'user_type' => auth()->user() instanceof Model ? auth()->user()::class : null,
            'queries' => json_encode($this->queries),
            'headers' => json_encode($this->filterHidden(request()->header())),
        ]);

        $this->updateOccurence($unsolvedErrorLog);
    }

    protected function getUnresolveErrorLog(Throwable $throwable): BharPhyitErrorLog
    {
        $hash = $this->hashError($throwable);
        
        $errorRecord = BharPhyitErrorLog::query()
            ->where('hash', $hash)
            ->whereIn('status', BharPhyitErrorLogStatus::unresolveStatuses())
            ->first();

        if (empty($errorRecord)) {
            $errorRecord = BharPhyitErrorLog::create([
                'hash' => $hash,
                'title' => $throwable->getMessage(),
                'body' => json_encode($throwable->getTrace()),
                'url' => request()->fullUrl(),
                'line' => $throwable->getLine(),
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

    protected function hashError(Throwable $throwable): string
    {
        return hash('sha256', $throwable->getMessage() . $throwable->getLine() . request()->getRequestUri() . request()->method());
    }

    protected function updateOccurence(BharPhyitErrorLog $errorRecord): bool
    {
        return $errorRecord->update([
            'occurrences' => $errorRecord->occurrences + 1,
            'last_occurred_at' => now(),
        ]);
    }

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

        if (! array_key_exists($index, $fileLines)) {
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

    protected function isExceptException(Throwable $throwable): bool
    {
        return in_array(get_class($throwable), config('bhar-phyit.except', []));
    }
}