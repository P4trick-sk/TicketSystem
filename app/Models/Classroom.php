<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Classroom extends Model
{
    use HasFactory;

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
        'name',
        'seats',
        'room_manager',
        'technical_manager',
        'updated_on',
        'status',
    ];

    public function roomManager() : BelongsTo
    {
        return $this->belongsTo(User::class, 'room_manager');
    }

    public function technicalManager() : BelongsTo
    {
        return $this->belongsTo(User::class, 'technical_manager');
    }
}
