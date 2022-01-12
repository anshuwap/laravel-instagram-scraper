<?php

$propagendaPatternTag = '/@[a-zA-Z0-9.\-_]+/';
$res= preg_match($propagendaPatternTag , ' ffjsdffjfjjfsjdf @8787e  sdasdasd ' , $match);

var_dump($res);