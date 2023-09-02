<?php

namespace App\Livewire\Landings;

use App\Models\Product;
use App\Services\V1\Image\Image;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $data = Product::all();
        return view('livewire.landings.home', compact('data'));
    }
}
