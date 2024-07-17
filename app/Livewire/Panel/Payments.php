<?php

namespace App\Livewire\Panel;

use App\Models\Payment;
use App\Traits\ComponentTools;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Payments extends Component
{
    use WithPagination;
    use ComponentTools;

    public function render()
    {
        $data = Payment::query()->where('user_id', Auth::id());

        $data = $data->orderByDesc('id')->paginate(10);

        return view('livewire.panel.payments', compact('data'));
    }
}
