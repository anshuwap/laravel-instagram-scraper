<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Register\StoreUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Register extends Controller
{
    
    public function showPage()
    {
        return view('auth.sign-up');
    }


    public function store(StoreUser $request)
    {
        try {
            $resicedData = $request->validated();

            User::create([
                'name' => $resicedData['name'],
                'email' => $resicedData['email'],
                'number' => $resicedData['number'],
                'password' => Hash::make($resicedData['password'])
            ]);
        } catch (\Exception $e) {
            return back()->with('failed' , $e->getMessage());
        }

        return redirect()->route('login.showPage')->with('success' , 'ثبت نام شما با موفقیت انجام شد');
    }
}
