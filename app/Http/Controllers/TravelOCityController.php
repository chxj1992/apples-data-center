<?php namespace Chxj1992\ApplesDataCenter\App\Http\Controllers;

use Chxj1992\ApplesDataCenter\App\Enums\Project;
use Chxj1992\ApplesDataCenter\App\Models\Export;
use Chxj1992\ApplesDataCenter\App\Models\TravelocityItineraries;
use Illuminate\Support\Facades\DB;

class TravelOCityController extends Controller
{

    const PRICE_MIN = 100;
    const PRICE_MAX = 999999;

    const EXPORT_PAGE_SIZE = 8;

    public function index()
    {
        $exports = Export::whereProject(Project::TRAVELOCITY)->orderBy('id', 'desc')->take(self::EXPORT_PAGE_SIZE)->get();;

        $avg = TravelocityItineraries::select(DB::raw($this->buildSelectSQL()))->first();

        return view('admin.index')
            ->with('exports', $exports)
            ->with('avg', $avg);
    }

    public function itinerariesByMonth()
    {
        $data = TravelocityItineraries::select(
            DB::raw($this->buildSelectSQL() . ", date_format(departure_time, '%Y-%m') as period")
        )->groupBy('period')->get();

        return response()->json($data);
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
