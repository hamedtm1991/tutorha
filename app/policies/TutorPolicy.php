<?php

namespace App\policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TutorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any tutor.
     *
     * @param User $user
     * @return bool|void
     */
    public function show(User $user)
    {
        if ($user->can('tutor.show')) {
            return true;
        }
    }

    /**
     * Determine whether the user can create a tutor.
     *
     * @param User $user
     * @return bool|void
     */
    public function create(User $user)
    {
        if ($user->can('tutor.create')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the tutor.
     *
     * @param User $user
     * @return bool|void
     */
    public function update(User $user)
    {
        if ($user->can('tutor.update')) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the tutor.
     *
     * @param User $user
     * @return bool|void
     */
    public function delete(User $user)
    {
        if ($user->can('tutor.delete')) {
            return true;
        }
    }

    /**
     * Determine whether the user can work with private images the tutor.
     *
     * @param User $user
     * @return bool|void
     */
    public function image(User $user)
    {
        if ($user->can('tutor.image')) {
            return true;
        }
    }
}
