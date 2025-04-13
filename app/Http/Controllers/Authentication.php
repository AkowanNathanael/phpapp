<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authentication extends Controller
{
    //
    public function register(Request $request){
        $validated=$request->validate([
            "name"=>["required","string","min:3"],
            "email"=>["required","email", "unique:users,email"],
            "password"=>["required", "confirmed","min:4"]
        ]);
        
        $user=User::create($validated);
        Auth::login($user);
        return redirect("/admin/dashboard");
    }

    public function login(Request $request){
        $validatedfields=$request->validate([
            "email"=>[ "required","email"],
            "password"=>["required"]
        ]);
        // dd($request->remember);
        if(Auth::attempt($validatedfields, $request->remember)){
            // dd("ok");
            return redirect()->intended("/admin/dashboard");
        }else{
            return back()->withErrors(["email"=>"user entered wrong credentials"]);
        }
    }
}
