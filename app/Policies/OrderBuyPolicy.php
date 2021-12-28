<?php

namespace App\Policies;

use App\Models\OrderBuy;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderBuyPolicy
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
    public function viewAny(User $user, OrderBuy $orderBuy)
    {
        //
        return $user->isGranted(User::ROLE_USER) &&  $user->id === $orderBuy->user_id;

    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrderBuy  $orderBuy
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, OrderBuy $orderBuy)
    {
        //
        return $user->isGranted(User::ROLE_USER) &&  $user->id === $orderBuy->user_id;
    }

//    public function show(User $user, OrderBuy $orderBuy)
//    {
//        return  $user->id === $orderBuy->user_id;
//
//    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function showDetail(User $user, OrderBuy $orderBuy)
    {
        //
        return $user->isGranted(User::ROLE_USER) && $user->id === $orderBuy->user_id;

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrderBuy  $orderBuy
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, OrderBuy $orderBuy)
    {
        //
        return $user->isGranted(User::ROLE_USER) && $user->id === $orderBuy->user_id;

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrderBuy  $orderBuy
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, OrderBuy $orderBuy)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrderBuy  $orderBuy
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, OrderBuy $orderBuy)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrderBuy  $orderBuy
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, OrderBuy $orderBuy)
    {
        //
    }
}
