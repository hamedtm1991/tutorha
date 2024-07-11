<?php

namespace App\Services\V1\Payment;

use App\Models\Payment;

interface Gateway
{
    public function pay(int $price, string $resNumber, string $returnUrl): void;
    public function confirm(Payment $payment, array $info): bool;
    public function reject(Payment $payment): bool;
}
