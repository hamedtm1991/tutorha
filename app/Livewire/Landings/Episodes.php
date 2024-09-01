<?php

namespace App\Livewire\Landings;

use Livewire\Component;

class Episodes extends Component
{
    public $episodes;
    public $product;

    public function mount($episodes, $product)
    {
        $this->episodes = $episodes;
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.landings.episodes', [
            'episodes' => $this->episodes,
            'product' => $this->product,
        ]);
    }
}
