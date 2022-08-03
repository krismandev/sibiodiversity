<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            "email" => "required",
            "password"=>"required",
        ]);
        $creds = $request->only(['email','password']);

        if (auth()->attempt($creds)) {
            return redirect()->route('home');
        }else{
            return redirect()->back()->with("error","Password atau username salah");
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route("login");
    }
}
