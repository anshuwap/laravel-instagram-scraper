<?php

namespace App\Services;

use App\Models\Robot;

set_time_limit(100);



class ProxyChecker  
{
    private $socksOnly = false;

    private const PROXY_TYPE = 'http(s)';

    private $timeout = 20;

    public function CheckMultiProxy($proxies){


        foreach($proxies as $proxy) {

            $ip = explode(':',$proxy)[0];

            $port = explode(':',$proxy)[1];

            $this->CheckSingleProxy($ip , $port);
        }

    }


    private function CheckSingleProxy($ip, $port, $echoResults=true)
    {
       $passByIPPort= $ip . ":" . $port;
        
        
       // You can use virtually any website here, but in case you need to implement other proxy settings (show annonimity level)
       // I'll leave you with whatismyipaddress.com, because it shows a lot of info.
       $url = "http://whatismyipaddress.com/";
        
       // Get current time to check proxy speed later on
       $loadingtime = microtime(true);
        
       $theHeader = curl_init($url);
       curl_setopt($theHeader, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt($theHeader, CURLOPT_TIMEOUT, $this->timeout);
       curl_setopt($theHeader, CURLOPT_PROXY, $passByIPPort);
       
       //If only socks proxy checking is enabled, use this below.
       if($this->socksOnly)
       {
           curl_setopt($theHeader, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
       }
       
       //This is not another workaround, it's just to make sure that if the IP uses some god-forgotten CA we can still work with it ;)
       //Plus no security is needed, all we are doing is just 'connecting' to check whether it exists!
       curl_setopt($theHeader, CURLOPT_SSL_VERIFYHOST, 0);
       curl_setopt($theHeader, CURLOPT_SSL_VERIFYPEER, 0);
        
       //Execute the request
       $curlResponse = curl_exec($theHeader);
        
        
       if ($curlResponse === false) 
       {
           //If we get a 'connection reset' there's a good chance it's a SOCKS proxy
           //Just as a safety net though, I'm still aborting if $socksOnly is true (i.e. we were initially checking for a socks-specific proxy)
           if(curl_errno($theHeader) == 56 && !$this->socksOnly)
           {
               CheckSingleProxy($ip, $port, $this->timeout, $echoResults, true, "socks");
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
       
       $this->updateProxyStatus($arr);
    }


    private function updateProxyStatus(array $proxyStatus)
    {
        $proxy = $proxyStatus['proxy']['ip'] . ':' . $proxyStatus['proxy']['port'];

        if ($proxyStatus['success']) {

            Robot::where('proxy', $proxy)->update([
                'proxy_status' => 'online'
            ]);
        }

        if (!$proxyStatus['success']) {

            Robot::where('proxy', $proxy)->update([
                'proxy_status' => 'offline'
            ]);
        }
            
    }
}