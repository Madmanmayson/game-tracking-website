<?php

class UserGameList
{
    private $_userId;
    private $_gamePlatformId;
    private $_rating;
    private $_statusId;

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->_userId;
    }

    /**
     * @return int
     */
    public function getGamePlatformId()
    {
        return $this->_gamePlatformId;
    }

    /**
     * @return string
     */
    public function getRating()
    {
        return $this->_rating;
    }

    /**
     * @param string $rating
     */
    public function setRating($rating)
    {
        $this->_rating = $rating;
    }

    /**
     * @return int
     */
    public function getStatusId()
    {
        return $this->_statusId;
    }
}
