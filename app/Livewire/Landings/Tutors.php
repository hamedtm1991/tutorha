<?php

namespace App\Livewire\Landings;

use App\Models\Product;
use App\Services\V1\Image\Image;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Tutors extends Component
{
    public $tutors;

    public function mount($tutors)
    {
        $this->tutors = $tutors;
    }

    public function render()
    {
        return view('livewire.landings.tutors', [
            'tutors' => $this->tutors,
        ]);
    }
}
