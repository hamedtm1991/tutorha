<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    const STATUSCANCELED = 'canceled';
    const STATUSPAID = 'paid';
    const STATUSUNPAID = 'unpaid';
    const STATUSREJECT = 'reject';
    Const BANKSTATEOK = 'OK';
    Const BANKSTATECANCELED = 'canceled';

    const TYPE_ONLINE = 'online';
    const TYPE_CARD = 'card';

    use HasFactory;



    protected $fillable = ['resnumber', 'price', 'status', 'state', 'type', 'confirmed_by', 'user_id'];

    /**
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return BelongsTo
     */
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(WalletTransaction::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
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
            . $this->order_id
            . $this->price
            . $this->resnumber
            . $this->refnumber
            . $this->type
            . $this->status
            . $this->bank_name
            . $this->bank_info
            . $this->created_at
            . $orderable_id;
    }
}
