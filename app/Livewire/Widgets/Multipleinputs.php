<?php

namespace App\Livewire\Widgets;

use Livewire\Component;
use Livewire\Attributes\Modelable;

class Multipleinputs extends Component
{
    #[Modelable]
    public array|null $arrayValues = [];
    protected $listeners = ['setData'];
    public int $i = 0;
    public array $inputs = [];
    public string $title;
    public array $options;
    public string $placeHolder;

    /**
     * @return void
     */
    public function setData(): void
    {
        $this->i = 0;
        $this->inputs = [];
        foreach ($this->arrayValues as $value) {
            $this->add();
        }
    }

    /**
     * @return void
     */
    public function add(): void
    {
        $this->inputs[] = $this->i;
        $this->i += 1;
    }

    /**
     * @param int $i
     * @return void
     */
    public function remove(int $i): void
    {
        unset($this->inputs[$i]);
    }

    public function render()
    {
        return view('livewire.widgets.multipleinputs');
    }
}
