<?php

namespace Tallerrs\BharPhyit\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BharPhyitErrorLogDetail extends BharPhyitBaseModel
{
    protected $fillable = [
        'bhar_phyit_error_log_id',
        'payload',
        'queries',
        'headers',
    ];

    /**
     * relations
     */
    public function bharPhyitErrorLog(): BelongsTo
    {
        return $this->belongsTo(BharPhyitErrorLog::class);
    }
}
