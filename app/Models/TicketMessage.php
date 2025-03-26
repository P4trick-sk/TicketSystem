<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketMessage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ticket_id',
        'user_id',
        'message',
        'attachments',
    ];

    /**
     * Get the ticket associated with the ticket message.
     */
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    /**
     * Get the user associated with the ticket message.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
