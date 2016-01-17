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

        $this->crawl(Project::ROYALCARIBBEAN);
        $this->crawl(Project::TRAVELOCITY);
    }

    private function crawl($project = Project::TRAVELOCITY)
    {
        system('python ' . config('app.crawler_path') . "/$project/run.py >"
            . storage_path('logs') . "/cruises/{$project}_" . date('Y-m-d') . '.log');
    }


}
