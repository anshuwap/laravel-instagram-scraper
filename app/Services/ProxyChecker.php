<?php

namespace App\Services;

use App\Models\Proxy;
use App\Models\Robot;
use Illuminate\Database\Eloquent\Model;

set_time_limit(300);



class ProxyChecker  
{


    public function CheckMultiProxy($proxies ,Model $model){

        foreach($proxies as $proxy) {

            $this->CheckSingleProxy($proxy , $model);
        }

    }



    public function checkSingleProxy($proxy , Model $model)
    {

        $passByIPPort= $proxy;

        $proxyStatus = [
            'proxy' => $passByIPPort
        ];
        
        $url = "https://www.digi77.com/software/bouncer/data/myipvv-by-web.php";

        
        $theHeader = curl_init($url);
        curl_setopt($theHeader, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($theHeader, CURLOPT_TIMEOUT, 20);
        curl_setopt($theHeader, CURLOPT_PROXY, $passByIPPort); 
        
        //Execute the request
        $curlResponse = curl_exec($theHeader);
        curl_close($theHeader);

        $proxyStatus['success'] = true;

        if ($curlResponse == false)
            $proxyStatus['success'] = false;

        
        $this->updateProxyStatus($proxyStatus , $model);
   
    }



    private function updateProxyStatus(array $proxyStatus , Model $model)
    {

        if ($proxyStatus['success']) {

            $model::where('proxy', $proxyStatus['proxy'])->update([
                'proxy_status' => 'online'
            ]);
        }

        if (!$proxyStatus['success']) {

            $model::where('proxy', $proxyStatus['proxy'])->update([
                'proxy_status' => 'offline'
            ]);
        }
            
    }



    public static function changProxiesForRobot(array $robotsID)
    {
        $robots = Robot::whereIn('id', $robotsID)->get()->toArray();
        
        $proxies= array_slice(array_column(Proxy::select('proxy')->get()->toArray() , 'proxy') ,0 , count($robots));

        foreach (array_combine($proxies , $robots) as $proxy => $robot) {
            
            Robot::find($robot['id'])->update(['proxy' => $proxy]);
        }

        Proxy::whereIn('proxy', $proxies)->delete();
    }
}
