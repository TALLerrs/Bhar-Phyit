<?php

namespace Tallerrs\BharPhyit\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class BharPhyitErrorLog extends BharPhyitBaseModel
{
    protected $fillable = [
        'hash',
        'title',
        'body',
        'url',
        'method',
        'line',
        'error_code_lines',
        'resolved_at',
        'status',
        'additionals',
        'snooze_until',
        'occurrences',
        'last_occurred_at',
    ];

    protected $casts = [
        'resolved_at' => 'datetime',
        'snooze_until' => 'datetime',
        'last_occurred_at' => 'datetime',
    ];

    /**
     * relations
     */
    public function bharPhyitErrorLogDetails(): HasMany
    {
        return $this->hasMany(BharPhyitErrorLogDetail::class);
    }
}
