<?php

namespace App\Policies;

use App\User;
use App\Item;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the item.
     *
     * @param  \App\User $user
     * @param  \App\Item $item
     * @return mixed
     */
    public function view(User $user)
    {
        return true;
    }


    /**
     * Determine whether the user can create items.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin == 0;
    }

    /**
     * Determine whether the user can update the item.
     *
     * @param  \App\User $user
     * @param  \App\Item $item
     * @return mixed
     */
    public function update(User $user, Item $item)
    {
        return $item->user_id === $user->id || $user->isAdmin === 1;
    }

    /**
     * Determine whether the user can delete the item.
     *
     * @param  \App\User $user
     * @param  \App\Item $item
     * @return mixed
     */
    public function delete(User $user, Item $item)
    {
        return $item->user_id === $user->id || $user->isAdmin === 1;
    }
}
