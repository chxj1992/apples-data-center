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
        \Chxj1992\ApplesDataCenter\App\Console\Commands\CrawlTravelOCity::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
//        $schedule->command('travelocity:crawl')->weekly()->saturdays()->at('13:00')->appendOutputTo('/tmp/travelocity.log');
        $schedule->command('travelocity:crawl')->everyFiveMinutes()->appendOutputTo('/tmp/travelocity.log');
    }
}
