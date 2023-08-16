<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    protected $listeners = ['delete'];


    public string $search;

    /**
     * @return void
     */
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    /**
     * @param User $user
     * @return void
     * @throws AuthorizationException
     */
    public function delete(User $user): void
    {
        $this->authorize('delete', User::class);

        if ($user->delete()) {
            $this->dispatch('toast', type: 'success', message: __('general.deletedSuccessfully', ['id' => $user->id]));
        } else {
            $this->dispatch('toast', type: 'error', message: __('general.somethingWrong'));
        }
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
