<?php

class GamePlatform
{
    private $_gamePlatformId;
    private $_gameId;
    private $_platformId;

    /**
     * @return int
     */
    public function getGamePlatformId()
    {
        return $this->_gamePlatformId;
    }

    /**
     * @return int
     */
    public function getGameId()
    {
        return $this->_gameId;
    }

    /**
     * @return int
     */
    public function getPlatformId()
    {
        return $this->_platformId;
    }
}
