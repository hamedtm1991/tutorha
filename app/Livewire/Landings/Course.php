<?php

namespace App\Livewire\Landings;

use App\Models\Episode;
use App\Models\Product;
use App\Services\V1\Wallet\Wallet;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Course extends Component
{
    public Product $product;
    public Collection $episodes;

    public array $tags = [];
    public int $i = 8;

    protected $listeners = ['pay'];

    /**
     * @param Episode $episode
     * @return void
     */
    public function pay(Episode $episode): void
    {
        $response = Wallet::payWithoutCart($episode);

        if ($response['status']) {
            $this->dispatch('toast', type: 'success', message: __('general.successfulPurchase'));
        } else {
            $this->dispatch('toast', type: 'error', message: $response['error']);
        }
    }

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->episodes = Episode::where('product_id', $this->product->id)->get()->groupBy('group');
        $this->tags = $product->tags->pluck('name')->toArray();
    }

    /**
     * @return null
     */
    public function login()
    {
        return $this->redirect(Route('login'));
    }

    public function render()
    {
        return view('livewire.landings.course')->layout('components.layouts.video');
    }
}
