<?php

namespace App\Services\V1\Wallet;

use App\Models\Order;
use App\Notifications\V1\MailSystem;
use App\Notifications\V1\SmsSystem;
use App\Models\User;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WalletService
{
    private \App\Models\Wallet|null $wallet = null;
    private int|null $transaction_id = null;

    public string $type;
    public int $value;
    public string $detail;
    public string $status;
    public string|null $description = null;
    public int|null $orderId = null;
    public int|null $transferToId = null;
    public int|null $transferFromId = null;
    public int|null $userId = null;

    /**
     * @param $type
     * @param $detail
     * @param $status
     * @param null $userId
     * @param null $orderId
     */
    public function __construct($type, $detail, $status, $userId = null, $orderId = null)
    {
        $this->type = $type;
        $this->detail = $detail;
        $this->status = $status;
        $this->userId = $userId;
        $this->orderId = $orderId;
        $this->getWallet($this->userId);
    }

    /**
     * @return array
     */
    public function transaction(): array
    {
        $check = $this->check();
        if (!$check['status']) {
            return $check;
        }

        $walletTransaction = $this->newTransaction();
        $this->calculate();

        return DB::transaction(function () use ($walletTransaction) {
            if ($walletTransaction->save() && $this->wallet->save()) {
                if ($walletTransaction->status == WalletTransaction::STATUS_CONFIRMED) {
                    $message = $this->type == WalletTransaction::TYPE_INCREASE ? 'increaseConfirmation' : 'decreaseConfirmation';
//                    $this->notify($message, $this->wallet->user);
                }

                $this->transaction_id = $walletTransaction->id;
                return ['status' => true, 'transaction_id' => $this->transaction_id];
            }
            return ['status' => false, 'error' => __('general.somethingWrong')];
        });
    }

    /**
     * @param string $message
     * @param User|null $user
     * @return void
     */
    public function notify(string $message, User $user = null): void
    {
        $attributes = ['amount' => number_format($this->value), 'name' => User::nameOrMobile()];
//        $user->notify(new SmsSystem(__('sms.' . $message, $attributes), 'force'));
//        $user->notify(new MailSystem(__('email.' . $message, $attributes), 'force', __('email.' . $message . 'Subject')));
    }

    /**
     * @param int|null $userId
     * @return void
     */
    public function getWallet(int $userId = null): void
    {
        if ($userId) {
            $user = User::find($userId);
            if ($user && is_null($user->wallet)) {
                $this->wallet = $user->wallet()->create();
            } elseif ($user) {
                $this->wallet = \App\Models\Wallet::where('user_id', $user->id)->lockForUpdate()->first();
            }
        } else {
            $wallet = \App\Models\Wallet::where('user_id', Auth::id())->lockForUpdate()->first();
            if (is_null($wallet)) {
                $wallet = Auth::user()->wallet()->create();
            }

            $this->wallet = $wallet;
        }
    }

    /**
     * @return array
     */
    private function check(): array
    {
        if (!$this->wallet) {
            return ['status' => false, 'error' => 'Problem in wallet, please contact support'];
        }

        if (($this->type === WalletTransaction::TYPE_DECREASE && $this->wallet->value < $this->value)) {
            return ['status' => false, 'error' => __('general.notEnoughMoney')];
        }

        if ($this->orderId) {
            $order = Order::find($this->orderId);
            if ($order->status !== Order::STATUSRESERVED) {
                return ['status' => false, 'error' => 'Wrong order status'];
            }
        }

        return ['status' => true];
    }

    /**
     * @return string|null
     */
    private function confirmedBy(): string|null
    {
        $confirmedBy = null;

        if ($this->status === WalletTransaction::STATUS_CONFIRMED) {
            if ($this->detail === WalletTransaction::DETAIL_DECREASE_ADMIN ||
                $this->detail === WalletTransaction::DETAIL_INCREASE_ADMIN) {
                $confirmedBy = Auth::user()->mobile . ' - ' . Auth::id() . ' - ' . now();
            } else {
                $confirmedBy = Auth::user()->confirmedBy(true);
            }
        }

        return $confirmedBy;
    }

    /**
     * @return WalletTransaction
     */
    private function newTransaction(): WalletTransaction
    {
        $walletTransaction = new WalletTransaction();

        $walletTransaction->value = abs($this->value);
        $walletTransaction->type = $this->type;
        $walletTransaction->resnumber = WalletTransaction::walletTransactionNumber();
        $walletTransaction->wallet_id = $this->wallet->id;
        $walletTransaction->status = $this->status;
        $walletTransaction->detail = $this->detail;
        $walletTransaction->order_id = $this->orderId;
        $walletTransaction->confirmed_by = $this->confirmedBy();
        $walletTransaction->description = $this->description;
        $walletTransaction->transfer_from_id = is_null($this->transferFromId) ? null : Auth::id();
        $walletTransaction->transfer_to_id = $this->transferToId;
        $walletTransaction->sign = $walletTransaction->sign();

        return $walletTransaction;
    }

    /**
     * @return void
     */
    private function calculate(): void
    {
        if ($this->status == WalletTransaction::STATUS_CONFIRMED) {
            $this->wallet->value = $this->type == WalletTransaction::TYPE_INCREASE ? ($this->wallet->value + $this->value) : ($this->wallet->value - $this->value);
        }
    }
}
