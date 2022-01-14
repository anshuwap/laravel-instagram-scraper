<?php


exec("ping ".'101.230.8.69:8000', $output, $status);

var_dump($output) . PHP_EOL;

var_dump($status);