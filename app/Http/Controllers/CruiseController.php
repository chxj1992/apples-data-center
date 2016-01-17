<?php namespace Chxj1992\ApplesDataCenter\App\Http\Controllers;

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
        $project = $this->validateProject(Input::get('project', Project::TRAVELOCITY));

        $exports = Export::whereProject($project)->orderBy('id', 'desc')->take(self::EXPORT_PAGE_SIZE)->get();;
        $avg = Cruises::whereProject($project)->select(DB::raw($this->buildSelectSQL()))->first();

        return view('admin.cruise')
            ->with('project', $project)
            ->with('exports', $exports)
            ->with('avg', $avg);
    }

    public function priceByDepartureTime()
    {
        $project = $this->validateProject(Input::get('project', Project::TRAVELOCITY));

        $data = Cruises::whereProject($project)->select(
            DB::raw($this->buildSelectSQL() . ", date_format(departure_time, '%Y-%m') as period")
        )->groupBy('period')->get();

        return response()->json($data);
    }

    public function priceByDuration()
    {
        $project = $this->validateProject(Input::get('project', Project::TRAVELOCITY));

        $duration = Cruises::whereProject($project)->orderBy('duration', 'desc')->first()->duration;
        $durationStep = intval($duration / 10);

        $data = Cruises::whereProject($project)->select(
            DB::raw($this->buildSelectSQL() . ", (duration div $durationStep * $durationStep) as duration_group")
        )->groupBy('duration_group')->get();

        return response()->json($data);
    }

    private function validateProject($project)
    {
        if (!in_array($project, Project::getValues())) {
            return Project::TRAVELOCITY;
        }

        return $project;
    }

    private
    function buildSelectSQL()
    {
        return
            'avg(case when (inside > ' . self::PRICE_MIN . ' AND inside < ' . self::PRICE_MAX . ') then inside else null end) div 1 as inside,
            avg(case when (oceanview > ' . self::PRICE_MIN . ' AND inside < ' . self::PRICE_MAX . ') then oceanview else null end) div 1 as oceanview,
            avg(case when (balcony > ' . self::PRICE_MIN . ' AND balcony < ' . self::PRICE_MAX . ') then balcony else null end) div 1 as balcony,
            avg(case when (suite > ' . self::PRICE_MIN . ' AND suite < ' . self::PRICE_MAX . ') then suite else null end) div 1 as suite';
    }

}
