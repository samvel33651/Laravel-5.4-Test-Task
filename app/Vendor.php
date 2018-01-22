<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Item;
class Vendor extends Model
{

    protected $fillable = [
        'name', 'logo', 'user_id',
    ];
    public $timestamps = false;

    /**
     * Get items with associated vendor.
     */
    public function items(){
        return $this->hasMany(Item::class, 'vendor' );
    }
    /**
     * Get a user (owner/creator) of vendor.
     */
    public function user(){
       return $this->belongsTo(User::class);
    }
}
