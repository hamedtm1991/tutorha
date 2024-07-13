<?php

namespace App\Services\V1\Wallet;

use App\Models\Episode;
use App\Models\Payment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Collection transfer(int $value, int $transferToId);
 * @method static Collection rejectTransfer(int $transactionId, string $message);
 * @method static Collection confirmTransfer(int $transactionId);
 * @method static Collection cardToCard(Payment $payment);
 * @method static Collection increaseByAdmin(int $value, int $userId, string $message);
 * @method static Collection decreaseByAdmin(int $value, int $userId, string $message);
 * @method static Collection increaseByBank(Payment $payment);
 * @method static Collection pay();
 * @method static Collection payWithoutCart(Episode $episode);
 */
class Wallet extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'wallet';
    }
}
