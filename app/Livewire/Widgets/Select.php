<?php

namespace App\Livewire\Widgets;

use Livewire\Component;
use Livewire\WithPagination;

class Select extends Component
{
    use WithPagination;

    public array $items = [];
    public array $searchItems = [];
    public string $selectSearch;
    public string $instance;
    public string $title;

    protected $listeners = ['add', 'delete'];

    /**
     * @return void
     */
    public function updatingItem(): void
    {
        $this->resetPage();
    }

    /**
     * @param string $id
     * @param string|null $option
     * @return void
     */
    public function add(string $id, string $option = null): void
    {
        $this->items[$id] = $option;
        $this->dispatch('updateSelectWidgetItems', $this->items);
    }

    /**
     * @param string $id
     * @return void
     */
    public function delete(string $id): void
    {
        unset($this->items[$id]);
        $this->dispatch('updateSelectWidgetItems', $this->items);
    }

    public function render()
    {
        $selectData = [];
        if (!empty($this->selectSearch)) {
            $instance = "\App\Models\\" . $this->instance;
            $items = $instance::query();

            $items->orWhere(function($query) {
                foreach ($this->searchItems as $searchItem) {
                    $query->search($searchItem, $this->selectSearch);
                }
            });

            $selectData = $items->orderBy('created_at', 'DESC')->paginate(4);
        }

        return view('livewire.widgets.select', compact('selectData'));
    }
}
