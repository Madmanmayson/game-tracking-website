<?php

class Admin extends User
{
    public function __construct($databaseRow = null)
    {
        parent::__construct($databaseRow);
    }

    public function createGame($gameData){

        $oldPath = $_SERVER['SCRIPT_URI'];
        $partToRemove = substr($oldPath, strpos($oldPath, 'add-game'));
        $apiPath = substr($oldPath, 0, strlen($oldPath) - strlen($partToRemove));

        $curl = curl_init("{$apiPath}api/games");
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($gameData));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($curl);
        $data = json_decode($result, true);
        if (!curl_errno($curl)) {
            switch ($http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE)) {
                case 201:  # OK
                    //route to their profile
                    $search = urlencode($_POST['gameName']);
                    header("Location: /game-tracker/search?search={$search}");
                default:
                    //route to an error page
                    //Back to registration for now
                    echo $result;
                    $view = new Template();
                    echo $view->render('views/registration.html');
            }
        }
        else{
            echo curl_error($curl);
        }


    }
}