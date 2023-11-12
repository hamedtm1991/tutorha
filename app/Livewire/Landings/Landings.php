<?php

namespace App\Livewire\Landings;

use Livewire\Component;

class Landings extends Component
{
    public string $title;

    /**
     * @param string $title
     * @return void
     */
    public function mount(string $title): void
    {
        $this->title = $title;
    }

    public function render()
    {
        if (!$this->title || !in_array($this->title, ['oreilly', 'packt', 'wiley', 'manning'])) {
            abort(404);
        }

        return view('livewire.landings.landings');
    }
}
