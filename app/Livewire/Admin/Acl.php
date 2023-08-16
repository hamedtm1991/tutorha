<?php

namespace App\Livewire\Admin;

use App\Models\Permission;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Acl extends Component
{
    use WithPagination;

    protected $listeners = ['delete', 'update', 'updateSelectWidgetItems'];


    public string $search;
    public string|null $name;
    public Role|null $role = null;
    public array $permissions;
    public array $items;
    public array $searchItems = ['id', 'name'];
    public bool $showForm = false;

    /**
     * @param array $items
     * @return void
     */
    public function updateSelectWidgetItems(array $items): void
    {
        $this->permissions = $this->items = $items;
    }

    /**
     * @return void
     */
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    /**
     * @return void
     */
    public function hydrate(): void
    {
        $this->resetValidation();
    }

    /**
     * @return void
     */
    public function create(): void
    {
        $this->showForm = true;
    }

    /**
     * @param Role $role
     * @return void
     */
    public function update(Role $role): void
    {
        $this->showForm = true;
        $this->role = $role;
        $this->name = $role->name;
        $this->items = $role->permissions->pluck('name', 'id')->toArray();
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
            'name' => [
                'required', 'string', 'min:3', 'max:255',
                Rule::unique('roles', 'name')->ignore(optional($this->role)->id)
            ],
            'permissions.*' => 'string|exists:permissions,name'
        ];
    }

    /**
     * @return void
     * @throws AuthorizationException
     */
    public function save(): void
    {
        if (empty($this->role)) {
            $this->authorize('create', Permission::class);
            $role = new Role();
        } else {
            $this->authorize('update', Permission::class);
            $role = $this->role;
        }

        $validated = $this->validate();


        $role->name = $validated['name'];
        if ($role->save()) {
            if ($this->permissions) {
                $role->syncPermissions($this->permissions);
            }
            $this->showForm = false;
            $this->reset('name');
            $this->dispatch('toast', type: 'success', message: __('general.savedSuccessfully'));
        } else {
            $this->dispatch('toast', type: 'success', message: __('general.somethingWrong'));
        }
    }

    /**
     * @param Role $role
     * @return void
     * @throws AuthorizationException
     */
    public function delete(Role $role): void
    {
        $this->authorize('delete', \App\Models\Permission::class);

        if ($role->delete()) {
            $this->dispatch('toast', type: 'success', message: __('general.deletedSuccessfully', ['id' => $role->id]));
            $this->dispatch('refresh');
        } else {
            $this->dispatch('toast', type: 'error', message: __('general.somethingWrong'));
        }
    }

    /**
     * @return mixed
     */
    public function render(): mixed
    {
        $data = Role::query();

        if (!empty($this->search)) {
            $data->search('name', $this->search);
        }

        $data = $data->orderByDesc('id')->paginate(10);

        return view('livewire.admin.acl', compact('data'))->layout('components.layouts.admin');
    }
}
