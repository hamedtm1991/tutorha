<?php

namespace App\Services\V1\Wallet;

use App\Models\Order;
use App\Models\WalletTransaction;
use App\Models\Warehouse;
use App\Services\V1\Cart\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PayBuilder implements Builder
{
    private WalletService $walletService;

    /**
     * @param array $data
     * @return array
     */
    public function execute(array $data): array
    {
        $order = $data['order'];
        $this->walletService = new WalletService(
            WalletTransaction::TYPE_DECREASE,
            WalletTransaction::DETAIL_DECREASE_PURCHASE,
            WalletTransaction::STATUS_CONFIRMED,
            null,
            $order->id
        );

        $this->walletService->value = $data['value'];
        $wallet = Auth::user()->wallet;

        if (!$wallet || $wallet->value < $order->final_price) {
            $order->status = Order::STATUSCANCELED;
            $order->save();
            return empty($wallet) ?
                ['status' => false, 'error' => 'Problem with wallet please contact support'] :
                ['status' => false, 'error' => __('general.notEnoughMoney')];
        }

        return DB::transaction(function () use ($order) {
            if ($this->walletService->transaction()['status']) {
                $order->status = Order::STATUSPAID;
                if ($order->save()) {
                    foreach ($order->products as $product) {
                        $warehouse = Warehouse::where('product_id', $product->id)->lockForUpdate()->first();
                        if ($warehouse) {
                            $warehouse->count -= $product->pivot->quantity;
                            $warehouse->save();
                        }
                    }

//                    $this->walletService->notify('coursePaid', $order->user);
                    Cart::instance('esaj')->flush();
                    return ['status' => true];
                }
            }

            return ['status' => false, 'error' => __('general.somethingWrong')];
        });
    }
}
