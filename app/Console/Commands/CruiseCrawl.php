<?php namespace Chxj1992\ApplesDataCenter\App\Console\Commands;

use Chxj1992\ApplesDataCenter\App\Enums\Project;
use Chxj1992\ApplesDataCenter\App\Models\Cruises;
use Illuminate\Console\Command;

class CruiseCrawl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cruise:crawl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'crawl cruises data';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Cruises::truncate();

        foreach (Project::getValues() as $project) {
            self::crawl($project, Project::getWorkerNum($project));
        }
    }

    public static function crawl($project = Project::TRAVELOCITY, $workerNum = 1)
    {
        Cruises::whereProject($project)->delete();

        system("ps aux | grep 'run.py -p ".$project."' | grep -v grep | awk '{print $2}' | xargs kill -9");

        system('python ' . config('app.crawler_path') . "/cruise/run.py -p $project -n $workerNum >"
            . storage_path('logs') . "/cruises/{$project}_" . date('Y-m-d') . '.log');
    }


}
