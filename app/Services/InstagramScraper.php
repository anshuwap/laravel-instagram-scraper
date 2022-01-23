<?php
namespace App\Services;

set_time_limit(0);


use App\Models\Post;
use App\Utilities\Downloader;
use GuzzleHttp\Client;
use Phpfastcache\Helper\Psr16Adapter;

class InstagramScraper
{

    private const TPMD_VIDEO   = 'video';

    private const TPMD_IMG     = 'image';

    private const TPMD_SIDECAR = 'sidecar';

    private const TP_POST      = 'post';

    protected $instagram ;

    protected $mediaLinks = [];

    private   $client;

    private   $accountsData = [];



    public function __construct(string $proxy = null, array $myAcc = [], array $accountsData = [])
    {
        $this->accountsData = $accountsData;  
 
        try {
            
            $this->client = new Client([
                'base_uri' => 'https://www.instagram.com/',
                'connect_timeout' => 25,
                'read_timeout' => 25,
                'timeout' => 28,
                'request.options' => [
                    'proxy' => 'tcp://'. $proxy ,
                ],
            ]);
    
            $this->instagram = \InstagramScraper\Instagram::withCredentials($this->client,$myAcc[0] ,$myAcc[1],new Psr16Adapter('Files'));
      
            $this->instagram->login();
            $this->instagram->saveSession();  
            
        } catch (\Exception $e) {
            return back()->with('failed' , $e->getMessage());
        }
        
    }



    public function run()
    {
        foreach ($this->accountsData as $account) {

            $username = $account[0];
            $like = $account[1];

            $instagramAcc = $this->instagram->getAccount($username);

            if(is_null($instagramAcc))
                continue;

            if($instagramAcc->isPrivate()){

                $this->instagram->follow($this->instagram->getAccount($username)->getId());
                continue;
            }

            $posts = $this->instagram->getMedias($username , 10);

            $this->storePost($posts , $username , $like);
        }
        
    }



    private function storePost(array $medias ,string $username ,int $likeLimit)
    {
        foreach ($medias as $media) {

            $postData = [
                'username' => $username,
                'ID' => $media->getId(),
                'like' => $media->getLikesCount(),
                'comment' => $media->getCommentsCount(),
                'view' => $media->getVideoViews(),
                'time' => $media->getCreatedTime(),
                'captionOfPost' => $media->getCaption(),
                'image_url' => $media->getImageStandardResolutionUrl(),
                'video_url' => $media->getVideoStandardResolutionUrl(),
                'sidecar' => $media->getSidecarMedias(),
            ];

            # Check Media Exist in Database Or notExist
            $existPost = Post::where('ID_instagram' , $postData['ID'])->get();

            if(empty($existPost->toArray())) {

                # Validate that this post is a prppagend Post or Not
                $propagendaPatternTag = '/@[a-zA-Z0-9.\-_]+/';
                preg_match($propagendaPatternTag , $postData['captionOfPost'] , $match);

                if(empty($match))
                    continue;

                if (strtolower($match[0]) == '@'.$username)
                    continue;

                # Ditermine Limit of like Posts
                $limitLike = !empty($likeLimit) ?  $likeLimit : 20000;

                if($postData['like'] < intval($limitLike))
                    continue;

                # Listed Post by Type of theim {One Video , One Image or SideCar Post}
                if ($media->getType() === 'video')
                    $this->videoPost($postData , $match[0]);

                if ($media->getType() === 'image')
                    $this->imagePost($postData , $match[0]);

                if ($media->getType() === 'sidecar')
                    $this->sidecarPost($postData , $match[0]);
            }
        }
    }


    private function videoPost(array $postData ,string $tag)
    {
        $coverPath = Downloader::downloadFile($postData['image_url'] , $postData['ID'] , self::TPMD_IMG);
        $path      = Downloader::downloadFile($postData['video_url'] , $postData['ID'], self::TPMD_VIDEO);

        Post::create([
            'ID_instagram' => $postData['ID'],
            'thumbnail_url' => $coverPath ,
            'source_url' => $path,
            'captions' => $postData['captionOfPost'],
            'view' => $postData['view'],
            'like' => $postData['like'],
            'comment' => $postData['comment'],
            'owner' => $postData['username'],
            'tag' => $tag,
            'type_media' => self::TPMD_VIDEO,
            'date' => time() - $postData['time']
        ]);
        
    }


    private function imagePost(array $postData ,string $tag)
    {
        $path = Downloader::downloadFile($postData['image_url'], $postData['ID'] , self::TPMD_IMG);

        Post::create([
            'ID_instagram' => $postData['ID'],
            'thumbnail_url' => $path,
            'source_url' => $path,
            'captions' => $postData['captionOfPost'],
            'view' => $postData['view'],
            'like' => $postData['like'],
            'comment' => $postData['comment'],
            'owner' => $postData['username'],
            'tag' => $tag,
            'type_media' => self::TPMD_IMG,
            'date' => time() - $postData['time']
        ]);
    }


    private function sidecarPost(array $postData ,string $tag)
    {
        $sidecarMedia = [];
        
        $coverPath = Downloader::downloadFile($postData['image_url'] , $postData['ID'] , self::TPMD_IMG);
        
        foreach ($postData['sidecar'] as $media){
            
            if($media->getType() == 'video')
                $sidecarMedia[] = Downloader::downloadFile($media->getVideoStandardResolutionUrl() , $postData['ID'] , self::TPMD_VIDEO);

            if($media->getType() == 'image')
                $sidecarMedia[] = Downloader::downloadFile($media->getImageStandardResolutionUrl() , $postData['ID'] , self::TPMD_IMG);
            
        }

        Post::create([
            'ID_instagram' => $postData['ID'],
            'thumbnail_url' => $coverPath ,
            'source_url' => serialize($sidecarMedia),
            'captions' => $postData['captionOfPost'],
            'view' => $postData['view'],
            'like' => $postData['like'],
            'comment' => $postData['comment'],
            'owner' => $postData['username'],
            'tag' => $tag,
            'type_media' => self::TPMD_SIDECAR,
            'date' => time() - $postData['time']
        ]);
    }
}