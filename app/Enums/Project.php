<?php namespace Chxj1992\ApplesDataCenter\App\Enums;

class Project
{

    const TRAVELOCITY = 'travelocity';
    const ROYALCARIBBEAN = 'royalcaribbean';
    const CARNIVAL = 'carnival';
    const DISNEYCRUISE = 'disneycruise';

    public static function getValues()
    {
        return [
            self::TRAVELOCITY,
            self::ROYALCARIBBEAN,
            self::CARNIVAL,
            self::DISNEYCRUISE,
        ];
    }

}