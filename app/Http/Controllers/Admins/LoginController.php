<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('admins.login');
    }
    public function loginPost(Request $request)
    {
        if(Auth::guard('admin')->attempt([
            'email'=>$request->email,
            'password'=>$request->password
        ])){
            return redirect('/admins/dashboard');
        }
        return view('admins.login');
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect("/admins");
    }
}
