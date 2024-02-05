<?php

namespace Tallerrs\BharPhyit\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Tallerrs\BharPhyit\Models\BharPhyitErrorLog;
use Tallerrs\BharPhyit\Services\BharPhyitService;
use Throwable;

class BharPhyitSentNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected $notification,
        protected BharPhyitErrorLog $bharPhyitErrorLog
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
        (new $this->notification($this->bharPhyitErrorLog))->sendNotifications();
    }
}