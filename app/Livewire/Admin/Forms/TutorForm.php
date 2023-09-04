<?php

namespace App\Livewire\Admin\Forms;

use App\Models\Tutor;
use Livewire\Attributes\Rule;
use Livewire\Form;

class TutorForm extends Form
{
    #[Rule('required|string|min:3|max:100')]
    public string|null  $name = '';

    #[Rule('required|string|min:3|max:500')]
    public string|null  $description = '';

    #[Rule('image|max:1024')] // 1MB Max
    public $photo = '';

    /**
     * @param Tutor $tutor
     * @return void
     */
    public function setTutor(Tutor $tutor): void
    {
        $this->name = $tutor->name;
        $this->description= $tutor->description;
    }

    /**
     * @param Tutor $tutor
     * @return void
     */
    public function setData(Tutor $tutor): void
    {
        $tutor->name = $this->name;
        $tutor->description = $this->description;
    }
}
