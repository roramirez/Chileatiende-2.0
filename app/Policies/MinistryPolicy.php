<?php

namespace App\Policies;

use App\User;
use App\Ministry;
use Illuminate\Auth\Access\HandlesAuthorization;

class MinistryPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->role == 'admin') {
            return true;
        }
    }


    /**
     * Determine whether the user can view the ministry.
     *
     * @param  \App\User  $user
     * @param  \App\Ministry  $ministry
     * @return mixed
     */
    public function view(User $user, Ministry $ministry = null)
    {

        return false;
    }

    /**
     * Determine whether the user can create ministrys.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the ministry.
     *
     * @param  \App\User  $user
     * @param  \App\Ministry  $ministry
     * @return mixed
     */
    public function update(User $user, Ministry $ministry)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the ministry.
     *
     * @param  \App\User  $user
     * @param  \App\Ministry  $ministry
     * @return mixed
     */
    public function delete(User $user, Ministry $ministry)
    {
        return false;
    }
}
