<?php

class Validation
{
    function validPassword($password)
    {
        return preg_match("/[A-Za-z0-9]{6,}/", $password);
    }

    function validUserName($userName)
    {
        return preg_match("/[A-Za-z0-9_-]{4,32}/", $userName);
    }
}
