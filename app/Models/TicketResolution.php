<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketResolution extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ticket_id',
        'was_successful',
        'resolution_description'
    ];

    /**
     * Get the ticket associated with the ticket resolution.
     */
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    /**
     * Get the user associated with the ticket resolution.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
