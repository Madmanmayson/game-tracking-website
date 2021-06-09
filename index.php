<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

//require autoload file
require_once('vendor/autoload.php');

session_start();

//instantiate fat-free
$f3 = Base::instance();

$f3->route('GET /', function(){
    $view = new Template();
    echo $view->render('views/home.html');
});

$f3->route('GET|POST /login', function(){
    $view = new Template();
    echo $view->render('views/login.html');
});

$f3->route('GET|POST /register', function(){
    $view = new Template();
    echo $view->render('views/registration.html');
});

$f3->route('GET /profile', function(){
    //TODO check if the username is set in the session. If so, redirect to their profile, otherwise redirect to login or profile search

    $view = new Template();
    echo $view->render('views/home.html');
});

$f3->route('GET /search', function(){
    $view = new Template();
    echo $view->render('views/home.html');
});

$f3->run();