<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Type extends Model
{
    use Sortable;
    protected $fillable = [
        'name',
    ];

    public $sortable = ['name'];
    
    public $timestamps = false;

    /**
     * Get the items of associated type.
     */
    public  function items(){
        return $this->hasMany(Item::class);
    }
}
