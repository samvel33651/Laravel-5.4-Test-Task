<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
        'name',
    ];

    public $timestamps = false;

    /**
     * Get the items of associated type.
     */
    public  function items(){
        return $this->hasMany(Item::class);
    }
}
