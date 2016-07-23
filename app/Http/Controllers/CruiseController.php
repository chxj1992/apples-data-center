<?php namespace Chxj1992\ApplesDataCenter\App\Http\Controllers;

use Chxj1992\ApplesDataCenter\App\Console\Commands\CruiseCrawl;
use Chxj1992\ApplesDataCenter\App\Console\Commands\CruiseDump;
use Chxj1992\ApplesDataCenter\App\Enums\Project;
use Chxj1992\ApplesDataCenter\App\Models\Cruises;
use Chxj1992\ApplesDataCenter\App\Models\Export;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class CruiseController extends Controller
{

    const PRICE_MIN = 100;
    const PRICE_MAX = 999999;

    const EXPORT_PAGE_SIZE = 8;

    public function index()
    {
        $project = $this->validateProject(Input::get('project'));

        $cruiseQuery = $project ? Cruises::whereProject($project) : Cruises::getQuery();
        $exportQuery = $project ? Export::whereProject($project) : Export::getQuery();

        $exports = $exportQuery->orderBy('id', 'desc')->take(self::EXPORT_PAGE_SIZE)->get();;
        $avg = $cruiseQuery->select(DB::raw($this->buildSelectSQL()))->first();

        return view('admin.cruise')
            ->with('project', $project)
            ->with('exports', $exports)
            ->with('avg', $avg);
    }

    public function priceByDepartureTime()
    {
        $query = $this->buildCruiseQuery();

        $data = $query->select(
            DB::raw($this->buildSelectSQL() . ", date_format(departure_time, '%Y-%m') as period")
        )->groupBy('period')->get();

        return response()->json($data);
    }

    public function countByDepartureTime()
    {
        $query = $this->buildCruiseQuery();

        $data = $query->select(
            DB::raw("date_format(departure_time, '%Y') as label, count(*) as value")
        )->groupBy('label')->get();

        return response()->json($data);
    }

    public function priceByDuration()
    {
        $durationStep = $this->getDurationStep();
        $query = $this->buildCruiseQuery();

        $data = $query->select(
            DB::raw($this->buildSelectSQL() . ", (duration div $durationStep * $durationStep) as duration_group")
        )->groupBy('duration_group')->get();

        return response()->json($data);
    }

    public function dump()
    {
        if (!$project = $this->validateProject(Input::get('project'))) {
            return response()->json(false);
        }

        try {
            CruiseDump::dumpToSql($project);
            return response()->json(true);
        } catch (\Exception $e) {
            return response()->json(false);
        }
    }

    public function crawl()
    {
        if (!$project = $this->validateProject(Input::get('project'))) {
            return response()->json(false);
        }

        try {
            $workerNum = Project::getWorkerNum($project);
            CruiseCrawl::crawl($project, $workerNum);
            CruiseDump::dumpToSql($project);
            return response()->json(true);
        } catch (\Exception $e) {
            return response()->json(false);
        }
    }

    private function getDurationStep()
    {
        $query = $this->buildCruiseQuery();
        $ret = $query->orderBy('duration', 'desc')->first();
        return $ret ? intval($ret->duration / 10) : 1;
    }

    private function buildCruiseQuery()
    {
        $project = $this->validateProject(Input::get('project'));

        return $project ? Cruises::whereProject($project) : Cruises::getQuery();
    }

    private function validateProject($project)
    {
        if (!in_array($project, Project::getValues())) {
            return false;
        }

        return $project;
    }

    private function buildSelectSQL()
    {
        return
            'avg(case when (inside > ' . self::PRICE_MIN . ' AND inside < ' . self::PRICE_MAX . ') then inside else null end) div 1 as inside,
            avg(case when (oceanview > ' . self::PRICE_MIN . ' AND inside < ' . self::PRICE_MAX . ') then oceanview else null end) div 1 as oceanview,
            avg(case when (balcony > ' . self::PRICE_MIN . ' AND balcony < ' . self::PRICE_MAX . ') then balcony else null end) div 1 as balcony,
            avg(case when (suite > ' . self::PRICE_MIN . ' AND suite < ' . self::PRICE_MAX . ') then suite else null end) div 1 as suite';
    }

}
