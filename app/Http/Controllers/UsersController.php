<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Item;
use App\Type;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the users in admin panel.
     *
     * User must be admin.
     */
    public function index()
    {
        $this->authorize('view', User::class);
        $users = User::all();
        return view('layouts.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create(User $user)
    {
        $this->authorize('view', $user);
        return view('layouts.users.new');
    }

    /**
     * Change the user's role.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function makeAdmin(Request $request, User $user)
    {

        $this->authorize('update', $user);
        $user->updateAdminStatus($request['isAdmin']);
        return 'User updated successfully';
    }

    /**
     * Change the user activity status.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function activateOrDeactivateUser(Request $request, User $user)
    {
        $this->authorize('update', $user);
        $user->updateUserActiveStatus($request['isActive']);
        return 'User active/diactive status updated successfully';
    }

    /**
     * Validate and store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\User $user
     * @return redirectTo User's Page
     */
    public function store(Request $request, User $user)
    {

        $this->authorize('create', $user);
        /**Validating form data**/
        $validatedData = $request->validate([
            'email' => 'required|email',
            'username' => 'required|min:3',
            'password' => 'required|confirmed',

        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['isAdmin'] = request('isAdmin') ? 1 : 0;
        $validatedData['isActive'] = request('isActive') ? 1 : 0;
        User::create($validatedData);
        return  redirect()->route('users');
    }

    /*
     * Admin page
     */

    public function adminPanel()
    {
        $itemsCount = Item::count();
        $newItems = Item::orderBy('id', 'desc')->take(5)->get();
        $averageItemsPrice = Item::avg('price');
        $activeUsersCount = User::where('isActive', 1)->count();
        $typesCount = Type::count();
        $pieChartData = Item::getChartData();
        return view('adminPanel.index', compact('itemsCount', 'activeUsersCount', 'averageItemsPrice', 'typesCount', 'pieChartData', 'newItems' ));
    }
}
