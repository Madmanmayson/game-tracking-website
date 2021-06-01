<?php

class User
{
    private $_userId;
    private $_userName;
    private $_password;
    private $_isAdmin;

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
