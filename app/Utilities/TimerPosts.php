<?php

namespace App\Utilities;


class TimerPosts 
{


    public static function timer(string $date)
    {
        if($date >= '31404000') {
            return date('Y سال , m ماه و H ساعت' , $date);
        }else if($date >= '2592000') {
            return date('m ماه و H ساعت و i دقیقه' , $date);
        } else if($date >= '86400') {
            return date('d روز و H ساعت ' , $date);
        } else {
            return date('H ساعت و i دقیقه' , $date);
        }
    }

}