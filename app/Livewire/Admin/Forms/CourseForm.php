<?php

namespace App\Livewire\Admin\Forms;

use App\Models\Product;
use Livewire\Attributes\Rule;
use Livewire\Form;

class CourseForm extends Form
{
    #[Rule('required|string|min:3|max:100')]
    public string  $title = '';

    #[Rule('required|string|min:3|max:500')]
    public string  $ckeditor1 = '';

    #[Rule('string|min:3|max:10000')]
    public string|null  $ckeditor2 = '';

    #[Rule('required|numeric')]
    public string  $price = '';

    #[Rule('numeric')]
    public string|null  $fakePrice = '';

    #[Rule('required|string|min:1|max:10')]
    public string  $time = '';

    #[Rule('required|string|min:1|max:255')]
    public string  $metaKeywords = '';

    #[Rule('required|numeric')]
    public string  $numberOfEpisodes = '';

    #[Rule('required|string|in:beginner,intermediate,advanced')]
    public string  $level = '';

    #[Rule(['form.features.*' => 'string|min:10|max:50',])]
    public array  $features = [];

    public array $tags = [];

    #[Rule('required|array')]
    public array $tutors = [];

    #[Rule('image|max:1024')] // 1MB Max
    public $photo = '';

    /**
     * @param Product $product
     * @return void
     */
    public function setProduct(Product $product)
    {
        $this->title = $product->title;
        $this->ckeditor1= $product->description;
        $this->ckeditor2 = $product->long_description;
        $this->price = $product->price;
        $this->fakePrice = $product->fake_price ?? '';
        $this->time = $product->options['time'] ?? '';
        $this->numberOfEpisodes = $product->options['numberOfEpisodes'] ?? '';
        $this->level = $product->options['level'] ?? '';
        $this->features = $product->options['features'] ?? [];
        $this->metaKeywords = $product->options['metaKeywords'] ?? [];
        $this->tags = $product->tags->pluck('name', 'id')->toArray();
        $this->tutors = $product->tutors->pluck('name', 'id')->toArray();
    }

    /**
     * @param Product $product
     * @return void
     */
    public function setData(Product $product): void
    {
        $options = [];

        $product->title = $this->title;
        $product->description = $this->ckeditor1;
        $product->long_description = $this->ckeditor2;
        $product->price = $this->price;
        $product->fake_price = empty($this->fakePrice) ? null : $this->fakePrice;
        $options['features'] = $this->features;
        $options['metaKeywords'] = $this->metaKeywords;
        $options['time'] = $this->time;
        $options['numberOfEpisodes'] = $this->numberOfEpisodes;
        $options['level'] = $this->level;
        $product->options = $options;
    }
}
