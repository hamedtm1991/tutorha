<?php

namespace App\Livewire\Admin;

use App\Livewire\Admin\Forms\TutorForm;
use App\Models\Product;
use App\Models\Tutor;
use App\Services\V1\Image\Image;
use Illuminate\Auth\Access\AuthorizationException;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Tutors extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $listeners = ['delete', 'update', 'deleteImage'];

    public bool $showForm = false;
    public string $search;
    public TutorForm $form;
    public Tutor|null $tutor;
    public array $imageList = [];

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
     * @param Tutor $tutor
     * @return void
     */
    public function update(Tutor $tutor): void
    {
        $this->showForm = true;
        $this->tutor = $tutor;
        $this->form->setTutor($tutor);
        $this->dispatch('setData');
        $this->imageList = Image::imageList($this->tutor, Image::DRIVER_PUBLIC)->getData()->paths;
    }

    /**
     * @return void
     */
    public function cancel(): void
    {
        $this->showForm = false;
    }

    /**
     * @return void
     * @throws AuthorizationException
     */
    public function save(): void
    {
        if (empty($this->tutor)) {
            $this->authorize('create', Tutor::class);
            $tutor = new Product();
        } else {
            $this->authorize('update', Tutor::class);
            $tutor = $this->tutor;
        }

        $this->form->validate();
        $this->form->setData($tutor);

        if ($tutor->save()) {
            if ($this->form->photo) {
                Image::modelImages($tutor, [$this->form->photo], Image::DRIVER_PUBLIC);
            }
            $this->showForm = false;
            $this->form->reset();
            $this->dispatch('toast', type: 'success', message: __('general.savedSuccessfully'));
        } else {
            $this->dispatch('toast', type: 'error', message: __('general.somethingWrong'));
        }
    }

    /**
     * @param string $name
     * @return void
     */
    public function deleteImage(string $name): void
    {
        if ($name) {
            $response = Image::deleteSingleImage($name, Image::TYPE_MODEL, Image::DRIVER_PUBLIC)->getData()->status;
            if ($response) {
                $this->imageList = Image::imageList($this->product, Image::DRIVER_PUBLIC)->getData()->paths;
            }
        }
    }

    public function render()
    {
        $data = Tutor::query();

        if (!empty($this->search)) {
            $data->orWhere(function($query) {
                $query->search('name', $this->search);
            });
        }

        $data = $data->orderByDesc('id')->paginate(10);
        return view('livewire.admin.tutors', compact('data'))->layout('components.layouts.admin');
    }
}
