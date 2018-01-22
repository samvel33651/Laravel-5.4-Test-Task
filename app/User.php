<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Item;
use App\Vendor;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'isAdmin', 'isActive',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Change the user role.
     */
    public function updateAdminStatus($isAdmin)
    {
        $this->attributes['isAdmin'] = (int)$isAdmin;
        $this->save();
    }

    /**
     * Change user activity status.
     */
    public function updateUserActiveStatus($isActive)
    {
        $this->attributes['isActive'] = (int)$isActive;
        $this->save();
    }

    /**
     * Get the items of associated user.
     */
    public function items()
    {
        return $this->hasMany(Item::class, 'user_id');
    }

    /**
     * Get the vendors of associated user.
     */
    public function vendors()
    {
        return $this->hasMany(Vendor::class, 'user_id');
    }

    /**
     * Add a vendor with associated user_id.
     */
    public function addVendor($vendor)
    {
       return  $this->vendors()->save($vendor);
    }

    /**
     * Add an item with associated user_id.
     */
    public function addItem($item){
        return $this->items()->save($item);
    }
}
