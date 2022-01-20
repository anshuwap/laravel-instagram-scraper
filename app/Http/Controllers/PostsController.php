<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\Proxies;

use App\Http\Requests\Scraper\File;
use App\Models\Post;
use App\Models\Robot;
use App\Services\InstagramScraper;
use App\Utilities\ExcelHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File as FacadesFile;


class PostsController extends Controller
{
    

    public function showAll()
    {
        $posts = Post::paginate(20);

        return view('archive.all' , ['posts' => $posts]);
    }


    public function single(int $post_id)
    {
        $post = Post::find($post_id);
        
        return view('archive.single', ['post' => $post]);
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

            Proxies::changProxiesForRobot($robotsID);

        } catch (\Exception $e) {
            return back()->with('failed' , $e->getMessage());
        }

        return back()->with('success' , ' دریافت دیتا با موفقیت انجام شد و پروکسی ربات ها عوض شدند');
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

    
    public function deleteAll(Request $request)
    {
        $idForDelete = $request->get('delete') ;

        try {
            $postsForDelete = Post::whereIn('id', $idForDelete)->get();

            foreach ($postsForDelete->toArray() as $post) {
    
                $this->deleteFile($post['thumbnail_url'] , $post['source_url'] , $post['type_media']);
            }
    
            Post::whereIn('id', $idForDelete)->delete();
    
        } catch (\Exception $e) {
            return back()->with('failed' , $e->getMessage());
        }

        return back()->with('success' , 'پست های انتخاب شده حذف شدند');

    }


    public function deleteOne($post_id)
    {
        try {
            $post = Post::find($post_id);

            $this->deleteFile($post->thumbnail_url , $post->source_url , $post->type_media);

            Post::find($post_id)->delete();

        } catch (\Exception $e) {
            return back()->with('failed' , $e->getMessage());
        }

        return back()->with('success' , 'پست حذف شد');
    }


    private function deleteFile(string $thumbnail_url , string $source_url ,string $type_media)
    {
        if (file_exists(public_path('uploads/') . $thumbnail_url))
            FacadesFile::delete(public_path('uploads/') . $thumbnail_url);

        if ($type_media == 'sidecar') {

            foreach (unserialize($source_url) as $path) {
                
                if (file_exists(public_path('uploads/') . $path))
                    FacadesFile::delete(public_path('uploads/') . $path);

            }
        } else {

            if (file_exists(public_path('uploads/') . $source_url))
                FacadesFile::delete(public_path('uploads/') . $source_url);
        }
    }
}
