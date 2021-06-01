<?php

class Game
{
    private $_gameId;
    private $_gameName;
    private $_description;
    private $_genre;

    /**
     * @return int
     */
    public function getGameId()
    {
        return $this->_gameId;
    }

    /**
     * @return string
     */
    public function getGameName()
    {
        return $this->_gameName;
    }

    /**
     * @param string $gameName
     */
    public function setGameName($gameName)
    {
        $this->_gameName = $gameName;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->_description = $description;
    }

    /**
     * @return string
     */
    public function getGenre()
    {
        return $this->_genre;
    }

    /**
     * @param string $genre
     */
    public function setGenre($genre)
    {
        $this->_genre = $genre;
    }
}
