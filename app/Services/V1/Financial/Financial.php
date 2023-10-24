<?php


namespace App\Services\V1\Financial;

use App\Models\Episode;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Facade;

/**
 * @method static array createOrder(string $status = Order::STATUSRESERVED, string $store = 'tutorha', Episode $episode = null, Product $product = null);
 */
class Financial extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'financial';
    }
}
