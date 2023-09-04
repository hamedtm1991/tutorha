<?php

namespace App\policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any tag.
     *
     * @param User $user
     * @return bool|void
     */
    public function show(User $user)
    {
        if ($user->can('tag.show')) {
            return true;
        }
    }

    /**
     * Determine whether the user can create a tag.
     *
     * @param User $user
     * @return bool|void
     */
    public function create(User $user)
    {
        if ($user->can('tag.create')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the tag.
     *
     * @param User $user
     * @return bool|void
     */
    public function update(User $user)
    {
        if ($user->can('tag.update')) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the tag.
     *
     * @param User $user
     * @return bool|void
     */
    public function delete(User $user)
    {
        if ($user->can('tag.delete')) {
            return true;
        }
    }

    /**
     * Determine whether the user can work with private images the tag.
     *
     * @param User $user
     * @return bool|void
     */
    public function image(User $user)
    {
        if ($user->can('tag.image')) {
            return true;
        }
    }
}
