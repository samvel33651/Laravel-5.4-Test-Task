<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Item;
use View;
class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Search a newly item in the storage by a keyword.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item $item
     * @return view with the array of results
     */

    public function search(Request $request,Item $item)
    {
        request()->validate([
            'keyword' => 'required|min:3'
        ]);

        $keyword= request('keyword');
        if(auth()->user()->isAdmin ===1){
            $items = Item::SearchByKeyword($keyword)->sortable()->paginate(5);
        }else{
            $items = Item::SearchByKeyword($keyword)->where('user_id', auth()->id())->sortable()->paginate(5);
        }

        $isPost = false;

        if($request->isMethod('post')){
            $isPost = true;
            echo View::make('layouts.items.entry' , compact('items', 'isPost'));
            die();
        }

        if(count($items) > 0){
            return view('layouts.search.results', compact('items', 'keyword'));
        }else{
            return view('layouts.search.noResults' , compact('keyword'));
        }


    }

}
