<?php

namespace App\Policies;

use App\User;
use App\Vendor;
use Illuminate\Auth\Access\HandlesAuthorization;

class VendorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the vendor.
     *
     * @param  \App\User  $user
     * @param  \App\Vendor  $vendor
     * @return mixed
     */
    public function view(User $user)
    {
        return True;
    }

    /**
     * Determine whether the user can create vendors.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin ==0;
    }

    /**
     * Determine whether the user can update the vendor.
     *
     * @param  \App\User  $user
     * @param  \App\Vendor  $vendor
     * @return mixed
     */
    public function update(User $user, Vendor $vendor)
    {
        return $user->isAdmin ==1 || $vendor->user_id == $user->id;
    }

    /**
     * Determine whether the user can delete the vendor.
     *
     * @param  \App\User  $user
     * @param  \App\Vendor  $vendor
     * @return mixed
     */
    public function delete(User $user, Vendor $vendor)
    {
        return $user->isAdmin ==1 || $vendor->user_id == $user->id;
    }
}
