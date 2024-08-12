<?php

namespace App\Livewire\Landings;

use App\Models\Episode;
use App\Models\Order;
use App\Models\Product;
use App\Models\UserWatchDetail;
use App\Services\V1\Wallet\Wallet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Course extends Component
{
    public Product $product;
    public Collection $episodes;

    public array $tags = [];
    public int $i = 8;

    protected $listeners = ['pay', 'end'];

    /**
     * @param Episode $episode
     * @return void
     */
    public function pay(Episode $episode)
    {
        if (!Auth::user()->wallet || Auth::user()->wallet->value < $episode->price) {
            return $this->redirect(Route('payment', ['value' => $episode->price - Auth::user()->wallet->value ?? 0]));
        }

        if (!$episode->checkOrder()) {
            $response = Wallet::payWithoutCart($episode);

            if ($response['status']) {
                $this->dispatch('toast', type: 'success', message: __('general.successfulPurchase'));
            } else {
                $this->dispatch('toast', type: 'error', message: $response['error']);
            }
        } else {
            $this->dispatch('toast', type: 'error', message: __('general.alreadyPaid'));
        }
    }

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->episodes = collect(Episode::where('product_id', $this->product->id)->get()->groupBy('group')->all());
        $this->tags = $product->tags->pluck('name')->toArray();
    }

    /**
     * @return null
     */
    public function login()
    {
        return $this->redirect(Route('login'));
    }

    /**
     * @param string $productId
     * @param string $episodeId
     * @return void
     */
    public function end(string $productId, string $episodeId)
    {
        if (Auth::check()) {
            $watchDetail = UserWatchDetail::where('product_id', $productId)->where('episode_id', $episodeId)->where('user_id', Auth::id())->first();

            if (!$watchDetail) {
                $watchDetail = new UserWatchDetail();
                $watchDetail->user_id = Auth::id();
                $watchDetail->product_id = $productId;
                $watchDetail->episode_id = $episodeId;
                $watchDetail->completed = true;
                $watchDetail->save();
            }
        }
    }

    public function render()
    {
        $watchDetail = UserWatchDetail::where('user_id', Auth::id())->where('product_id', $this->product->id)->get();
        $watchDetail = $watchDetail->pluck('completed', 'episode_id')->toArray();
        return view('livewire.landings.course', compact('watchDetail'))->layout('components.layouts.video');
    }
}
