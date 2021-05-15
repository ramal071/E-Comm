<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function login(Request $req)
    {
        // return $req->input();
        $user= User::where(['email'=>$req->email])->first();
        // return $user->password;
        if(!$user || !Hash::check($req->password,$user->password))
        {
            return "Username or password not match";
        }
        else {
            $req->session()->put('user', $user);
            return redirect('/');
        }
    }

    function register(Request $req)
    {
        // return $req->input();
        $user = new User;
        $user->name=$req->name;
        $user->email=$req->email;
        $user->password=Hash::make($req->name);
        $user->save();
        return redirect('/login');
    }
}
