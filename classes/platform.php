<?php

class Platform
{
    private $_platformId;
    private $_platformName;

    /**
     * @return int
     */
    public function getPlatformId()
    {
        return $this->_platformId;
    }

    /**
     * @return string
     */
    public function getPlatformName()
    {
        return $this->_platformName;
    }

    /**
     * @param string $platformName
     */
    public function setPlatformName($platformName)
    {
        $this->_platformName = $platformName;
    }
}
