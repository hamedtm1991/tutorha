<?php

namespace App\Traits;

use Illuminate\Auth\Access\AuthorizationException;

trait DeleteFunction {
    /**
     * @param string $value
     * @return void
     * @throws AuthorizationException
     */
    public function delete(string $value): void
    {
        $explode = explode('-', $value);
        $className = 'App\Models\\' . $explode[0];
        $id = (int) $explode[1];

        $this->authorize('delete', $className);

        $model = $className::find($id);

        if ($model->delete()) {
            $this->dispatch('toast', type: 'success', message: __('general.deletedSuccessfully', ['id' => $id]));
        } else {
            $this->dispatch('toast', type: 'error', message: __('general.somethingWrong'));
        }
    }
}
