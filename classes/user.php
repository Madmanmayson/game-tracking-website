<?php

class User
{
    private $_userId = 0;
    private $_userName = "";
    private $_password = "";
    private $_isAdmin = false;
    private $_email = "";

    function __construct($databaseRow)
    {
        if(isset($databaseRow['userId'])){
            $this->_userId = $databaseRow['userId'];
        }

        if(isset($databaseRow['username'])){
            $this->_userName = $databaseRow['username'];
        }

        if(isset($databaseRow['email'])){
            $this->_email = $databaseRow['email'];
        }

        if(isset($databaseRow['password'])){
            $this->_password = $databaseRow['password'];
        }

        if(isset($databaseRow['isAdmin'])){
            $this->_isAdmin = $databaseRow['isAdmin'];
        }
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->_email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->_email = $email;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->_userId;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->_userName;
    }

    /**
     * @param string $userName
     */
    public function setUserName($userName)
    {
        $this->_userName = $userName;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
    }

    /**
     * @return boolean
     */
    public function getIsAdmin()
    {
        return $this->_isAdmin;
    }

    /**
     * @param boolean $isAdmin
     */
    public function setIsAdmin($isAdmin)
    {
        $this->_isAdmin = $isAdmin;
    }


}
