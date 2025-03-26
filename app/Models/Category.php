<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'parent_id',
    ];

    /**
     * Get the parent category of a category.
     */
    public function parentCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the inputs for the category.
     */
    public function inputs(): HasMany
    {
        return $this->hasMany(CategoryInput::class);
    }
}
