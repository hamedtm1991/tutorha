<?php

namespace App\Livewire\Admin;

use App\Models\Payment;
use App\Traits\ComponentTools;
use Livewire\Component;
use Livewire\WithPagination;

class Payments extends Component
{
    use WithPagination;
    use ComponentTools;

    public function render()
    {
        $data = Payment::query();

        if (!empty($this->search)) {
            $data->search('user_id', $this->search);
        }

        $data = $data->orderByDesc('id')->paginate(10);

        return view('livewire.admin.payments', compact('data'))->layout('components.layouts.admin');
    }
}
