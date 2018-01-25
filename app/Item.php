<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\User;
use App\Type;
use App\Vendor;

class Item extends Model
{
    use Sortable;
    protected $fillable = [
        'item_name', 'price', 'weight', 'vendor_id', 'type_id', 'serial_number', 'color', 'release_date', 'photo', 'tags'
    ];
    public $sortable = ['id','item_name', 'price', 'vendor_id', 'type_id', 'weight', 'serial_number', 'color', 'release_date'];

    /**
     * Get the type of associated item.
     */
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * Get the vendor of associated item.
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
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
        $query->where(function ($query) use ($keyword) {
            $query->where("item_name", "LIKE", "%" . $keyword . "%")
                ->orWhere("price", "LIKE", "%" . $keyword . "%")
                ->orWhere("color", "LIKE", "%" . $keyword . "%")
                ->orWhere("weight", "LIKE", "%" . $keyword . "%");
        })->orWhereHas('vendor', function($query) use ($keyword){
            $query->where('name', 'like', '%'.$keyword.'%');
        })->orWhereHas('type', function($query) use ($keyword){
            $query->where('name', 'like', '%'.$keyword.'%');
        });

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
            return  Item::orderBy('id', 'desc')->take(config('app.sideBarItemCount'))->get();
        }
        return  Item::orderBy('id', 'desc')->where('user_id', auth()->user()->id)->take(config('app.sideBarItemCount'))->get();

    }
}
