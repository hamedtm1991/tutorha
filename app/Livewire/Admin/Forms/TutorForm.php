<?php

namespace App\Livewire\Admin\Forms;

use App\Models\Tutor;
use Livewire\Attributes\Rule;
use Livewire\Form;

class TutorForm extends Form
{
    #[Rule('required|string|min:3|max:100')]
    public string|null  $name = '';

    #[Rule('required|string|min:3|max:100')]
    public string|null  $title = '';

    #[Rule('required|string|min:3|max:100')]
    public string|null  $slug = '';

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
        $this->title = $tutor->title;
        $this->slug = $tutor->slug;
        $this->description= $tutor->description;
    }

    /**
     * @param Tutor $tutor
     * @return void
     */
    public function setData(Tutor $tutor): void
    {
        $tutor->name = $this->name;
        $tutor->title = $this->title;
        $tutor->slug = $this->slug;
        $tutor->description = $this->description;
    }
}
