<?php

namespace App\Http\Controllers;

use App\Helpers\Wallet\Wallet;
use App\Models\Payment;
use App\Models\WalletTransaction;
use App\Services\V1\Payment\PaymentService;
use App\Services\V1\Payment\Saman;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class PaymentController
 * @package App\Http\Controllers
 *
 * this controller is used to handle online payments
 */
class PaymentController extends Controller
{
    /**
     * @param int $value
     * @return void
     */
    public function increase(int $value): void
    {
        $payment = new PaymentService();
        $payment->setGateway(new Saman());
        $payment->increase($value, Payment::TYPE_ONLINE);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function callbackFromBank(Request $request): RedirectResponse
    {
        $paymentService = new PaymentService();
        $paymentService->setGateway(new Saman());
        $payment = null;
        $respond = false;

        if (!is_null($request->RefNum)) {
            $payment = Payment::where('refnumber', $request->RefNum)->first();
        }

        if (is_null($payment)) {
            $payment = Payment::where('resnumber', $request->ResNum)->where('status', Payment::STATUSUNPAID)->first();
        }

        if ($payment) {
            $info = $request->toArray();
            $respond = $paymentService->confirm($payment, $info);
        }

        return redirect()->route('home');
    }
}
