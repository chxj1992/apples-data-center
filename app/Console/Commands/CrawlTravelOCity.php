<?php namespace Chxj1992\ApplesDataCenter\App\Console\Commands;

use Chxj1992\ApplesDataCenter\App\Models\TravelocityItineraries;
use Illuminate\Console\Command;

class CrawlTravelOCity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'travelocity:crawl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'crawl itineraries data from travelocity';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        TravelocityItineraries::truncate();

        system('python ' . config('app.crawler_path') . '/travelocity/run.py > '
            . storage_path('logs') . '/travelocity_' . date('Y-m-d') . '.log');
    }


}
