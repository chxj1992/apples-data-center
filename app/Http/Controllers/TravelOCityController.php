<?php namespace Chxj1992\ApplesDataCenter\App\Http\Controllers;

use Chxj1992\ApplesDataCenter\App\Enums\Project;
use Chxj1992\ApplesDataCenter\App\Models\Export;
use Chxj1992\ApplesDataCenter\App\Models\TravelocityItineraries;
use Illuminate\Support\Facades\DB;

class TravelOCityController extends Controller
{

    const EXPORT_PAGE_SIZE = 8;

    public function index()
    {
        $exports = Export::whereProject(Project::TRAVELOCITY)->orderBy('id', 'desc')->take(self::EXPORT_PAGE_SIZE)->get();;

        $avg = TravelocityItineraries::select(
            DB::raw('avg(inside) div 1 as inside, avg(oceanview) div 1 as oceanview,
        avg(balcony) div 1 as balcony, avg(suite) div 1 as suite')
        )->first();

        return view('admin.index')
            ->with('exports', $exports)
            ->with('avg', $avg);
    }

    public static function itinerariesByMonth()
    {
        $data = TravelocityItineraries::select(
            DB::raw("avg(inside) div 1 as inside, avg(oceanview) div 1 as oceanview,
            avg(balcony) div 1 as balcony, avg(suite) div 1 as suite,date_format(departure_time, '%Y-%m') as period")
        )->groupBy('period')->get();

        return response()->json($data);
    }

}
