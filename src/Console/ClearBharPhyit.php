<?php

namespace Tallerrs\BharPhyit\Console;

use Illuminate\Console\Command;
use Tallerrs\BharPhyit\Models\BharPhyitErrorLog;
use Tallerrs\BharPhyit\Models\BharPhyitErrorLogDetail;

class ClearBharPhyit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:bhar-phyit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear All Data of Bhar Phyit Logs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        BharPhyitErrorLog::truncate();
        BharPhyitErrorLogDetail::truncate();
    }
}
