<?php

namespace App\Livewire\Admin;

use App\Models\Tutor;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    protected $listeners = ['delete', 'roles', 'makeTutor'];


    public string $search;
    public array $roles;
    public bool $showForm = false;
    public array $items;
    public User $selectedUser;
    public array $searchItems = ['id', 'name'];

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
    public function makeTutor(User $user): void
    {
        $this->authorize('update', User::class);
        $tutor = $user->tutor;

        if ($tutor) {
            $tutor->status = !$tutor->status;
        } else {
            $tutor = new Tutor();
            $tutor->user_id = $user->id;
        }

        if ($tutor->save()) {
            $this->dispatch('toast', type: 'success', message: __('general.savedSuccessfully'));
        } else {
            $this->dispatch('toast', type: 'error', message: __('general.somethingWrong'));
        }
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
     * @param User $user
     * @return void
     */
    public function roles(User $user): void
    {
        $this->showForm = true;
        $this->selectedUser = $user;
        $this->items = $user->roles->pluck('name', 'id')->toArray();
    }

    /**
     * @return void
     */
    public function cancel(): void
    {
        $this->showForm = false;
    }

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'roles.*' => 'string|exists:roles,name'
        ];
    }

    /**
     * @return void
     * @throws AuthorizationException
     */
    public function save(): void
    {
        $this->authorize('update', User::class);

        $this->validate();

        $this->selectedUser->syncRoles(array_keys($this->roles));
        $this->showForm = false;
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
