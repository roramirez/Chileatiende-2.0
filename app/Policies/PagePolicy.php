<?php

namespace App\Policies;

use App\User;
use App\Page;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->role == 'admin') {
            return true;
        }
    }

    /**
     * Determine whether the user can view the page.
     *
     * @param  \App\User  $user
     * @param  \App\Page  $page
     * @return mixed
     */
    public function view(User $user, Page $page = null)
    {
        if($user->role != 'editor')
            return false;

        if($page != null){
            if($user->interministerial){

            }else if($user->ministerial){
                if($user->institution->ministry_id != $page->institution->ministry_id){
                    return false;
                }
            }else{
                if($user->institution_id != $page->institution_id){
                    return false;
                }
            }

            if($page->status == 'en_revision')
                return false;
        }



        return true;
    }

    /**
     * Determine whether the user can create pages.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if($user->role != 'editor')
            return false;

        return true;
    }

    /**
     * Determine whether the user can update the page.
     *
     * @param  \App\User  $user
     * @param  \App\Page  $page
     * @return mixed
     */
    public function update(User $user, Page $page)
    {



        return $this->view($user,$page);
    }

    /**
     * Determine whether the user can delete the page.
     *
     * @param  \App\User  $user
     * @param  \App\Page  $page
     * @return mixed
     */
    public function delete(User $user, Page $page)
    {
        if($page->status)
            return false;

        return $this->view($user,$page);
    }

    public function updateMaster(User $user, Page $page)
    {
        return false;
    }

    public function updateStatus(User $user, Page $page)
    {
        return $this->view($user, $page);
    }

    public function publishVersion(User $user, Page $page)
    {
        return false;
    }

    public function updateFeatured(User $user, Page $page = null)
    {
        return false;
    }

}
