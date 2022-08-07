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
            if(auth()->user()->role == 0){
                return redirect()->route('home.dashboard');
            }elseif (auth()->user()->role == 1 || auth()->user()->role == 2 ){
                return redirect()->route('home.frontend');
            }
            

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
