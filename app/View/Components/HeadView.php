<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HeadView extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $title, public string|null $modelName = null)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.head-view');
    }
}
