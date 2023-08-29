<?php

namespace App\Livewire\Widgets;

use Livewire\Component;

class Ckeditor extends Component
{
    public string $id;
    public string $title;

    public function render()
    {
        return view('livewire.widgets.ckeditor');
    }
}
