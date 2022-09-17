<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function logOut(Request $req)
    {
        $req->session()->flush();
        return redirect('/login');
    }
    public function onlogin(Request $req)
    {
        $user = $req->input('user');
        $pass = md5($req->input('pass'));
        $loginData = admin::where('userName',$user)->where('password',$pass)->count();
        if ($loginData==true) {
            $req->session()->put('user',$user);
            return 1;
        }else{
            return 0;
        }
    }
}
