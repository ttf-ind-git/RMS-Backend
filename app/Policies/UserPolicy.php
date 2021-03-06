<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can see the users.
     *
     * @param  \App\User  $user
     * @return boolean
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the authenticate user can create users.
     *
     * @param  \App\User $user
     * @return boolean
     */
    public function create(User $user)
    {   

        return $user->isAdmin();
    }

    /**
     * Determine whether the authenticate user can update the user.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return boolean
     */
    public function update(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * 
     * 
     * Determine whether the authenticate user can delete the user.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return boolean
     */
    public function delete(User $user, User $model){
        return $user->isAdmin() && $user->id != $model->id;
    }

    /**
     * Determine whether the authenticate user can manage other users.
     *
     * @param  \App\User  $user
     * @return boolean
     */

    public function isAdmin(User $user)
    {
        return $user->isAdmin();
    }

    public function manageUsers(User $user)
    {
        return $user->isAdmin() || $user->isTopManagement() || $user->isHuman_Resource();
    }

    public function isCoordianator(User $user)
    {
        return $user->isCoordianator();
    }

    public function isField_Manager(User $user)
    {
        return $user->isField_Manager();
    }

    public function isHuman_Resource(User $user)
    {
        return $user->isHuman_Resource();
    }    

    public function isSalesman(User $user)
    {
        return $user->isSalesman();
    }

    public function isMerchandiser(User $user)
    {
        return $user->isMerchandiser();
    }

    public function isClient(User $user)
    {
        return $user->isClient();
    }

    public function isTopManagement(User $user)
    {
        return $user->isTopManagement();
    }

    public function isCDE(User $user)
    {
        return $user->isCDE();
    }


    

    /**
     * Determine whether the authenticate user can manage items and other related entities(tags, categories).
     *
     * @param  \App\User  $user
     * @return boolean
     */
    public function manageItems(User $user)
    {
        return $user->isAdmin();
    }

   
}
