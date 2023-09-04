<?php

namespace App\Livewire\Widgets;

use Livewire\Attributes\Modelable;
use Livewire\Component;
use Livewire\WithPagination;

class Select extends Component
{
    use WithPagination;

    #[Modelable]
    public array|null $items = [];
    public array $searchItems = [];
    public string $selectSearch;
    public string $instance;
    public string $title;
    public string $field = 'name';
    public array|null $where = null;

    protected $listeners = ['refresh'];

    /**
     * @return void
     */
    public function refresh(): void
    {
        $this->selectSearch = '';
    }

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
    }

    /**
     * @param string $id
     * @return void
     */
    public function delete(string $id): void
    {
        unset($this->items[$id]);
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

            if ($this->where) {
                foreach ($this->where as $index => $value) {
                    $items->where($index, $value);
                }
            }

            $selectData = $items->orderBy('created_at', 'DESC')->paginate(4);
        }

        return view('livewire.widgets.select', compact('selectData'));
    }
}
