<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Proxy;
use App\Models\Robot;
use App\Services\ProxyChecker;
use App\Utilities\ExcelHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File as FacadesFile;

class Proxies extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function showAll()
    {
        $proxies = Proxy::paginate(15);
        
        return view('admin.list-proxies' , ['proxies' => $proxies]);
    }

    public function checkProxies()
    {
        try {
            $proxiesName = array_column(Proxy::select('proxy')->get()->toArray() , 'proxy');

            $checkProxies = new ProxyChecker();

            $checkProxies->CheckMultiProxy(array_slice($proxiesName , 0 , Robot::all()->count() + 4) , new Proxy());
        } catch (\Exception $e) {
            return back()->with('failed' , $e->getMessage());
        }

        return back()->with('success' , 'چند پروکسی اول برای استفاده شما بروزرسانی وضعیت شدند');
    }


    public function add()
    {
        
        return view('admin.add-proxies');
    }


    public function store(Request $request)
    {
        $recivedData = $request->validate([
            'proxiesFile' => 'required',
        ]);

        try {
            $file = $recivedData['proxiesFile'];
            $type = FacadesFile::extension($file->getClientOriginalName());

            $proxiesByArray = array_column(ExcelHandler::getDataFromExcel($file , $type) , 0);

            foreach ($proxiesByArray as $proxy) {

                if (empty($proxy))
                    continue;

                Proxy::firstOrCreate(['proxy' => $proxy] ,[

                    'proxy_status' => 'online'
                ]);
        }
        } catch (\Exception $e) {
            return back()->with('failed' , $e->getMessage());
        }
        
        return redirect()->route('proxies.showAll')->with('success' , 'پروکسی ها ذخیره شدند');
    }


    public function delete($proxy_id)
    {
        Proxy::find($proxy_id)->delete();

        return back()->with('success' , 'پروکسی حذف شد');
    }


    public function deleteAll(request $request)
    {
        $idForDelete = $request->get('delete-proxies');

        Proxy::whereIn('id', $idForDelete)->delete();

        return back()->with('success' , 'پروکسی ها حذف شد');
    }


    public static function changProxiesForRobot()
    {
        $robots = Robot::all()->toArray();

        $proxies= array_slice(array_column(Proxy::select('proxy')->get()->toArray() , 'proxy') ,0 , count($robots));
        
        foreach (array_combine($proxies , $robots) as $proxy => $robot) {
            
            $robot->update(['proxy' => $proxy]);
        }

        Proxy::whereIn('proxy', $proxies)->delete();
    }
}
