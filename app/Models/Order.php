<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Order extends Model
{
    const STATUSCANCELED = 'canceled';
    const STATUSRECEIVED = 'received';
    const STATUSPOSTED = 'posted';
    const STATUSPREPARATION = 'preparation';
    const STATUSPAID = 'paid';
    const STATUSRESERVED = 'reserved';
    const STATUSUNPAID = 'unpaid';

    use HasFactory;

    protected $fillable = ['status' , 'price' ,'tracking_serial', 'type', 'store', 'total_price', 'total_discount',
        'from_wallet', 'discount_id', 'sale_id', 'comment', 'total_sale', 'sale_id'];

    /**
     * @return mixed
     */
    public function user(): mixed
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    /**
     * @return MorphToMany
     */
    public function products(): MorphToMany
    {
        return $this->morphedByMany(Product::class, 'orderable')->withPivot('quantity', 'discount', 'price');
    }

    /**
     * @return MorphToMany
     */
    public function episodes(): MorphToMany
    {
        return $this->morphedByMany(Episode::class, 'orderable')->withPivot('quantity', 'discount', 'price');
    }

    /**
     * @return HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * @return HasOne
     */
    public function transaction(): HasOne
    {
        return $this->hasOne(WalletTransaction::class);
    }
}
