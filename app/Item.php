<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Type;
use App\Vendor;

class Item extends Model
{
    protected $fillable = [
        'item_name', 'price', 'weight', 'vendor', 'type_id', 'serial_number', 'color', 'release_date', 'photo', 'tags'
    ];

    /**
     * Get the type of associated item.
     */
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    /**
     * Get the vendor of associated item.
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor');
    }

    /**
     * Get the user of associated item.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the search result by a keyword.
     */
    public function scopeSearchByKeyword($query, $keyword)
    {
        if (auth()->user()->isAdmin == 1) {
            $query->where(function ($query) use ($keyword) {
                $query->where("item_name", "LIKE", "%" . $keyword . "%")
                    ->orWhere("price", "=", "%" . $keyword . "%")
                    ->orWhere("color", "LIKE", "%" . $keyword . "%");
            });
        }else{
            $query->where(function ($query) use ($keyword){
                $query->where("item_name", "LIKE", "%" . $keyword . "%")
                    ->orWhere("price",$keyword )
                    ->orWhere("color", "LIKE", "%".$keyword."%");
            })->where('user_id', auth()->user()->id);

        }
    }

    /**
     * Get the pie chart data.
     */
    public static function getChartData(){
        $types = Type::all();
        $result = array();
        foreach($types as $type){
            $result[$type->name] = Item::where('type_id', $type->id)->count();
        }
        return $result;
    }

    /**
     * Get the sidebar data.
     */
    public static  function getSidebarData(){
        if(auth()->user()->isAdmin == 1){
            return  Item::orderBy('id', 'desc')->take(config('sideBarItemCount'))->get();
        }
        return  Item::orderBy('id', 'desc')->where('user_id', auth()->user()->id)->take(config('sideBarItemCount'))->get();

    }
}
