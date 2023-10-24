<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\Auth;

class Episode extends Model
{
    use HasFactory;

    protected $casts = [
        'links' => 'array',
    ];

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return MorphToMany
     */
    public function orders(): MorphToMany
    {
        return $this->morphToMany(Order::class, 'orderable');
    }

    /**
     * @return bool
     */
    public function checkOrder(): bool
    {
        if (!Auth::check()) {
            return false;
        }

        return !! $this->orders->where('user_id', Auth::id())->where('status', Order::STATUSPAID)->first();
    }
}
