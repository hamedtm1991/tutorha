<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public string $search;

    /**
     * @return void
     */
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    /**
     * @return mixed
     */
    public function render(): mixed
    {
        $data = User::query();

        if (!empty($this->search)) {
            $data->orWhere(function($query) {
                $query->search('mobile', $this->search);
            });
        }

        $data = $data->paginate(10);

        return view('livewire.admin.users', compact('data'))->layout('components.layouts.admin');
    }
}
