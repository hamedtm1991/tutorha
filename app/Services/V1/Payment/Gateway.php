<?php

namespace App\Services\V1\Payment;

use App\Models\Payment;

interface Gateway
{
    const PAYMENT_TYPE = 'CardToCard';

    public function pay(int $price, string $resNumber, string $returnUrl): string;
    public function confirm(Payment $payment): bool;
    public function reject(Payment $payment): bool;
}
