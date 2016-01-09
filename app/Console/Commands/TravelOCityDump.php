<?php namespace Chxj1992\ApplesDataCenter\App\Console\Commands;

use Illuminate\Console\Command;

class TravelOCityDump extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'travelocity:dump';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'dump itineraries data from travelocity';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $db = config('database.connections.apples_data_center');

        system('mysqldump -u' . $db['username'] . ' -p' . $db['password'] . ' ' . $db['database'] . ' travelocity_itineraries >'
            . base_path('public/export') . '/itineraries_' . date('Y-m-d') . '.sql');
    }

}
