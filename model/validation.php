<?php

class Validation
{
    static function validUserName($userName)
    {
        return preg_match("/[A-Za-z0-9_-]{4,32}/", $userName);
    }

    static function validPassword($password)
    {
        return preg_match("/[A-Za-z0-9]{6,}/", $password);
    }

    static function validEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
