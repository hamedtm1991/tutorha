<?php


namespace App\Services\V1\Payment;

use App\Models\Payment;
use App\Models\User;
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
     * @param string $mobile
     * @param string|null $returnUrl
     * @return mixed
     */
    public function increase(int $value, string $type, string $mobile = '', string $returnUrl = null): mixed
    {
        $resnumber = Str::random();

        $payment = Payment::create([
            'resnumber' => $resnumber,
            'price' => $value,
            'type' => $type,
            'status' => Payment::STATUSUNPAID,
            'user_id' => Auth::id(),
            'return_url' => $returnUrl
        ]);

        $returnUrl = route('callback');
        $response = $this->gateway->pay($value, $resnumber, $returnUrl);

        if ($response) {
            return $response;
        } elseif ($payment) {
            return $payment;
        }

        return false;
    }

    /**
     * @param Payment $payment
     * @param array|null $info
     * @return mixed
     */
    public function confirm(Payment $payment, array $info = null): bool
    {
        return $this->gateway->confirm($payment, $info);
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
