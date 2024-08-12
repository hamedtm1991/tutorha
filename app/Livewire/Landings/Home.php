<?php

namespace App\Livewire\Landings;

use App\Models\Product;
use App\Services\V1\Image\Image;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $data = Product::all();

        $posts = Http::get('https://tutorha-ewoehznko.liara.run/api/collections/posts/records?perPage=3')->json();

        return view('livewire.landings.home', compact('data', 'posts'));
    }
}
