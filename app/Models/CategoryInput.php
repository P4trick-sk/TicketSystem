<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CategoryInput extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'field_name',
        'field_type',
        'options',
        'is_required',
    ];

    protected function casts()
    {
        return [
            'options' => 'array', // Cast options to an array
            'is_required' => 'boolean', // Cast is_required to a boolean
        ];
    }

    /**
     * Get the category associated with the input.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
