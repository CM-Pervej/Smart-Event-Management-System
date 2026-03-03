<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // registration 
    public function registration(Request $request){
    // input validation     
    $request->validate([
            'name'      => 'required|string|max:255',
            'phone'     => 'required|string|unique:users',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|string|min:6|confirmed',
            'terms'     => 'accepted',
        ]);

        User::create([
            'name'      => $request->name,
            'phone'     => $request->phone,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Account created successfully!');
    }

    // login 
    public function login(Request $request){
        // input validation 
        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required|string',
        ]);

        // find user by email 
        $user = User::where('email', $request->email)->first();

        // check user if exits and password matches 
        if($user && Hash::check($request->password, $user->password)){
            $minutes = 60*24;
            Cookie::queue('user_id', $user->id, $minutes);
            Cookie::queue('user_name', $user->name, $minutes);

            return redirect()->route('dashboard')->with('success', 'Login Successful!');
        }

        // if credentials are wrong 
        return back()->withErrors([
            'email' => 'Invalid email or password'
        ])->withInput();
    }

    public function dashboard(Request $request){
        $userName = $request->cookie('user_name');

        if(!$userName){
            return redirect()->route('login')->with('error', 'Please login first');
        }

        return view('dashboard', compact('userName'));
    }

    // logged out 
    public function logout(){
        Cookie::queue(Cookie::forget('user_id'));
        Cookie::queue(Cookie::forget('user_name'));
        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
}
