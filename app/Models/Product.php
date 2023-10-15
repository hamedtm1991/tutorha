<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Product extends Model
{
    use HasFactory;

    const LEVEL_BEGINNER = 'beginner';
    const LEVEL_INTERMEDIATE = 'intermediate';
    const LEVEL_ADVANCED = 'advanced';

    protected $casts = [
        'options' => 'array',
    ];

    /**
     * @return MorphToMany
     */
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * @return BelongsToMany
     */
    public function tutors(): BelongsToMany
    {
        return $this->belongsToMany(Tutor::class);
    }

    /**
     * @return HasMany
     */
    public function episodes(): HasMany
    {
        return $this->hasMany(Episode::class);
    }
}
