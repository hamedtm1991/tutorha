<?php

namespace App\Livewire\Landings;


use Illuminate\Support\Facades\Http;
use Livewire\Component;

class BlogPart extends Component
{
    public function render()
    {
        $posts = Http::get('https://tutorha-ewoehznko.liara.run/api/collections/posts/records?perPage=3')->json();


        return view('livewire.landings.blog-part', compact('posts'));
    }
}
