<?php

namespace App\Livewire\Panel;

use App\Models\Episode;
use App\Models\Order;
use App\Models\Product;
use App\Traits\ComponentTools;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Courses extends Component
{
    use WithPagination;
    use ComponentTools;

    public function render()
    {
        $ProductIds = Episode::whereHas('orders', function (Builder $query) {
            $query->where('user_id', Auth::id())->where('status', Order::STATUSPAID);
        })->select('product_id')->get()->pluck('product_id')->unique()->toArray();
        $data = Product::whereIn('id', $ProductIds)->paginate(10);

        return view('livewire.panel.courses', compact('data'));
    }
}
