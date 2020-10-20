<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
}
