<?php

namespace App\Livewire\Admin;

use App\Models\WalletTransaction;
use App\Traits\ComponentTools;
use Livewire\Component;
use Livewire\WithPagination;

class Transactions extends Component
{
    use WithPagination;
    use ComponentTools;

    public function render()
    {
        $data = WalletTransaction::query();

        if (!empty($this->search)) {
            $data->search('order_id', $this->search);
        }

        $data = $data->orderByDesc('id')->paginate(10);

        return view('livewire.admin.transactions', compact('data'))->layout('components.layouts.admin');
    }
}
