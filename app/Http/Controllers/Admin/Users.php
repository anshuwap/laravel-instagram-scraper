<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\StoreUser;
use App\Http\Requests\Admin\Users\UserUpdate;
use App\Models\User;
use App\Traits\Enum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Users extends Controller
{
    use Enum;

    

    public static function getGravatarUser()
    {
        $hash = md5(strtolower(trim(Auth::user()->email)));
        return "http://www.gravatar.com/avatar/$hash";
    }

   
    public function showAll()
    {
        $users = User::paginate(15);
        
        return view('admin.users' , ['users' => $users]);
    }

    public function store(StoreUser $request)
    {
        $recivedData = $request->validated();
        
        try {
            User::firstOrCreate(['email' => $recivedData['email']],[
                'name' => $recivedData['name'],
                'number' => $recivedData['number'],
                'permission' => $recivedData['permission'],
                'password' => Hash::make($recivedData['password'])
            ]);
        } catch (\Exception $e) {
            return back()->with('failed' , $e->getMessage());
        }

        return back()->with('success' , 'کاربر ایجاد شد');
    }

    public function add()
    {
        $permissions = $this->getEnumFields('users' , 'permission');

        return view('admin.add-user' , ['permissions' => $permissions]);
    }

    public function delete(int $user_id)
    {
        User::find($user_id)->delete();

        return back()->with('success' , 'کاربر حذف شد');
    }


    public function edit(int $user_id)
    {
        $user = User::find($user_id);

        $permissions = $this->getEnumFields('users' , 'permission');

        return view('admin.user-edit' , ['user' => $user , 'permissions' => $permissions]);
    }

    public function update(UserUpdate $request ,int $user)
    {
        $recivedData = $request->validated();

        try {
            User::find($user)->update([
                'name' => $recivedData['name'],
                'number' => $recivedData['number'],
                'email' => $recivedData['email'],
                'permission' => $recivedData['permission']
            ]);
        } catch (\Exception $e) {
            return back()->with('failed' , $e->getMessage());
        }

        return back()->with('success' , 'کاربر بروزرسانی شد');
    }

}
