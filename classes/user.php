<?php

class User
{
    private $_userId = 0;
    private $_userName = "";
    private $_password = "";
    private $_email = "";
    private $_avatar = "";

    public function __construct($databaseRow = null)
    {
        if ($databaseRow != null) {
            if (isset($databaseRow['userId'])) {
                $this->_userId = $databaseRow['userId'];
            }

            if (isset($databaseRow['username'])) {
                $this->_userName = $databaseRow['username'];
            }

            if (isset($databaseRow['email'])) {
                $this->_email = $databaseRow['email'];
            }

            if (isset($databaseRow['password'])) {
                $this->_password = $databaseRow['password'];
            }
            if (isset($databaseRow['avatar'])) {
                $this->_avatar = $databaseRow['avatar'];
            }
        }
    }

    /**
     * @return string
     */
    public function getAvatar(): string
    {
        return $this->_avatar;
    }

    /**
     * @param string $avatar
     */
    public function setAvatar(string $avatar): void
    {
        $this->_avatar = $avatar;
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
}

