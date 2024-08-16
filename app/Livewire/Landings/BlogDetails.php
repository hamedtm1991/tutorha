<?php

namespace App\Livewire\Landings;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class BlogDetails extends Component
{

    private string $id;

    public function mount(string $id)
    {
        $this->id = $id;
    }

    public function render()
    {
        $post = Http::get('https://tutorha-ewoehznko.liara.run/api/collections/posts/records/' . $this->id)->json();

        return view('livewire.landings.blog-details', compact('post'));
    }
}
