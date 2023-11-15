<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketResponse extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ticket_response';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ticket_id',
        'response_by',
        'response',
        'updated_on',
        'is_seen',
        'status'
    ];

    public function responseBy() :BelongsTo
    {
        return $this->belongsTo(User::class, 'response_by');
    }

    public function ticket() :BelongsTo
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class, 'response_by');
    }
}
