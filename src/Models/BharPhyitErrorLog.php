<?php

namespace Tallerrs\BharPhyit\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BharPhyitErrorLog extends BharPhyitBaseModel
{
    protected $fillable = [
        'hash',
        'error_type',
        'title',
        'body',
        'sql',
        'url',
        'method',
        'file_path',
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
    public function details(): HasMany
    {
        return $this->hasMany(BharPhyitErrorLogDetail::class);
    }

    public function detail(): HasOne
    {
        return $this->hasOne(BharPhyitErrorLogDetail::class)->orderBy('created_at');
    }

    /**
     * Check Error is snooze or not
     * 
     * @return bool
     */
    public function isSnoozed(): bool
    {
        return (bool) ($this->snooze_until && now()->lte($this->snooze_until));
    }

    /**
     * value retreive function
     */
    public function getErrorType(): string
    {
        return $this->error_type;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getSql(): string
    {
        return $this->sql;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getLine(): string|int
    {
        return $this->line;
    }

    public function getErrorCodeLine(): string
    {
        return $this->error_code_lines;
    }

    public function getResolvedAt(): string
    {
        return $this->resolved_at->dtString();
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getAdditionals(): array
    {
        return $this->additionals;
    }

    public function getSnoozeUntil(): string
    {
        return $this->snooze_until->dtString();
    }

    public function getOccurences(): string
    {
        return $this->occurrences;
    }

    public function getLastOccuredAt(): string
    {
        return $this->last_occurred_at->dtString();
    }
}
