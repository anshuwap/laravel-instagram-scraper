<?php

namespace App\Services;

use App\Models\Robot;
use Illuminate\Database\Eloquent\Model;

set_time_limit(300);



class ProxyChecker  
{
    private $socksOnly = false;

    private const PROXY_TYPE = 'http(s)';

    private $timeout = 20;


    public function CheckMultiProxy($proxies ,Model $model){


        foreach($proxies as $proxy) {

            $ip = explode(':',$proxy)[0];

            $port = explode(':',$proxy)[1];

            $this->CheckSingleProxy($ip , $port , $model);
        }

    }


    private function CheckSingleProxy($ip, $port,Model $model ,$echoResults=true)
    {
       $passByIPPort= $ip . ":" . $port;
        
       $url = "http://whatismyipaddress.com/";
        
       $loadingtime = microtime(true);
        
       $theHeader = curl_init($url);
       curl_setopt($theHeader, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt($theHeader, CURLOPT_TIMEOUT, $this->timeout);
       curl_setopt($theHeader, CURLOPT_PROXY, $passByIPPort);
       
       if($this->socksOnly)
       {
           curl_setopt($theHeader, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
       }

       curl_setopt($theHeader, CURLOPT_SSL_VERIFYHOST, 0);
       curl_setopt($theHeader, CURLOPT_SSL_VERIFYPEER, 0);
        
       //Execute the request
       $curlResponse = curl_exec($theHeader);
        
        
       if ($curlResponse === false) 
       {

        if(curl_errno($theHeader) == 56 && !$this->socksOnly)
           {
               $this->CheckSingleProxy($ip, $port, $model , $echoResults);
               return;
           }
           
           $arr = array(
            "success" => false,
            "error" => curl_error($theHeader),
            "proxy" => array(
                "ip" => $ip,
                "port" => $port,
                "type" => self::PROXY_TYPE)
           );
       } 
       else 
       {
           $arr = array(
            "success" => true,
            "proxy" => array(
                "ip" => $ip,
                "port" => $port,
                "speed" => floor((microtime(true) - $loadingtime)*1000),
                "type" => self::PROXY_TYPE)
           );
       }
       
       $this->updateProxyStatus($arr , $model);
    }

    // public function CheckMultiProxy($proxies ,Model $model)
	// {
   
	// 	$data = array();
	// 	foreach($proxies as $proxy)
	// 	{
	// 		$parts = explode(':', trim($proxy));
	// 		$url = strtok($this->curPageURL(),'?');
	// 		$data[] = $url . '?ip=' . $parts[0] . "&port=" . $parts[1] . "&timeout=" . $this->timeout . "&proxy_type=" . self::PROXY_TYPE;
	// 	}
	// 	$results = $this->multiRequest($data);
    //     dd($results);
	// 	$holder = array();
	// 	foreach($results as $result)
	// 	{
			
	// 		$holder[] = json_decode($result, true)["result"];
	// 	}
	// 	$arr = array("results" => $holder);
		
    //     dd($arr);
	// }


    // private function multiRequest($data, $options = array()) 
	// {
	 
	//   // array of curl handles
	//   $curly = array();
	//   // data to be returned
	//   $result = array();
	 
	//   // multi handle
	//   $mh = curl_multi_init();
	 
	//   // loop through $data and create curl handles
	//   // then add them to the multi-handle
	//   foreach ($data as $id => $d) {
	 
	// 	$curly[$id] = curl_init();
	 
	// 	$url = (is_array($d) && !empty($d['url'])) ? $d['url'] : $d;
	// 	curl_setopt($curly[$id], CURLOPT_URL,            $url);
	// 	curl_setopt($curly[$id], CURLOPT_HEADER,         0);
	// 	curl_setopt($curly[$id], CURLOPT_RETURNTRANSFER, 1);
	 
	// 	// post?
	// 	if (is_array($d)) {
	// 	  if (!empty($d['post'])) {
	// 		curl_setopt($curly[$id], CURLOPT_POST,       1);
	// 		curl_setopt($curly[$id], CURLOPT_POSTFIELDS, $d['post']);
	// 	  }
	// 	}
	 
	// 	// extra options?
	// 	if (!empty($options)) {
	// 	  curl_setopt_array($curly[$id], $options);
	// 	}
	 
	// 	curl_multi_add_handle($mh, $curly[$id]);
	//   }
	 
	//   // execute the handles
	//   $running = null;
	//   do {
	// 	curl_multi_exec($mh, $running);
	//   } while($running > 0);
	 
	 
	//   // get content and remove handles
	//   foreach($curly as $id => $c) {
	// 	$result[$id] = curl_multi_getcontent($c);
	// 	curl_multi_remove_handle($mh, $c);
	//   }
	 
	//   // all done
	//   curl_multi_close($mh);
	 
	//   return $result;
	// }
    
    // private function curPageURL() {

    //     $pageURL = 'http';

    //     if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
    //         $pageURL .= "s";
    //     }

    //     $pageURL .= "://";

    //     if ($_SERVER["SERVER_PORT"] != "80") {
    //         $pageURL .= $_SERVER["SERVER_NAME"] . ":" .
    //             $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    //     } else {
    //         $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    //     }

    //     return $pageURL;

    // }


    private function updateProxyStatus(array $proxyStatus , Model $model)
    {
        $proxy = $proxyStatus['proxy']['ip'] . ':' . $proxyStatus['proxy']['port'];
  
        if ($proxyStatus['success']) {

            $model::where('proxy', $proxy)->update([
                'proxy_status' => 'online'
            ]);
        }

        if (!$proxyStatus['success']) {

            $model::where('proxy', $proxy)->update([
                'proxy_status' => 'offline'
            ]);
        }
            
    }
}
