<?php

class dataLayer{
    public static function getPlatforms(){
        return array(
            1 => 'PC',
            2 => 'Playstation 3',
            3 => 'Playstation 4',
            4 => 'Playstation 5',
            5 => 'Xbox 360',
            6 => 'Xbox One',
            7 => 'Xbox Series X|S',
            8 => 'Gamecube',
            9 => 'Wii',
            10 => 'Wii U',
            11 => 'Switch',
            12 => 'DS',
            13 => '3DS'
        );
    }

    public static function getStatuses(){
        return array(
            1 => 'Backlogged',
            2 => 'In Progress',
            3 => 'Completed',
            4 => 'Dropped',
            5 => 'On Hold'
        );
    }
}
