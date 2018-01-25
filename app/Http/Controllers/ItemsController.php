<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreItemsRequest;
use App\Item;
use App\Type;
use Carbon;
use View;

class ItemsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of all items if user is admin
     * or the list of items created by the user.
     * @return view
     */
    public function index(Request $request)
    {
        $this->authorize('view', Item::class);

        if (auth()->user()->isAdmin === 1) {
            $items = Item::sortable()->paginate(config('app.paginationCount'));
        } else{
            $items = auth()->user()->items()->sortable()->paginate(config('app.paginationCount'));
        }
        $isPost = false;

        if($request->isMethod('post')){
            $isPost = true;
             echo View::make('layouts.items.entry' , compact('items', 'isPost'));
            die();
        }

        return view('layouts.items.index', compact('items', 'isPost'));
    }

    /**
     * Show the form for creating a new item.
     *
     * @return view
     */
    public function create()
    {
        $this->authorize('create', Item::class);
        $types = Type::all();
        $vendors = auth()->user()->vendors()->get();
        return view('layouts.items.add', compact('types', 'vendors'));
    }

    /**
     * Validate and store a newly created item in storage.
     *
     * @param  StoreItemsRequest $request
     * @return redirectTo items' page if the creation is successful
     */
    public function store(StoreItemsRequest $request)
    {
        $this->authorize('create', Item::class);
        $validatedData = $request->all();
        $imageName = request()->item_name . auth()->user()->id . '.' . request()->photo->getClientOriginalExtension();

        $validatedData['photo'] = $imageName;

        request()->photo->move(public_path('/img/uploads/items'), $imageName);

        auth()->user()->addItem(new Item($validatedData));

        return redirect()->route('items');
    }

    /**
     * Show the form for editing the specified item.
     *
     * @param  \App\Item $item
     * @return view
     */
    public function edit(Item $item)
    {
        $this->authorize('update', $item);
        $types = Type::all();
        $colors = ['black', 'red', 'blue', 'green', 'white'];
        $vendors = auth()->user()->vendors()->get();
        return view('layouts.items.edit', compact('types', 'vendors', 'item', 'colors'));
    }

    /**
     * Update the specified item in storage.
     *
     * @param  StoreItemsRequest $request
     * @param  \App\Item $item
     * @return redirectTo items' page if succeeded
     */
    public function update(StoreItemsRequest $request, Item $item)
    {
        $this->authorize('update', $item);

        $validatedData = $request->all();

        if(isset($request->photo)){
            $imageName = request()->item_name.auth()->user()->id . '.' . request()->photo->getClientOriginalExtension();

            $validatedData['photo'] = $imageName;
            request()->photo->move(public_path('/img/uploads/items'), $imageName);
        }

        $item->update($validatedData);

        return redirect()->route('items');
    }

    /**
     * Remove the specified item from storage.
     *
     * @param  \App\Item $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $this->authorize('delete', $item);
        $item->delete();
        return redirect()->route('items');
    }
}
