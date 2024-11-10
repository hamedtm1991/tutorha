<?php

namespace App\Livewire\Landings;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class BlogDetails extends Component
{

    private string $slug;

    public function mount(string $slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $post = Http::get('https://tutorha-ewoehznko.liara.run/api/collections/posts/records/?filter=(slug="' . $this->slug . '")')->json();

        if ($post) {
            $post = $post['items'][0];
        }

        return view('livewire.landings.blog-details', compact('post'));
    }
}
