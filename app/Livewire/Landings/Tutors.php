<?php

namespace App\Livewire\Landings;

use App\Models\Product;
use App\Models\Tutor;
use App\Services\V1\Image\Image;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Tutors extends Component
{
    public $tutors;


    public function render()
    {
        $this->tutors = Tutor::all();
        return view('livewire.landings.tutors', [
            'tutors' => $this->tutors,
        ]);
    }
}
