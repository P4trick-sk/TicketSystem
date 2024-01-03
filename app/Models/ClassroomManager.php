<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassroomManager extends Model
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
        'classroom_id',
        'category_type_id',
        'assigned_to',
        'updated_on',
        'status',
    ];

    public function assignedTo() : BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function classroom() : BelongsTo
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }

    public function categoryType() : BelongsTo
    {
        return $this->belongsTo(CategoryType::class, 'category_type_id');
    }
}
