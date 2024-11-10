<?php

namespace App\Livewire\Landings;

use App\Models\Product;
use App\Services\V1\Image\Image;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Blogs extends Component
{
    public function render()
    {
        $posts = Http::get('https://tutorha-ewoehznko.liara.run/api/collections/posts/records?perPage=10&sort=-created')->json();

        return view('livewire.landings.blogs', compact('posts'));
    }
}
