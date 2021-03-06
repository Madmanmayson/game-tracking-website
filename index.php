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

$f3->route('GET /logout', function(){
    $GLOBALS['con']->logout();
});

$f3->route('GET|POST /registration', function(){
    $GLOBALS['con']->registration();
});

$f3->route('GET /profile', function(){
    if(isset($_GET['username'])){
        header('location: profile/' . $_GET['username']);
        die;
    }
    if(isset($_SESSION['user']) && $_SESSION['user']->getUserName() != ""){
        header('location: profile/' . $_SESSION['user']->getUserName());
        die;
    }
    else {
        $view = new Template();
        echo $view->render('views/no-profile.html');
    }
});

$f3->route('GET /profile/@username', function($f3, $params){
    $GLOBALS['con']->profile($params['username']);
});

$f3->route('GET /search', function(){
    $GLOBALS['con']->search();
});

$f3->route('GET|POST /add-game', function(){
    $GLOBALS['con']->adminAddGame();
});

$f3->run();