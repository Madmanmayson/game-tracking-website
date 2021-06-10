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

    function profile()
    {
        //TODO check if the username is set in the session. If so, redirect to their profile, otherwise redirect to login or profile search

        $view = new Template();
        echo $view->render('views/profile.html');
    }

    function search()
    {
        $view = new Template();
        echo $view->render('views/home.html');
    }
}