<?php

namespace App\Http\Controllers\Editor;

use App\Models\Profile;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EditorController extends Controller
{
    public function index()
    {
        $userTitle = 'editor';

        return view('editor.home', [
            'userTitle' => $userTitle,
            'username' => Auth::user()->username,
            'avatar' => Auth::user()->profile->avatar,
        ]);
    }

    public function showProfile() {
        $userTitle = 'editor';
        $profile = Auth::user()->profile;

        return view('editor.profile', [
            'username' => Auth::user()->username,
            'real_name' => $profile->real_name,
            'email' => $profile->email,
            'phone_number' => $profile->phone_number,
            'address' => $profile->address,
            'avatar' => $profile->avatar,
            'userTitle' => $userTitle
        ]);
    }

    public function updateProfile(Request $request) {
        $user = Auth::user();
        $profile = $user->profile;

        $request->validate([
            'real_name' => 'required|max:255|string',
            'address' => 'nullable|max:255|string',
            'email' => 'required|email|max:255|unique:profiles,email,' . $profile->id,
            'phone_number' => 'nullable|string|max:255|unique:profiles,phone_number,' . $profile->id,
            'avatar' => 'nullable|string|max:255',
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
