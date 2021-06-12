<?php

// API required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require (getenv("HOME").'/DBConnect.php');
$database = new Database();
$cnxn = $database->connect();

//this is my controller for the pets project
ini_set('display_errors',1);
error_reporting(E_ALL);

//require autoload file
require_once('vendor/autoload.php');

//instantiate fat-free
$f3 = Base::instance();

//define default route
//Create a new user
$f3->route('POST /api/user/create', function($f3){

    $data = json_decode(file_get_contents("php://input"));

    $user = new User();

    // email, username, password
    $user->setPassword($data->password);
    $user->setUserName($data->username);
    $user->setEmail($data->email);

    $query = 'INSERT INTO `users` (username, password, email) VALUES (:username, SHA2(:password, 256), :email)';

    $statement = $GLOBALS['cnxn']->prepare($query);
    $statement->bindParam(':username', $user->getUserName(), PDO::PARAM_STR);
    $statement->bindParam(':password', $user->getPassword(), PDO::PARAM_STR);
    $statement->bindParam(':email', $user->getEmail(), PDO::PARAM_STR);

    if($statement->execute()){
        http_response_code(201);

        echo json_encode(array('message' => 'User created successfully'));
    } else {
        http_response_code(503);

        echo json_encode(array('message' => $statement->errorInfo()));
    }
});

//Get a user based on param
$f3->route('GET /api/user/@username', function($f3, $params){
    $username = $params['username'];

    $query = 'SELECT userId, username, email FROM users WHERE username = :username';

    $statement = $GLOBALS['cnxn']->prepare($query);
    $statement->bindParam(':username', $username, PDO::PARAM_STR);

    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);


    if($result){
        http_response_code(200);

        echo json_encode($result);
    } else {
        http_response_code(404);

        echo json_encode(array('message' => 'Username does not exist.'));
    }
});

$f3->route('GET /api/*', function($f3, $params){
    echo var_dump($params) . ' Test';
});

$f3->route('GET /profile/@username', function($f3, $params){
    echo $params['username'];
});

//run fat-free
$f3->run();