<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class WalletTransaction extends Model
{
    use HasFactory;

    const TYPE_INCREASE = 'increase';
    const TYPE_DECREASE = 'decrease';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_REJECTED = 'rejected';
    const STATUS_PENDING = 'pending';
    const DETAIL_INCREASE_ADMIN = 'increase_admin';
    const DETAIL_INCREASE_ONLINE = 'increase_online';
    const DETAIL_INCREASE_CARD = 'increase_card';
    const DETAIL_INCREASE_TRANSFER = 'increase_transfer';
    const DETAIL_DECREASE_ADMIN = 'decrease_admin';
    const DETAIL_DECREASE_PURCHASE = 'decrease_purchase';
    const DETAIL_DECREASE_TRANSFER = 'decrease_transfer';
    const ERROR_VALUE = 'error_value';

    /**
     * @return BelongsTo
     */
    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    /**
     * @return BelongsTo
     */
    public function transferFrom(): BelongsTo
    {
        return  $this->belongsTo(User::class, 'transfer_from_id');
    }

    /**
     * @return BelongsTo
     */
    public function transferTo(): BelongsTo
    {
        return  $this->belongsTo(User::class, 'transfer_to_id');
    }

    /**
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return  $this->belongsTo(Order::class);
    }

    /**
     * @return string
     */
    public static function walletTransactionNumber(): string
    {
        return time() . Str::random('8');
    }

    /**
     * @return string
     */
    public function sign(): string
    {
        return bcrypt(md5($this->makeSign()));
    }

    /**
     * @return bool
     */
    public function checkSign(): bool
    {
        return Hash::check(md5($this->makeSign()), $this->sign);
    }

    /**
     * @return string
     */
    private function makeSign(): string
    {
        $orderable_id = null;
        if ($this->order_id) {
            $order = Order::where('id', $this->order_id)->first();
            $orderable_id = $order->products->pluck('id')->implode('-');
        }

        return env('SIGN_SECRET_KEY')
            . $this->id
            . $this->wallet_id
            . $this->type
            . $this->resnumber
            . $this->refnumber
            . $this->value
            . $this->confirmed_by
            . $this->description
            . $this->detail
            . $this->created_at
            . $orderable_id;
    }
}
