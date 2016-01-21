<?php namespace Chxj1992\ApplesDataCenter\App\Console\Commands;

use Chxj1992\ApplesDataCenter\App\Enums\Project;
use Chxj1992\ApplesDataCenter\App\Models\Export;
use Illuminate\Console\Command;

class CruiseDump extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cruise:dump';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'dump cruises itineraries data';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->dumpToSql(Project::ROYALCARIBBEAN);
        $this->dumpToSql(Project::TRAVELOCITY);
        $this->dumpToSql(Project::CARNIVAL);
        $this->dumpToSql(Project::DISNEYCRUISE);
    }

    private function dumpToSql($project = Project::TRAVELOCITY)
    {
        $db = config('database.connections.apples_data_center');

        $name = $project . '_' . date('Y-m-d') . '.sql';

        $path = '/export/cruises/' . $name;

        system('mysqldump -u' . $db['username'] . ' -p' . $db['password'] . ' ' . $db['database']
            . ' cruises --where="project=\''.$project.'\'" >' . base_path('public') . $path);

        Export::firstOrCreate(['project' => $project, 'name' => $name, 'path' => $path]);
    }

}
