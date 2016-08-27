<?php namespace Chxj1992\ApplesDataCenter\App\Enums;

class Project
{

    const TRAVELOCITY = 'travelocity';
    const ROYALCARIBBEAN = 'royalcaribbean';
    const CARNIVAL = 'carnival';
    const DISNEYCRUISE = 'disneycruise';
    const NCL = 'ncl';
    const PRINCESS = 'princess';

    public static $workerMap = [
        self::TRAVELOCITY => 10,
        self::ROYALCARIBBEAN => 5,
        self::CARNIVAL => 1,
        self::DISNEYCRUISE => 1,
        self::NCL => 5,
        self::PRINCESS => 1,
    ];

    public static function getValues()
    {
        return [
            self::TRAVELOCITY,
            self::ROYALCARIBBEAN,
            self::CARNIVAL,
            self::DISNEYCRUISE,
            self::NCL,
            self::PRINCESS,
        ];
    }

    public static function getWorkerNum($project)
    {
        if (!isset(self::$workerMap[$project])) {
            return 1;
        }

        return self::$workerMap[$project];
    }

}