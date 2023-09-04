<?php

namespace App\Livewire\Admin;

use App\Models\Tag;
use App\Traits\ComponentTools;
use App\Traits\DeleteFunction;
use Illuminate\Auth\Access\AuthorizationException;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Tags extends Component
{
    use WithPagination;
    use DeleteFunction;
    use ComponentTools;
    protected $listeners = ['delete', 'update'];

    #[Rule('required|string|min:3|max:100')]
    public string|null $name = '';
    public Tag $tag;

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
     * @param Tag $tag
     * @return void
     */
    public function update(Tag $tag): void
    {
        $this->showForm = true;
        $this->name = $tag->name;
        $this->tag = $tag;
    }

    /**
     * @return void
     * @throws AuthorizationException
     */
    public function save(): void
    {
        if (empty($this->tag)) {
            $this->authorize('create', Tag::class);
            $tag = new Tag();
        } else {
            $this->authorize('update', Tag::class);
            $tag = $this->tag;
        }

        $validated = $this->validate();

        $tag->name = $validated['name'];
        if ($tag->save()) {
            $this->showForm = false;
            $this->reset();
            $this->dispatch('toast', type: 'success', message: __('general.savedSuccessfully'));
        } else {
            $this->dispatch('toast', type: 'error', message: __('general.somethingWrong'));
        }
    }

    public function render()
    {
        $data = Tag::query();

        if (!empty($this->search)) {
            $data->search('name', $this->search);
        }

        $data = $data->orderByDesc('id')->paginate(10);

        return view('livewire.admin.tags', compact('data'))->layout('components.layouts.admin');
    }
}
