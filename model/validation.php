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

    static function validPlatform($platforms)
    {
        $validPlatform = dataLayer::getPlatforms();
        if (!empty($platforms))
        {
            foreach ($platforms as $platform_id)
            {
                if (!array_key_exists($platform_id, $validPlatform))
                {
                    return false;
                }
            }
            return true;
        }else{
            return false;
        }
    }

    static function validString($string)
    {
        if (gettype($string) == "string")
        {
            if (!empty($string))
            {
                return true;
            }
        }
        return false;
    }
}
