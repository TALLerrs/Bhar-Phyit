<?php

namespace Tallerrs\BharPhyit\Trait;

use Tallerrs\BharPhyit\Enums\BharPhyitErrorLogStatus;
use Tallerrs\BharPhyit\Models\BharPhyitErrorLog;

trait BharPhyitAction
{
        /**
     * Solve And Unsolve function for BharPhyitErrorLog 
     * 
     * @param BharPhyitErrorLog  $bharPhyitId
     * 
     * @return void
     */
    public function solve(BharPhyitErrorLog $bharPhyitErrorLog): void
    {
        $bharPhyitErrorLog->update([
            'resolved_at' => $bharPhyitErrorLog->resolved_at ? null : now(),
            'status' => $bharPhyitErrorLog->resolved_at ? BharPhyitErrorLogStatus::READ : BharPhyitErrorLogStatus::RESOLVED,
        ]);
    }

    /**
     * Snooz 24 hours function
     * @param string $bharPhyitId
     * @return void
     */
    public function snooze(BharPhyitErrorLog $bharPhyitErrorLog): void
    {
        $bharPhyitErrorLog->update([
            'snooze_until' => $bharPhyitErrorLog->isSnoozed() ? null : now()->addDay(),
        ]);
    }  
}