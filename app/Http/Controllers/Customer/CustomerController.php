<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CustomerController extends Controller
{
    public function showProfile() {
        $userTitle = 'customer';

        return view('customer.profile', [
            'username' => Auth::user()->username,
            'real_name' => Auth::user()->profile->real_name,
            'email' => Auth::user()->profile->email,
            'phone_number' => Auth::user()->profile->phone_number,
            'address' => Auth::user()->profile->address,
            'avatar' => Auth::user()->profile->avatar,
            'userTitle' => $userTitle
        ]);
    }

    public function updateProfile(Request $request) {
        $user = Auth::user();
        $profile = Auth::user()->profile;

        $request->validate([
            'real_name' => 'required|max:255|string',
            'address' => 'nullable|max:255|string',
            'email' => 'required|email|max:255|unique:profiles,email,' . $profile->id,
            'phone_number' => 'nullable|string|max:255|unique:profiles,phone_number,' . $profile->id,
            'avatar' => 'nullable|string',
        ]);

        $profileInput = $request->only('real_name', 'address', 'email', 'phone_number', 'avatar');

        try {
            $profile->update($profileInput);

        } catch (QueryException $ex) {
            return redirect()->back()->with('error', 'Cannot update profile!');
        }

        if($profile->wasChanged()) {
            return redirect()->back()->with('status', 'Profile updated!');
        } else {
            return redirect()->back()->with('error', 'No change was made!');
        }
    }
}
