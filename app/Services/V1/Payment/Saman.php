<?php

namespace App\Services\V1\Payment;

use App\Models\Payment;
use App\Notifications\V1\MailSystem;
use App\Notifications\V1\SmsSystem;
use App\Services\V1\Wallet\Wallet;
use Illuminate\Support\Facades\DB;
use SoapClient;
use SoapFault;

class Saman implements Gateway
{
    /**
     * @param int $price
     * @param string $resnumber
     * @param string $returnUrl
     * @return void
     */
    public function pay(int $price, string $resnumber, string $returnUrl): void
    {
        $client = new soapclient('https://sep.shaparak.ir/Payments/InitPayment.asmx?WSDL');
        $token = $client->RequestToken(env('SEP_MERCHANT_ID'),			/// MID
            $resnumber, 		/// ResNum
//            (int) ($price . 0) 	/// TotalAmount In Rials
            $price . 0
            ,'0'			/// Optional
            ,'0'			/// Optional
            ,'0'			/// Optional
            ,'0'			/// Optional
            ,'0'			/// Optional
            ,'0'			/// Optional
            ,'ResNum1'		/// Optional
            ,'ResNum2'		/// Optional
            ,'0'			/// Optional
            ,$returnUrl //$RedirectURL	/// Optional
        );

        echo "<form action='https://sep.shaparak.ir/payment.aspx' id='samanBank' method='POST'>
				<input name='token' type='hidden' value='".$token."'>
				<input name='RedirectURL' type='hidden' value='$returnUrl'>
				<input name='btn' type='submit' value='Send' style='display: none'>
			</form>";

        echo "<script type=\"text/javascript\">
                window.onload=function(){
                    document.forms['samanBank'].submit();
                }
                </script>";

        echo 'در حال اتصال به درگاه بانک سامان ...';
    }

    /**
     * @param Payment $payment
     * @param array $info
     * @return bool
     * @throws SoapFault
     */
    public function confirm(Payment $payment, array $info): bool
    {
        $payment->refnumber = $info['RefNum'];
        $payment->bank_name = 'Saman';
        $payment->bank_info = json_encode($info, true);

        if($info['State'] === Payment::BANKSTATEOK)
        {
            $Verify_URL='https://sep.shaparak.ir/payments/referencepayment.asmx?WSDL';

            $client = new soapclient($Verify_URL);
            $res =  $client->verifyTransaction($info['RefNum'] ,env('SEP_MERCHANT_ID'));#reference number and seller id

            if( $res <= 0 )
            {
                return true;
            } else {
                $payment->status = Payment::STATUSPAID;
                $payment->sign = $payment->sign();
                $payment->confirmed_by = 'system';

                return DB::transaction(function () use ($payment) {
                    if ($payment->save()) {
                        $response = Wallet::increaseByBank($payment);
                        if ($response['status']) {
                            $payment->transaction_id = $response['transaction_id'];
                            $payment->save();
                            return true;
                        }
                    }
                    return false;
                });
            }
        } else {
            $payment->status = Payment::STATUSREJECT;
            if ($payment->save()) {
                $payment->user->notify(new SmsSystem(__('sms.paymentFailure'), 'force'));
                $payment->user->notify(new MailSystem(__('email.onlinePurchaseFailed'), 'force'));
            }
        }

        return false;
    }

    public function reject(Payment $payment): bool
    {
        // TODO: Implement reject() method.
    }
}
