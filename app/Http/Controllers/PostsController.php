<?php

namespace App\Http\Controllers;


use IlluminateHttpRequest;



use AppHttpRequests;


use App\Http\Requests\Scraper\File;
use App\Models\Post;
use App\Models\Robot;
use App\Services\InstagramScraper;
use App\Utilities\ExcelHandler;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as FacadesFile;

class PostsController extends Controller
{
    

    public function showAll()
    {
        $posts = Post::paginate(20);

        return view('archive.all' , ['posts' => $posts]);
    }

    public function add()
    {
        $robots = Robot::all();

        return view('scrap-page.scrap-page' , ['robots' => $robots]);
    }



    public function startScrap(File $request)
    {
        $recivedData = $request->validated();

        $file = $recivedData['pagesFile'];
        $type = FacadesFile::extension($file->getClientOriginalName());

        $robotsID = $recivedData['select-robot'];

        $accountData = ExcelHandler::getDataFromExcel($file , $type);

        try {
            $accountData = $this->validateCountAccountAndRobot($accountData , $robotsID);

            $allLists = array_chunk($accountData , count($accountData)/count($robotsID));

            $dataForScrap = array_combine($robotsID , $allLists);

              
            foreach ($dataForScrap as $id => $list) {
                
                $robot = Robot::find($id);

                $scrap = new InstagramScraper($robot->proxy ,[$robot->username , $robot->password] ,$list);

                $scrap->run(); 
            }

        } catch (\Exception $e) {
            return back()->with('failed' , $e->getMessage());
        }

        return back()->with('success' , 'دریافت دیتا با موفقیت انجام شد');
    }



    private function validateCountAccountAndRobot( array $accountData, array $robotsID )
    {

        if(is_float(count($accountData) / count($robotsID))) {

            $afterDat = explode('.' , strval(count($accountData) / count($robotsID)))[1];

            if(intval(substr($afterDat, 0 ,2)) > 50) {
                $accountData [] = ['saman_xp' , '500'];
            }
            if(intval(substr($afterDat, 0 ,2)) == 50) {
                $accountData [] = ['saman_xp' , '500'];
                $accountData [] = ['saman_xp' , '500'];
            }
            if(intval(substr($afterDat, 0 ,2)) < 50) {
                array_pop($accountData);
            }
        }

        if (is_float(count($accountData) / count($robotsID)))
            throw new \Exception('تعداد پیج ها با تعداد روبات ها همسان نیستند لطفا تعداد پیج ها بر روبات ها بخش پذیر باشد');
            
        return $accountData;
    }

}
