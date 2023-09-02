<?php

namespace App\Livewire\Landings;

use App\Models\Product;
use Livewire\Component;

class Course extends Component
{
    public Product $product;
    public array $tags = [];
    public int $i = 8;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->tags = $product->tags->pluck('name')->toArray();
    }

    public function render()
    {
        return view('livewire.landings.course');
    }
}
