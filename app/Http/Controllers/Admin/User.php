<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class User extends Controller
{
    

    public static function getGravatarUser()
    {
        $hash = md5(strtolower(trim(Auth::user()->email)));
        return "http://www.gravatar.com/avatar/$hash";
    }
}
