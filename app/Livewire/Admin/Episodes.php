<?php

namespace App\Livewire\Admin;

use App\Livewire\Admin\Forms\EpisodeForm;
use App\Models\Episode;
use App\Models\Product;
use App\Services\V1\Image\Image;
use App\Traits\ComponentTools;
use App\Traits\DeleteFunction;
use App\Traits\ImageTools;
use Illuminate\Auth\Access\AuthorizationException;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Episodes extends Component
{
    use WithPagination;
    use ComponentTools;
    use DeleteFunction;
    use WithFileUploads;
    use ImageTools;

    protected $listeners = ['delete', 'update', 'deleteImage'];
    public Product $product;
    public EpisodeForm $form;
    public Episode|null $episode;

    public function mount(Product $product): void
    {
        $this->product = $product;
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
        $this->form->reset();
        $this->dispatch('setData');
        $this->episode = null;
        $this->showForm = true;
    }

    /**
     * @param Episode $episode
     * @return void
     */
    public function update(Episode $episode): void
    {
        $this->showForm = true;
        $this->episode = $episode;
        $this->form->setForm($episode);
        $this->dispatch('setData');
        $this->imageList = Image::imageList($this->episode, Image::DRIVER_PUBLIC)->getData()->paths;
    }

    /**
     * @return void
     * @throws AuthorizationException
     */
    public function save(): void
    {
        if (empty($this->episode)) {
            $this->authorize('create', Product::class);
            $episode = new Episode();
            $episode->product_id = $this->product->id;
        } else {
            $this->authorize('update', Product::class);
            $episode = $this->episode;
        }

        $this->form->validate();
        $this->form->setData($episode);

        if ($episode->save()) {
            if ($this->form->photo) {
                Image::modelImages($episode, [$this->form->photo], Image::DRIVER_PUBLIC);
            }
            $this->showForm = false;
            $this->form->reset();
            $this->dispatch('refresh');
            $this->dispatch('toast', type: 'success', message: __('general.savedSuccessfully'));
        } else {
            $this->dispatch('toast', type: 'error', message: __('general.somethingWrong'));
        }
    }

    public function render()
    {
        $data = Episode::query();

        if (!empty($this->search)) {
            $data->orWhere(function($query) {
                $query->search('title', $this->search);
            });
        }

        $data->where('product_id', $this->product->id);

        $data = $data->orderByDesc('id')->paginate(10);

        return view('livewire.admin.episodes', compact('data'))->layout('components.layouts.admin');
    }
}
