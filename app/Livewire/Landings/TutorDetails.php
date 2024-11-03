<?php

namespace App\Livewire\Landings;

use App\Models\Tutor;
use Livewire\Component;

class TutorDetails extends Component
{

    private string $slug;

    public function mount(string $slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $tutor = Tutor::where('slug', $this->slug)->first();
        $data = $tutor->products;

        return view('livewire.landings.tutor-details', compact('tutor', 'data'));
    }
}
