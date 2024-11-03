<?php

namespace App\Livewire\Landings;

use Livewire\Component;

class TutorDetailCourse extends Component
{
    public $tutors;

    public function mount($tutors)
    {
        $this->tutors = $tutors;
    }

    public function render()
    {
        return view('livewire.landings.tutor-detail-course', [
            'tutors' => $this->tutors,
        ]);
    }
}
