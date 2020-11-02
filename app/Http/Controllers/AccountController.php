<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function profile()
    {
        return view('profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'first_name' => 'required|alpha|max:20',
            'last_name' => 'required|alpha|max:20',
            'email' => 'required|email:dns|unique:users,email,' . auth()->id(),
        ]);

        auth()->user()->update($request->all());

        return redirect()->back()->with('success', 'Profile details updated successfully!');
    }

    public function changePassword()
    {
        return view('change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|max:40|different:current_password',
            'confirm_password' => 'required|same:new_password',
        ]);

        if (!Hash::check($request->current_password, auth()->user()->password))
            return redirect()->back()->with('danger', 'Password does not match');
        auth()->user()->update(['password' => bcrypt($request->new_password)]);
        return redirect()->back()->with('success', 'Your account password updated, Please login with new password for next time');
    }

    public function followers()
    {
        return view('followers');
    }

    public function followings()
    {
        return view('followings');
    }

    public function userProfile(User $user)
    {
        return view('user-profile', [
            'user' => $user
        ]);
    }

    public function doFollow(User $user)
    {
        $user->followings()->detach(auth()->user()->id);
        $user->followings()->attach(auth()->user()->id);
        return redirect()->back();
    }

    public function doUnFollow(User $user)
    {
        $user->followings()->detach(auth()->user()->id);
        return redirect()->back();
    }

    public function userFollowers(User $user)
    {
        return view('user-followers', compact('user'));
    }

    public function userFollowings(User $user)
    {
        return view('user-followings', compact('user'));
    }

}
