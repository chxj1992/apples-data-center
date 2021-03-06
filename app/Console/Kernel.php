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
        \Chxj1992\ApplesDataCenter\App\Console\Commands\CruiseCrawl::class,
        \Chxj1992\ApplesDataCenter\App\Console\Commands\CruiseDump::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // fix lumen timezone issue
        date_default_timezone_set(config('app.timezone'));

        $schedule->command('cruise:crawl')->weekly()->saturdays()->at('16:00');
        $schedule->command('cruise:dump')->weekly()->saturdays()->at('20:00');
    }
}
