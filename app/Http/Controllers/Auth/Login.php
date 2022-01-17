<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Login\LoginUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Login extends Controller
{
    public function showPage()
    {
        return view('auth.sign-in');
    }

    public function loginUser(LoginUser $request)
    {
        $recivedData = $request->validated();

        
        if (!Auth::attempt($recivedData))
            return back()->with('failed' , 'کاربر قبلا ثبت نشده است');

        if (Auth::guard()->user()->permission != 'admin')
             return view('errors.not-admin');

        
        return redirect()->route('admin.home')->with('success' , 'وارد شدید');


    }
}
