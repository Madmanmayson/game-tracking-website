<?php

class Game
{
    private $_gameId;
    private $_gameName;
    private $_description;
    private $_genre;

    public function __construct($databaseRow = null){
        if ($databaseRow != null) {
            if (isset($databaseRow['gameId'])) {
                $this->_gameId = $databaseRow['gameId'];
            }

            if (isset($databaseRow['gameName'])) {
                $this->_gameName = $databaseRow['gameName'];
            }

            if (isset($databaseRow['description'])) {
                $this->_description = $databaseRow['description'];
            }

            if (isset($databaseRow['genre'])) {
                $this->_genre = $databaseRow['genre'];
            }
        }
    }

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
