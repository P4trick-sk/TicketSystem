<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ticket extends Model
{
    /** @use HasFactory<\Database\Factories\TicketFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'subject',
        'description',
        'category_id',
        'custom_data',
        'priority',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'custom_data' => 'array',
        ];
    }

    /**
     * Scope a query to only include completed tickets.
     */
    public function scopeCompleted(Builder $query): void
    {
        $query->where('is_completed', true);
    }

    /**
     * Get user who created the ticket.
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the ticket category.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the messages for the ticket.
     */
    public function messages(): HasMany
    {
        return $this->hasMany(TicketMessage::class);
    }

    /**
     * Get the activities for the ticket.
     */
    public function activities(): HasMany
    {
        return $this->hasMany(TicketActivity::class);
    }

    /**
     * Get the ticket resolution.
     */
    public function resolution(): HasOne
    {
        return $this->hasOne(TicketResolution::class);
    }

    /**
     * Get users assigned to the ticket
     * */
    public function assignees(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withTimestamps();
    }
}
