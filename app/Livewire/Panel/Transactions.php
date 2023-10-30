<?php

namespace App\Livewire\Panel;

use App\Models\WalletTransaction;
use App\Traits\ComponentTools;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Transactions extends Component
{
    use WithPagination;
    use ComponentTools;

    public function render()
    {
        $data = WalletTransaction::query()->where('wallet_id', optional(Auth::user()->wallet)->id);

        if (!empty($this->search)) {
            $data->search('order_id', $this->search);
        }

        $data = $data->orderByDesc('id')->paginate(10);

        return view('livewire.panel.transactions', compact('data'));
    }
}
