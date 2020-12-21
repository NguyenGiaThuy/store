<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $userTitle = 'admin';

        return view('admin.users.home', [
            'userTitle' => $userTitle,
            'username' => Auth::user()->username,
            'avatar' => Auth::user()->profile->avatar,
            'userList' => User::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $userTitle = 'admin';
        $username = Auth::user()->username;

        return view('admin.users.create', compact('userTitle', 'username'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'real_name' => 'required|max:255|string',
            'address' => 'nullable|max:255|string',
            'email' => 'required|email|max:255|unique:profiles',
            'phone_number' => 'nullable|string|max:255|unique:profiles',
            'avatar' => 'nullable|string',
            'role_id' => 'required|integer|between:1,3',
        ]);

        try {
            $user = User::create([
                'username' => $request->get('username'),
                'password' => $request->get('password'),
                'role_id' => $request->get('role_id'),
            ]);

            $profile = Profile::create([
                'user_id' => $user->id,
                'real_name' => $request->get('real_name'),
                'address' => $request->get('address'),
                'email' => $request->get('email'),
                'phone_number' => $request->get('phone_number'),
                'avatar' => $request->get('avatar'),
            ]);



        } catch (QueryException $ex) {
            return redirect()->back()->with('error', 'Cannot add new user!');
        }

        return redirect()->route('admin.users.index')->with('status', '"' . $request->get('username') . '" added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        if($id == Auth::user()->id) {
            return redirect()->route('admin.profile');
        }

        $userTitle = 'admin';
        $user = User::find($id);
        $profile = $user->profile;

        return view('admin.users.profile', [
            'id' => $user->id,
            'username' => $user->username,
            'real_name' => $profile->real_name,
            'email' => $profile->email,
            'phone_number' => $profile->phone_number,
            'address' => $profile->address,
            'avatar' => $profile->avatar,
            'role_id' => $user->role_id,
            'role' => $user->role->role_name,
            'userTitle' => $userTitle,
            'orderList' => $user->orders,
        ]);
    }

    public function showProducts($orderId) {
        $userTitle = 'admin';
        return view('admin.users.product-list', [
            'userTitle' => $userTitle,
            'username' => Auth::user()->username,
            'productList' => Order::find($orderId)->products,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->show($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $profile = $user->profile;

        $request->validate([
            'real_name' => 'required|max:255|string',
            'address' => 'nullable|max:255|string',
            'email' => 'required|email|max:255|unique:profiles,email,' . $profile->id,
            'phone_number' => 'nullable|string|max:255|unique:profiles,phone_number,' . $profile->id,
            'avatar' => 'nullable|string',
            'role_id' => 'required|integer|between:1,3',
        ]);

        $userInput = $request->only('role_id');
        $profileInput = $request->only('real_name', 'address', 'email', 'phone_number', 'avatar');

        try {
            $user->update($userInput);
            $profile->update($profileInput);

        } catch (QueryException $ex) {
            return redirect()->back()->with('error', 'Cannot update user!');
        }

        if($profile->wasChanged() || $user->wasChanged()) {
            return redirect()->back()->with('status', 'User updated!');
        } else {
            return redirect()->back()->with('error', 'No change was made!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        if($id == Auth::user()->id) {
            return redirect()->back()->with('error', 'Cannot delete user "' . Auth::user()->username . '"!');
        }

        $user = User::find($id);
        $username = $user->username;
        $profileId = User::find($id)->profile->id;
        $orders = $user->orders;

        try {
            foreach($orders as $order) {
                $order->products()->detach();
                Order::destroy($order->id);
            }

            Profile::destroy($profileId);
            User::destroy($id);

        } catch (QueryException $ex) {
            return redirect()->back()->with('error', 'Cannot delete user!');
        }

        return redirect()->route('admin.users.index')->with('status', 'User "' . $username . '"' . ' deleted!');
    }
}
