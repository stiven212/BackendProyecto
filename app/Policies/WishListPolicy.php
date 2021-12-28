<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WishList;
use Illuminate\Auth\Access\HandlesAuthorization;

class WishListPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->isGranted(User::ROLE_SUPERADMIN)) {
            return true;
        }
    }
    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\WishList  $wishList
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, WishList $wishList)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\WishList  $wishList
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, WishList $wishList)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\WishList  $wishList
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, WishList $wishList)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\WishList  $wishList
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, WishList $wishList)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\WishList  $wishList
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, WishList $wishList)
    {
        //
    }

    public function showByWish(User $user, WishList $wishList){
        return $user->isGranted(User::ROLE_USER) && $user->id === $wishList->user_id;
    }

    public function storeByWish(User $user, WishList $wishList){
        return $user->isGranted(User::ROLE_USER) && $user->id === $wishList->user_id;
    }

    public function deleteByWish(User $user, WishList $wishList){
        return $user->isGranted(User::ROLE_USER) && $user->id === $wishList->user_id;
    }
}
