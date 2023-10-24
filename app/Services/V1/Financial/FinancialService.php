<?php

namespace App\Services\V1\Financial;

use App\Models\Episode;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FinancialService
{
    /**
     * @param string $status
     * @param string $store
     * @param Episode|null $episode
     * @param Product|null $product
     * @return Order|null
     */
    public function createOrder(string $status = Order::STATUSRESERVED, string $store = 'esaj', Episode $episode = null, Product $product = null): bool|Order
    {
        if ($episode) {
            $price = $episode->price;
            $finalPrice = $episode->price;
            $totalDiscount = 0;
            $discountId = null;
            $totalSale = 0;
            $saleId = null;
            $orderItems['product'][$episode->id] = ['quantity' => 1, 'discount' => 0, 'price' => $price];
        } elseif($product) {
            $price = $product->price;
            $finalPrice = $product->price;
            $totalDiscount = 0;
            $discountId = null;
            $totalSale = 0;
            $saleId = null;
            $orderItems['product'][$product->id] = ['quantity' => 1, 'discount' => 0, 'price' => $product->price];
        } else {
            $cart = \App\Services\V1\Cart\Cart::instance('tuturha');
            $checkout = $cart->all(true);

            if (!$checkout) {
                return false;
            }

            $price = $checkout['price'];
            $finalPrice = $checkout['finalPrice'];
            $totalDiscount = $checkout['totalDiscount'];
            $discountId = $checkout['discountId'];
            $totalSale = $checkout['totalSale'];
            $saleId = $checkout['saleId'];
            $orderItems = $checkout['orderItems'];
        }

        $order = new Order();
        $order->user_id = Auth::id();
        $order->status = $status;
        $order->store = $store;
        $order->price = $price;
        $order->final_price = $finalPrice;
        $order->total_discount = $totalDiscount;
        $order->discount_id = $discountId;
        $order->total_sale = $totalSale;
        $order->sale_id = $saleId;

        return DB::transaction(function () use ($order, $orderItems, $episode) {
            if ($order->save()) {
                if ($episode) {
                    $order->episodes()->sync($orderItems['product']);
                } else {
                    $order->products()->sync($orderItems['product']);
                }
                return $order;
            }

            return false;
        });
    }
}
