<?php

namespace Tallerrs\BharPhyit\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BharPhyitErrorLogDetail extends BharPhyitBaseModel
{
    protected $fillable = [
        'bhar_phyit_error_log_id',
        'payload',
        'queries',
        'headers',
        'user_type',
        'user_id'
    ];

    /**
     * relations
     */
    public function bharPhyitErrorLog(): BelongsTo
    {
        return $this->belongsTo(BharPhyitErrorLog::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * value retreive function
     */
    public function getHeaders()
    {
        return json_decode($this->headers);
    }

    public function getPayload()
    {
        return $this->payload;
    }

    public function getQueries()
    {
        $queries = json_decode($this->queries);

        foreach($queries as $query) {
            $sql = $query->sql;
            foreach($query->bindings as $binding) {
                $sql = preg_replace('/\?/', "'$binding'", $sql, 1);
            }
            $query->sql = $sql;
        }

        return $queries;
    }
}
