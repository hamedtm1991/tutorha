<?php


namespace App\Services\V1\Payment;

use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PaymentService
{
    protected Gateway $gateway;

    /**
     * @param Gateway $gateway
     * @return void
     */
    public function setGateway(Gateway $gateway): void
    {
        $this->gateway = $gateway;
    }

    /**
     * @param int $value
     * @param string $type
     * @return bool|Payment
     */
    public function increase(int $value, string $type): bool|Payment
    {
        $resnumber = Str::random();

        $payment = Payment::create([
            'resnumber' => $resnumber,
            'price' => $value,
            'type' => $type,
            'status' => Payment::STATUSUNPAID,
            'user_id' => Auth::id(),
        ]);

        if ($payment) {
            return $payment;
        }

        return false;
    }

    /**
     * @param Payment $payment
     * @return mixed
     */
    public function confirm(Payment $payment): bool
    {
        return $this->gateway->confirm($payment);
    }

    /**
     * @param Payment $payment
     * @return mixed
     */
    public function reject(Payment $payment): bool
    {
        return $this->gateway->reject($payment);
    }
}
