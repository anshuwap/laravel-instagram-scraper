<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\CheckAdmin;
use App\Models\Post;
use App\Models\Proxy;
use App\Models\Robot;
use App\Models\User;




class Home extends Controller
{

    public function index()
    {
        $countPosts = Post::all()->count();
        $usersCount = User::all()->count();
        $robotsCount = Robot::all()->count();
        $proxiesCount = Proxy::all()->count();

        $robots = Robot::all();

        return view('admin.index' , [

            'postCount' => $countPosts,
            'usersCount' => $usersCount,
            'robotsCount' => $robotsCount,
            'proxiesCount' => $proxiesCount,

        ]);
    }
    
}
