<?php

namespace App\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{
    public string $name;
    public string $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $name = null, string $title = '')
    {
        $this->name = $name ?? rand();
        $this->title = $title;
    }


    /**
     * @return Application|Factory|Htmlable|\Illuminate\Foundation\Application|View
     */
    public function render(): Application|Factory|Htmlable|\Illuminate\Foundation\Application|View
    {
        return view('components.modal');
    }
}
