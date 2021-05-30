<?php

//this is my controller for the pets project
ini_set('display_errors',1);
error_reporting(E_ALL);

//require autoload file
require_once('vendor/autoload.php');

//instantiate fat-free
$f3 = Base::instance();

//define default route
$f3->route('GET /api/*', function($f3, $params){
    echo var_dump($params) . ' Test';
});

//run fat-free
$f3->run();