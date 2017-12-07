<?php

namespace App\Policies;

use App\User;
use App\Institution;
use Illuminate\Auth\Access\HandlesAuthorization;

class InstitutionPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->role == 'admin') {
            return true;
        }
    }


    /**
     * Determine whether the user can view the institution.
     *
     * @param  \App\User  $user
     * @param  \App\Institution  $institution
     * @return mixed
     */
    public function view(User $user, Institution $institution = null)
    {

        return false;
    }

    /**
     * Determine whether the user can create institutions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the institution.
     *
     * @param  \App\User  $user
     * @param  \App\Institution  $institution
     * @return mixed
     */
    public function update(User $user, Institution $institution)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the institution.
     *
     * @param  \App\User  $user
     * @param  \App\Institution  $institution
     * @return mixed
     */
    public function delete(User $user, Institution $institution)
    {
        return false;
    }
}
