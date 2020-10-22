<?php

namespace App\Http\Controllers;

use App\Mail\ResetLink;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login()
    {
        return view("login");
    }

    public function check(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        $data = $request->only("email", "password");
        auth()->attempt($data, $request->remember_me);
        if (!auth()->check())
            return redirect()->back()->with("danger", "Invalid credentials, Please try again!");
        return redirect()->route('site.home')->with("success", "Login successfully!");
    }

    public function register()
    {
        return view("register");
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'email' => 'required|email:dns|unique:users,email',
            'password' => 'required|min:6'
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        User::create($data);
        return redirect()->back()->with("success", "Your account created successfully");
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->back();
    }

    public function forgotPassword()
    {
        return view('forgot-password');
    }

    public function resetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns|exists:users,email'
        ], [
            'email.exists' => 'This email address does not exists.'
        ]);
        $account = User::where('email', $request->email)->first();
        if (!empty($account->resetPassword))
            $account->resetPassword()->delete();
        $token = uniqid();
        $account->resetPassword()->create([
            'token' => $token
        ]);
        Mail::to($account->email)->send(new ResetLink($account, $token));
        return redirect()->back()->with('success', 'Password reset link send successfully!');
    }

    public function resetPassword()
    {
        return view('reset-password');
    }

    public function setNewPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|max:40',
            'confirm_password' => 'required|same:password'
        ]);
        $a = null;
        $t = null;
        try {
            $a = decrypt($request->a);
            $t = decrypt($request->t);
        } catch (\Exception $exception) {

        }
        $account = User::find($a);
        if (empty($account))
            return redirect()->back()->with('danger', 'Invalid reset account');
        if (empty($t))
            return redirect()->back()->with('danger', 'Invalid reset token');
        if (empty($account->resetPassword) || $account->resetPassword->token != $t)
            return redirect()->back()->with('danger', 'Incorrect reset token');
        $account->update(['password' => bcrypt($request->password)]);
        $account->resetPassword()->delete();
        return redirect()->back()->with('success', 'Your account password reset successfully!');
    }

}
