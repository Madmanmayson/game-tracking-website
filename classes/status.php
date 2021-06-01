<?php

class Status
{
    private $_statusId;
    private $_statusName;

    /**
     * @return int
     */
    public function getStatusId()
    {
        return $this->_statusId;
    }

    /**
     * @return string
     */
    public function getStatusName()
    {
        return $this->_statusName;
    }

    /**
     * @param string $statusName
     */
    public function setStatusName($statusName)
    {
        $this->_statusName = $statusName;
    }
}
