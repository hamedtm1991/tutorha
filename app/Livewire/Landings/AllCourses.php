<?php

namespace App\Livewire\Landings;

use App\Models\Product;
use Livewire\Component;

class AllCourses extends Component
{
    public $tag;

    public function mount($tag)
    {
        $this->tag = $tag;
    }

    public function render()
    {
        if ($this->tag === 'all') {
            $products = Product::paginate(10);
        } else {
            $products = Product::whereHas('tags', function ($query) {
                return $query->where('name', $this->tag);
            })->paginate(10);
        }

        return view('livewire.landings.all-courses', ['data' => $products]);
    }
}
