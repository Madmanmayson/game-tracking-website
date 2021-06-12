<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

//require autoload file
require_once('vendor/autoload.php');

session_start();


//instantiate fat-free
$f3 = Base::instance();
$con = new Controller($f3);

$f3->route('GET /', function(){
    $GLOBALS['con']->home();
});

$f3->route('GET|POST /login', function(){
    $GLOBALS['con']->login();
});

$f3->route('GET|POST /register', function(){
    $GLOBALS['con']->registration();
});

$f3->route('GET /profile', function(){
    $GLOBALS['con']->profile();
});

$f3->route('GET /search', function(){
    $GLOBALS['con']->search();
});

$f3->run();