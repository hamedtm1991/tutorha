<?php

namespace App\Services\V1\Wallet;

use App\Models\Delivery;
use App\Models\Episode;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Services\V1\Financial\Financial;

class Director
{
    private Builder $transfer;
    private Builder $rejectTransfer;
    private Builder $confirmTransfer;
    private Builder $cardToCard;
    private Builder $increaseByAdmin;
    private Builder $decreaseByAdmin;
    private Builder $pay;
    private Builder $payWithoutCart;

    /**
     * @param Builder $transfer
     * @param Builder $rejectTransfer
     * @param Builder $confirmTransfer
     * @param Builder $cardToCard
     * @param Builder $increaseByAdmin
     * @param Builder $decreaseByAdmin
     * @param Builder $pay
     */
    public function __construct(Builder $transfer,
                                Builder $rejectTransfer,
                                Builder $confirmTransfer,
                                Builder $cardToCard,
                                Builder $increaseByAdmin,
                                Builder $decreaseByAdmin,
                                Builder $pay,
                                Builder $payWithoutCart,
                                ) {
        $this->transfer = $transfer;
        $this->rejectTransfer = $rejectTransfer;
        $this->confirmTransfer = $confirmTransfer;
        $this->cardToCard = $cardToCard;
        $this->increaseByAdmin = $increaseByAdmin;
        $this->decreaseByAdmin = $decreaseByAdmin;
        $this->pay = $pay;
        $this->payWithoutCart = $payWithoutCart;
    }

    /**
     * @param int $value
     * @param int $transferToId
     * @return array
     */
    public function transfer(int $value, int $transferToId): array
    {
        return $this->transfer->execute(['value' => $value, 'transferToId' => $transferToId]);
    }

    /**
     * @param Payment $payment
     * @return array
     */
    public function cardToCard(Payment $payment): array
    {
        return $this->cardToCard->execute(['value' => (int) $payment->price, 'status' => $payment->status]);
    }

    /**
     * @param int $value
     * @param int $userId
     * @param string $message
     * @return array
     */
    public function increaseByAdmin(int $value, int $userId, string $message): array
    {
        return $this->increaseByAdmin->execute(['value' => $value, 'user-id' => $userId, 'description' => $message]);
    }

    /**
     * @param int $value
     * @param int $userId
     * @param string $message
     * @return array
     */
    public function decreaseByAdmin(int $value, int $userId, string $message): array
    {
        return $this->decreaseByAdmin->execute(['value' => $value, 'user-id' => $userId, 'description' => $message]);
    }

    /**
     * @return array
     */
    public function pay(): array
    {
        $order = Financial::createOrder();
        if ($order) {
            Delivery::createDelivery($order->id);
            return $this->pay->execute(['value' => $order->final_price, 'order' => $order]);
        }

        return ['status' => false, 'error' => 'Nothing in cart or order problem'];
    }

    /**
     * @param Episode $episode
     * @param int $price
     * @return array
     */
    public function payWithoutCart(Episode $episode): array
    {
        $order = Financial::createOrder(Order::STATUSRESERVED, 'tutorha', $episode);
        if ($order && $episode->status) {
            return $this->payWithoutCart->execute(['order' => $order]);
        }

        return ['status' => false, 'error' => 'product or order problem'];
    }

    /**
     * @param int $transactionId
     * @param string $message
     * @return array
     */
    public function rejectTransfer(int $transactionId, string $message): array
    {
        return $this->rejectTransfer->execute(['transaction-id' => $transactionId, 'message' => $message]);
    }

    /**
     * @param int $transactionId
     * @return array
     */
    public function confirmTransfer(int $transactionId): array
    {
        return $this->confirmTransfer->execute(['transaction-id' => $transactionId]);
    }
}
