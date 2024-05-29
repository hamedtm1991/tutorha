<?php

namespace App\Livewire\Admin\Forms;

use App\Models\Episode;
use Livewire\Attributes\Rule;
use Livewire\Form;

class EpisodeForm extends Form
{
    #[Rule('required|string|min:3|max:255')]
    public string|null  $title = '';

    #[Rule('required|string|min:3|max:255')]
    public string|null  $group = '';

    #[Rule('required|string|min:1|max:50')]
    public string|null  $time = '';

    #[Rule(['links.*' => 'string|min:3|max:255',])]
    public array  $links = [];

    #[Rule('image|max:1024')] // 1MB Max
    public $photo = '';

    #[Rule('required|numeric')]
    public string  $price = '';

    #[Rule('numeric')]
    public string|null  $fakePrice = '';


    /**
     * @param Episode $model
     * @return void
     */
    public function setForm(Episode $model): void
    {
        $this->title = $model->title;
        $this->group = $model->group;
        $this->time = $model->time;
        $this->price = $model->price;
        $this->fakePrice = $model->fake_price ?? '';
        $this->links = $model->links ?? [];
    }

    /**
     * @param Episode $model
     * @return void
     */
    public function setData(Episode $model): void
    {
        $model->title = $this->title;
        $model->group = $this->group;
        $model->time = $this->time;
        $model->price = $this->price;
        $model->fake_price = empty($this->fakePrice) ? null : $this->fakePrice;
        $model->links = $this->links;
    }
}
