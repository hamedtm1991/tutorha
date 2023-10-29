<?php

namespace App\Traits;

trait ComponentTools {
    public string $search;
    public bool|string $showForm = false;

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
    public function cancel(): void
    {
        $this->showForm = false;
    }
}
