<?php

namespace App\Livewire\Panel;

use App\Models\Payment;
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
        $data = WalletTransaction::query()->where('wallet_id', optional(Auth::user()->wallet)->id)->orderByDesc('id')->get();
        $data2 = Payment::query()->where('user_id', Auth::id())->orderByDesc('id')->get();

        $data = $data->concat($data2)->sortByDesc('created_at')->paginate(10);

        return view('livewire.panel.transactions', compact('data'));
    }
}
