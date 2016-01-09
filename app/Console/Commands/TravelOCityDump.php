<?php namespace Chxj1992\ApplesDataCenter\App\Console\Commands;

use Chxj1992\ApplesDataCenter\App\Enums\Project;
use Chxj1992\ApplesDataCenter\App\Models\Export;
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

        $name = 'itineraries_' . date('Y-m-d') . '.sql';
        $path = '/export/' . $name;

        system('mysqldump -u' . $db['username'] . ' -p' . $db['password'] . ' ' . $db['database']
            . ' travelocity_itineraries >' . base_path('public') . $path);

        Export::create(['project' => Project::TRAVELOCITY, 'name' => $name, 'path' => $path]);
    }

}
