<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use App\Traits\ComponentTools;
use Livewire\Component;
use Livewire\WithPagination;

class Orders extends Component
{
    use WithPagination;
    use ComponentTools;

    public function render()
    {
        $data = Order::query();

        if (!empty($this->search)) {
            $data->search('user_id', $this->search);
        }

        $data = $data->orderByDesc('id')->paginate(10);

        return view('livewire.admin.orders', compact('data'))->layout('components.layouts.admin');
    }
}
