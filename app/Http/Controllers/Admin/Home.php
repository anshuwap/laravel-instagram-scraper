<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Robot;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Home extends Controller
{
    
    public function index()
    {
        $countPosts = Post::all()->count();
        $usersCount = User::all()->count();
        $robotsCount = Robot::all()->count();

        $robots = Robot::all();

        return view('admin.index' , [

            'postCount' => $countPosts,
            'usersCount' => $usersCount,
            'robotsCount' => $robotsCount,

        ]);
    }
    
}
