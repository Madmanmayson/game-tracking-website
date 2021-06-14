<?php

class Controller
{
    private $_f3; //Router

    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    function home()
    {
        //Display the home page
        $view = new Template();
        echo $view->render('views/home.html');
    }

    function login()
    {
        $view = new Template();
        echo $view->render('views/login.html');
    }

    function registration()
    {
        $view = new Template();
        echo $view->render('views/registration.html');
    }

    function profile($username)
    {
        // WHY DO WE NOT HAVE A SHARED SERVER!! STRING MATH IS EVIL TO WORKAROUND THIS PROBLEM!!!
        $oldPath = $_SERVER['SCRIPT_URI'];
        $partToRemove = substr($oldPath, strpos($oldPath, 'profile'));
        $apiPath = substr($oldPath, 0, strlen($oldPath) - strlen($partToRemove));

        $curl = curl_init("{$apiPath}api/user/{$username}");

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($curl);
        curl_close($curl);

        $data = json_decode($result, true);
        $user = new User($data);

        $this->_f3->set('user', $user);
        $view = new Template();
        echo $view->render('views/profile.html');
    }

    function search()
    {
        $oldPath = $_SERVER['SCRIPT_URI'];
        $partToRemove = substr($oldPath, strpos($oldPath, 'search'));
        $apiPath = substr($oldPath, 0, strlen($oldPath) - strlen($partToRemove));

        $curl = curl_init("{$apiPath}api/games?search=" . $_GET['search']);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($curl);
        curl_close($curl);

        $data = json_decode($result, true);

        $games = array();

        foreach($data as $row){
            $games[] = new Game($row);
        }

        $this->_f3->set('games', $games);
        $this->_f3->set('search', (!empty($_GET['search'])) ? $_GET['search'] . "'s " : "");
        $view = new Template();
        echo $view->render('views/search.html');
    }
}