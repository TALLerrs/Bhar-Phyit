<?php

namespace Tallerrs\BharPhyit\Services;

use Throwable;
use Illuminate\Http\UploadedFile;
use Tallerrs\BharPhyit\Models\BharPhyitErrorLog;
use Tallerrs\BharPhyit\Enums\BharPhyitErrorLogStatus;
use Spatie\LaravelIgnition\Recorders\QueryRecorder\QueryRecorder;

class BharPhyitService
{
    /**
     * Queries recorded during the exception handling.
     * 
     * @var array
     */
    protected array $queries = [];

    /**
     * Store the exception in the BharPhyit error log.
     * 
     * @param \Throwable $throwable The exception to be stored.
     * @param string $hash Hashed String Base On $throwable
     * 
     * @return void
     */
    public function storeBharPhyitErrorLog(Throwable $throwable, string $hash, array $queries): void
    {
        $unsolvedErrorLog = $this->getUnresolveErrorLog($throwable, $hash);

        if ($unsolvedErrorLog->isSnoozed()) {
            return;
        }

        $this->queries = $queries;

        $this->storeBharPhyitDetails($unsolvedErrorLog);

        $this->updateOccurence($unsolvedErrorLog);

        $this->sendNotifications($unsolvedErrorLog);
    }

    /**
     * Store BharPhyit Detail
     * 
     * @param \Tallerrs\BharPhyit\Models\BharPhyitErrorLog $bharPhyitErrorLog
     * 
     * @return void
     */
    protected function storeBharPhyitDetails(BharPhyitErrorLog $bharPhyitErrorLog): void
    {
        $bharPhyitErrorLog->details()->create([
            'payload' => json_encode($this->filterHidden($this->filterPayload(request()->all()))),
            'user_id' => auth()->id(),
            'queries' => json_encode($this->queries),
            'headers' => json_encode($this->filterHidden(request()->header())),
        ]);
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
                'sql' => $this->formatSql($throwable),
                'url' => request()->fullUrl(),
                'line' => $throwable->getLine(),
                'file_path' => $throwable->getFile(),
                'error_code_lines' => json_encode($this->getErrorCodeLines($throwable)),
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

        return array_filter($errorCodeLines);
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

    /**
     * Filter sensitive data from payload
     * 
     * @param array $payload
     * 
     * @return array
     */
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

    /**
     * Filtering and transforming the payload
     * 
     * @param array $payload
     * 
     * @return array
     */
    protected function filterPayload(array $payload = []): array
    {
        return collect($payload)->map(function ($key, $value) {
            if ($this->shouldFilter($key, $value)) {
                return '...';
            }

            return $value;
        })->toArray();
    }

    /**
     * Check Value is UploadedFile
     * 
     * @param mixed $value
     * 
     * @return bool
     */
    protected function shouldFilter(mixed $key, mixed $value): bool
    {
        return (
            $value instanceof UploadedFile &&
            in_array($key, config('bhar-phyit.hidden', []))
        );
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
        if($throwable instanceof \Illuminate\Database\QueryException) {
            $sql = $throwable->getSql();
    
            // Get the actual values used in the query
            $bindings = $throwable->getBindings();
    
            // Combine SQL and values
            return vsprintf(str_replace('?', "'%s'", $sql), $bindings);
        }
        return null;
    }
}