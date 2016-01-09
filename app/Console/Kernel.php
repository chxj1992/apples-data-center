<?php namespace Chxj1992\ApplesDataCenter\App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \Chxj1992\ApplesDataCenter\App\Console\Commands\TravelOCityCrawl::class,
        \Chxj1992\ApplesDataCenter\App\Console\Commands\TravelOCityDump::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
//        $schedule->command('travelocity:crawl')->weekly()->saturdays()->at('17:00');
        $schedule->command('travelocity:crawl')->dailyAt('19:00');;
        $schedule->command('travelocity:dump')->weekly()->saturdays()->at('20:00');
    }
}
