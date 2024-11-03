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

    protected $listeners = ['end'];

    public function mount(string $slug)
    {
        $this->product = Product::where('slug', $slug)->firstOrFail();
        $this->episodes = collect(Episode::where('product_id', $this->product->id)->get()->groupBy('group')->all());
        $this->tags = $this->product->tags->pluck('name')->toArray();
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
