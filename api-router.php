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

$f3->route('POST /api/login', function(){
    $data = json_decode(file_get_contents("php://input"));

    $query = 'SELECT username, userId, isAdmin FROM users WHERE username = :username AND password = SHA2(:password, 256)';

    $statement = $GLOBALS['cnxn']->prepare($query);
    $statement->bindParam(':username', $data->username, PDO::PARAM_STR);
    $statement->bindParam(':password', $data->password, PDO::PARAM_STR);

    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if($result){
        http_response_code(200);

        echo json_encode($result);
    } else {
        http_response_code(401);

        echo json_encode(array('message' => 'Incorrect username or password. Please try again.'));
    }
});

//define default route
//Create a new user
$f3->route('POST /api/users', function($f3){

    $data = json_decode(file_get_contents("php://input"));

    $query = 'INSERT INTO `users` (username, password, email) VALUES (:username, SHA2(:password, 256), :email)';

    $statement = $GLOBALS['cnxn']->prepare($query);
    $statement->bindParam(':username', $data->username, PDO::PARAM_STR);
    $statement->bindParam(':password', $data->password, PDO::PARAM_STR);
    $statement->bindParam(':email', $data->email, PDO::PARAM_STR);

    if($statement->execute()){
        http_response_code(201);

        echo json_encode(array('message' => 'User created successfully'));
    } else {
        http_response_code(503);

        echo json_encode(array('message' => $statement->errorInfo()));
    }
});

//Get a user based on param
$f3->route('GET /api/users/@username', function($f3, $params){
    $username = $params['username'];

    $query = 'SELECT userId, username, email, avatar FROM users WHERE username = :username';

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

$f3->route('PATCH /api/users/@username', function($f3, $params){
    $data = json_decode(file_get_contents("php://input"));

    //Avatars and images are being sent to the API using Base64 Encoding and thus they have to be handled differently
    if(isset($data->avatar)) {
        $data = explode(',', $data->avatar); //Split data URI portion from base64 data

        $imagedata = base64_decode($data[1]);

        //Getting MIME type and extension info
        $finfo = finfo_open();
        $mimeType = finfo_buffer($finfo, $imagedata, FILEINFO_MIME_TYPE);
        $mimeExtensions = finfo_buffer($finfo, $imagedata, FILEINFO_EXTENSION);
        $extension = explode('/', $mimeExtensions)[0]; //Get the first extension of all possible ones for the MIME type

        if (explode('/', $mimeType)[0] != 'image') {
            http_response_code(400);
            echo json_encode(array('message' => 'Base64 Image data provided for avatar was not an image.'));
        }

        $filePath = '/game-tracker/images/' . $params['username'] . '.' . $extension;
        $serverPath = $_SERVER['DOCUMENT_ROOT'] . $filePath;

        file_put_contents($serverPath, $imagedata);

        $query = "UPDATE users SET avatar = :filePath WHERE username = :username";

        $statement = $GLOBALS['cnxn']->prepare($query);
        $statement->bindParam(':filePath', $filePath, PDO::PARAM_STR);
        $statement->bindParam(':username', $params['username'], PDO::PARAM_STR);

        if ($statement->execute()) {
            http_response_code(200);
            echo json_encode(array('path' => $filePath, 'message' => 'Avatar suceesfully updated.'));
        } else {
            http_response_code(503);
            echo json_encode(array('message' => 'Failed to update avatar'));
        }
    }
    // TODO Add updating bio and maybe username
});

$f3->route('POST /api/games', function (){
    $data = json_decode(file_get_contents('php://input'));

    //Create game in database
    $query = "INSERT INTO games (gameName, description, genre) VALUES (:gameName, :description, :genre)";

    $statement = $GLOBALS['cnxn']->prepare($query);
    $statement->bindParam(':gameName', $data->gameName, PDO::PARAM_STR);
    $statement->bindParam(':description', $data->description, PDO::PARAM_STR);
    $statement->bindParam(':genre', $data->genre, PDO::PARAM_STR);


    if(!$statement->execute()){
        http_response_code(503);

        echo json_encode(array('message' => $statement->errorInfo()));
        die;
    } else {

        //Getting the new game ID
        $query = "SELECT gameId FROM games where gameName = :gameName";
        $statement = $GLOBALS['cnxn']->prepare($query);
        $statement->bindParam(':gameName', $data->gameName, PDO::PARAM_STR);

        $statement->execute();
        $gameId = $statement->fetchColumn();

        //Update game platforms
        foreach ($data->platforms as $platformId){
            $platformQuery = "INSERT INTO gamePlatforms (gameId, platformId) VALUES (:gameId, :platformId);";

            $statement = $GLOBALS['cnxn']->prepare($platformQuery);
            $statement->bindParam(":platformId", $platformId, PDO::PARAM_INT);
            $statement->bindParam(":gameId", $gameId, PDO::PARAM_INT);

            if(!$statement->execute()){
                http_response_code(503);

                echo json_encode(array('message' => $statement->errorInfo()));
                die;
            }
        }
        http_response_code(201);

        echo json_encode(array('gameId' => $gameId, 'message' => 'Game created successfully'));
    }
});

$f3->route('GET /api/games', function () {

    $query = "SELECT * FROM games";

    if(isset($_GET['search']) && !empty($_GET['search'])){
        $query .= " WHERE gameName LIKE :search";

        $statement = $GLOBALS['cnxn']->prepare($query);
        $searchString = "%{$_GET['search']}%";
        $statement->bindParam(':search', $searchString, PDO::PARAM_STR);
    } else {
        $statement = $GLOBALS['cnxn']->prepare($query);
    }

    $statement->execute();

    if($statement->rowCount() > 0){
        $output = array();

        while($row = $statement->fetch(PDO::FETCH_ASSOC)){
            array_push($output, $row);
        }

        http_response_code(200);

        echo json_encode($output);
    } else {
        http_response_code(404);

        echo json_encode(array("message" => "No games found."));
    }
});

$f3->route('GET /api/games/@gameId', function($f3, $params){
   $query = "SELECT * FROM games WHERE gameId = :gameId LIMIT 1";

   $statement = $GLOBALS['cnxn']->prepare($query);
   $statement->bindParam(':gameId', $params['gameId'], PDO::PARAM_INT);

   if(!$statement->execute()){
       http_response_code(404);

       echo json_encode(array("message" => "Game Id doesn't exist."));
       die;
   }

    $gameData = $statement->fetch(PDO::FETCH_ASSOC);

    $platformQuery = "SELECT platformName FROM platforms
INNER JOIN gamePlatforms ON platforms.platformId = gamePlatforms.platformId
WHERE gameId = :gameId;";

    $statement = $GLOBALS['cnxn']->prepare($platformQuery);
    $statement->bindParam(':gameId', $params['gameId'], PDO::PARAM_INT);


    if(!$statement->execute()){
        http_response_code(404);

        echo json_encode(array("message" => "Game Id doesn't exist."));
        die;
    }
    $platforms = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
    $gameData['platforms'] = $platforms;

    http_response_code(200);

    echo json_encode($gameData);
});

//run fat-free
$f3->run();