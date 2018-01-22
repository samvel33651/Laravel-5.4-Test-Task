<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Item;
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

        $items = Item::SearchByKeyword($keyword)->get();
        if(count($items) > 0){
            return view('layouts.search.results', compact('items', 'keyword'));
        }else{
            return view('layouts.search.noResults' , compact('keyword'));
        }


    }

}
