<?php

namespace App\Livewire\Landings;

use Livewire\Component;

class Episodes extends Component
{
    public $episodes;
    public $product;
    public $urls;
    public $first;

    public function mount($episodes, $product)
    {
        $this->episodes = $episodes;
        $this->product = $product;
    }

    public function render()
    {
        $data = [];
        foreach ($this->episodes as $episode) {
            $episode = $episode[0] ?? null;
            if (isset($episode->links[0]) && (empty($episode->price) || $episode->checkOrder())) {
                $data[$episode->id] = $episode->links[0];
            }
        }

        $urls = getVideoUrl($data);
        $this->urls = $urls;
        $this->first = empty($urls) ? -1 : array_search(min($this->urls), $this->urls);


        return view('livewire.landings.episodes', [
            'episodes' => $this->episodes,
            'product' => $this->product,
        ]);
    }
}
