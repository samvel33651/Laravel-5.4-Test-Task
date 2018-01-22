<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreVendorsRequest;
use Illuminate\Http\Request;
use App\Vendor;
use App\User;
use Auth;
class VendorsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the vendors.
     * @param  \App\User $user
     * @return view of all vendors for admin and user created vendors for regular users
     */
    public function index(User $user)
    {
        $this->authorize('view', Vendor::class);
        if(auth()->user()->isAdmin == 1){
            $vendors = Vendor::all();
        }else{
            $vendors = auth()->user()->vendors()->get();
        }

        return view('layouts.vendors.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new vendor.
     * @param  \App\User $user
     * @return view form to add a new vendor if user has a permission or redirectTo vendors' page
     */
    public function create(User $user)
    {
        if(Auth::user()->can('create', Vendor::class)){
            return view('layouts.vendors.add');
        };

        return redirect()->route('vendors');
    }

    /**
     * Validate and store a newly created vendor in storage.
     *
     * @param  StoreVendorsRequest  $request
     * @return redirectTo vendors' page
     */
    public function store(StoreVendorsRequest $request)
    {
        $this->authorize('create', Vendor::class);
        $imageName = request()->name.auth()->user()->id.'.'.request()->logo->getClientOriginalExtension();
        auth()->user()->addVendor(new Vendor(['name'=>request('name'), 'logo' =>$imageName]));
        request()->logo->move(public_path('/img/uploads/vendors'), $imageName);
        return redirect()->route('vendors');
    }

    /**
     * Show the form for editing the specified vendor.
     *
     * @param  \App\Vendor $vendor
     * @return view
     */
    public function edit(Vendor $vendor)
    {
        $this->authorize('update', $vendor);
        return view('layouts.vendors.edit', compact('vendor'));
    }

    /**
     * Update the specified vendor in storage.
     *
     * @param  StoreVendorsRequest $request
     * @param  \App\Vendor $vendor
     * @return redirectTo vendors' page if succeeded
     */
    public function update(StoreVendorsRequest $request, Vendor $vendor)
    {
        $this->authorize('update', $vendor);
        $validatedData =  $request->all();
        $validatedData['user_id'] = auth()->id();

        $imageName = request()->name.auth()->user()->id.'.'.request()->logo->getClientOriginalExtension();
        $validatedData['logo'] = $imageName;
        request()->logo->move(public_path('/img/uploads/vendors'), $imageName);
        $vendor->update($validatedData);
        return redirect()->route('vendors');
    }

    /**
     * Remove the specified vendor from storage.
     *
     * @param  \App\Vendor $vendor
     * @return redirectTo vendors' page if succeeded
     */
    public function destroy( Vendor $vendor)
    {
        $this->authorize('delete',$vendor);
        $vendor->delete();
        return redirect()->route('vendors');
    }
}
