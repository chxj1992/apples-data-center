<?php namespace Chxj1992\ApplesDataCenter\App\Enums;

class Project
{

    const TRAVELOCITY = 'travelocity';
    const ROYALCARIBBEAN = 'royalcaribbean';

    public static function getValues()
    {
        return [
            self::TRAVELOCITY,
            self::ROYALCARIBBEAN,
        ];
    }

}