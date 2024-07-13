<?php

namespace App\Livewire\Landings;

use Livewire\Attributes\Validate;
use Livewire\Component;

class Payment extends Component
{
    #[Validate('required|integer')]
    public string $price = '';

    /**
     * @return null
     */
    public function bank(): null
    {
        $this->validate();
        return $this->redirect(route('bank', (int) $this->price));
    }

    public function render()
    {
        return view('livewire.landings.payment');
    }
}
