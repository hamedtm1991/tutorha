<?php

namespace App\Livewire\Admin;

use App\Livewire\Admin\Forms\CourseForm;
use App\Models\Product;
use App\Services\V1\Image\Image;
use Illuminate\Auth\Access\AuthorizationException;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Courses extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $listeners = ['delete', 'update', 'deleteImage'];
    public array $searchItems = ['id', 'name'];
    public array $searchItemTutors = ['name'];
    public bool $showForm = false;
    public string $search;
    public CourseForm $form;
    public Product|null $product;
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
     * @return void
     */
    public function create(): void
    {
        $this->form->reset();
        $this->dispatch('setDataOnCkeditor', '', '');
        $this->dispatch('setData');
        $this->product = null;
        $this->showForm = true;
    }

    /**
     * @param Product $product
     * @return void
     */
    public function update(Product $product): void
    {
        $this->showForm = true;
        $this->product = $product;
        $this->form->setProduct($product);
        $this->dispatch('setData');
        $this->dispatch('setDataOnCkeditor', $this->form->ckeditor1, $this->form->ckeditor2);
        $this->imageList = Image::imageList($this->product, Image::DRIVER_PUBLIC)->getData()->paths;
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
        if (empty($this->product)) {
            $this->authorize('create', Product::class);
            $product = new Product();
        } else {
            $this->authorize('update', Product::class);
            $product = $this->product;
        }

        $this->form->validate();
        $this->form->setData($product);

        if ($product->save()) {
            if ($this->form->tags) {
                $product->tags()->sync(array_flip($this->form->tags));
            }

            $product->tutors()->sync(array_flip($this->form->tutors));

            if ($this->form->photo) {
                Image::modelImages($product, [$this->form->photo], Image::DRIVER_PUBLIC);
            }
            $this->showForm = false;
            $this->form->reset();
            $this->dispatch('refresh');
            $this->dispatch('toast', type: 'success', message: __('general.savedSuccessfully'));
        } else {
            $this->dispatch('toast', type: 'error', message: __('general.somethingWrong'));
        }
    }

    /**
     * @param Product $product
     * @return void
     * @throws AuthorizationException
     */
    public function delete(Product $product): void
    {
        $this->authorize('delete', Product::class);

        if ($product->delete()) {
            $this->dispatch('toast', type: 'success', message: __('general.deletedSuccessfully', ['id' => $product->id]));
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
        $data = Product::query();

        if (!empty($this->search)) {
            $data->orWhere(function($query) {
                $query->search('title', $this->search);
            });
        }

        $data = $data->orderByDesc('id')->paginate(10);
        return view('livewire.admin.courses', compact('data'))->layout('components.layouts.admin-with-ckeditor');
    }
}
