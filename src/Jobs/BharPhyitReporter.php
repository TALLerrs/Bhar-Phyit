<?php

namespace Tallerrs\BharPhyit\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\LaravelIgnition\Recorders\QueryRecorder\QueryRecorder;
use Tallerrs\BharPhyit\Services\BharPhyitService;
use Throwable;

class BharPhyitReporter implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected Throwable $throwable,
        protected string $hash,
        protected array $queries
    )
    {
        //
    }

    /**
     * Execute the job.
     * @param Throwable $throwable
     * 
     * @return void
     */
    public function handle(): void
    {
        (new BharPhyitService())->storeBharPhyitErrorLog(
            throwable: $this->throwable,
            hash : $this->hash,
            queries: $this->queries,
        );
    }
}