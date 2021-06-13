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
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $userName = $_POST['username'];
            $userPassword = $_POST['password'];
            $userEmail = $_POST['email'];

            if (!Validation::validUserName($userName)){
                $this->_f3->set('errors["username"]',
                "Please enter an alphanumeric username between 4 and 32 characters");
            }

            if (!Validation::validPassword($userPassword)){
                $this->_f3->set('errors["password"]',
                "Please enter a alphanumeric password at least 6 characters long");
            }

            if (!Validation::validEmail($userEmail)){
                $this->_f3->set('errors["email"]',
                "Please enter a valid email address");
            }

            if (empty($this->_f3->get('errors')))
            {
                $oldPath = $_SERVER['SCRIPT_URI'];
                $partToRemove = substr($oldPath, strpos($oldPath, 'profile'));
                $apiPath = substr($oldPath, 0, strlen($oldPath) - strlen($partToRemove));

                $curl = curl_init("{$apiPath}api/users");

                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($_POST));
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($curl);
                if (!curl_errno($curl)) {
                    switch ($http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE)) {
                        case 201:  # OK
                            //route to their profile
                            header("Location: profile/{$_POST['username']}");
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

        $view = new Template();
        echo $view->render('views/registration.html');
    }

    function profile($username)
    {
        // WHY DO WE NOT HAVE A SHARED SERVER!! STRING MATH IS EVIL TO WORKAROUND THIS PROBLEM!!!
        $oldPath = $_SERVER['SCRIPT_URI'];
        $partToRemove = substr($oldPath, strpos($oldPath, 'profile'));
        $apiPath = substr($oldPath, 0, strlen($oldPath) - strlen($partToRemove));

        $curl = curl_init("{$apiPath}api/users/{$username}");

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
        $view = new Template();
        echo $view->render('views/home.html');
    }
}