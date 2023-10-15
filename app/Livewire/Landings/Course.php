<?php

namespace App\Livewire\Landings;

use App\Models\Episode;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Course extends Component
{
    public Product $product;
    public Collection $episodes;

    public array $tags = [];
    public int $i = 8;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->episodes = Episode::where('product_id', $this->product->id)->get()->groupBy('group');
        $this->tags = $product->tags->pluck('name')->toArray();
    }

    public function render()
    {
        return view('livewire.landings.course')->layout('components.layouts.video');
    }
}
