<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\User;
use App\Item;
class Vendor extends Model
{
    use Sortable;
    protected $fillable = [
        'name', 'logo', 'user_id',
    ];

    public $sortable = ['name'];

    public $timestamps = false;

    /**
     * Get items with associated vendor.
     */
    public function items(){
        return $this->hasMany(Item::class, 'vendor_id' );
    }
    /**
     * Get a user (owner/creator) of vendor.
     */
    public function user(){
       return $this->belongsTo(User::class);
    }
}
