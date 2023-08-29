<?php

namespace App\policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any product.
     *
     * @param User $user
     * @return bool|void
     */
    public function show(User $user)
    {
        if ($user->can('product.show')) {
            return true;
        }
    }

    /**
     * Determine whether the user can create a product.
     *
     * @param User $user
     * @return bool|void
     */
    public function create(User $user)
    {
        if ($user->can('product.create')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the product.
     *
     * @param User $user
     * @return bool|void
     */
    public function update(User $user)
    {
        if ($user->can('product.update')) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the product.
     *
     * @param User $user
     * @return bool|void
     */
    public function delete(User $user)
    {
        if ($user->can('product.delete')) {
            return true;
        }
    }

    /**
     * Determine whether the user can work with private images the product.
     *
     * @param User $user
     * @return bool|void
     */
    public function image(User $user)
    {
        if ($user->can('product.image')) {
            return true;
        }
    }
}
