<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
use App\Item;
use App\User;
use Auth;
class TypesController extends Controller
{
    /**
     * Display a listing of all types.
     *
     * @return types' view if the user is admin or redirectTo the dashboard in case the user is regular
     */
    public function index()
    {
        if(Auth::user()->can('view', Type::class)) {
            $types = Type::all();
            return view('layouts.types.index', compact('types'));
        }
        return redirect()->route('dashboard');
    }

    /**
     * Show the form for creating a new type.
     *
     * @return view
     */
    public function create(User $user)
    {
        $this->authorize('view', Item::class);
        return view('layouts.types.add');
    }

    /**
     * Validate and store a newly created type in storage.
     *
     * @param \Illuminate\Http\Request
     * @return redirectTo types' page in case of successful creation
     */
    public function store(Request $request, User $user)
    {
        $this->authorize('create', Type::class);
        $validatedData = $request->validate([
            'name' => 'required|min:3',
        ]);

        Type::create($validatedData);
        return redirect()->route('types');
    }

    /**
     * Show the form for editing the specified type.
     *
     * @param  \App\Type $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        $this->authorize('view', $type);
        return view('layouts.types.edit', compact('type'));
    }

    /**
     * Validate and update the specified type in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Type $type
     * @return redirectTo types' page in case of success
     */
    public function update(Request $request, Type $type)
    {
        $this->authorize('update', $type);
        $validatedData = $request->validate([
            'name' => 'required|min:3'
        ]);

        $type->update($validatedData);

        return redirect()->route('types');
    }

    /**
     * Remove the specified type and all related items in itam table cascaded from storage.
     *
     * @param  \App\Type $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $this->authorize('delete', $type);
        $type->delete();
        $type->items()->delete();
        return redirect()->back();
    }
}
