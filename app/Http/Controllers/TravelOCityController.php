<?php namespace Chxj1992\ApplesDataCenter\App\Http\Controllers;

use Chxj1992\ApplesDataCenter\App\Enums\Project;
use Chxj1992\ApplesDataCenter\App\Models\Export;
use Chxj1992\ApplesDataCenter\App\Models\TravelocityItineraries;

class TravelOCityController extends Controller
{

    const EXPORT_PAGE_SIZE = 8;

    public function index()
    {
        $exports = Export::whereProject(Project::TRAVELOCITY)->orderBy('id', 'desc')->take(self::EXPORT_PAGE_SIZE)->get();
        ;

        return view('admin.index')
            ->with('exports', $exports)
            ->with('inside', TravelocityItineraries::avg('inside'))
            ->with('oceanview', TravelocityItineraries::avg('oceanview'))
            ->with('balcony', TravelocityItineraries::avg('balcony'))
            ->with('suite', TravelocityItineraries::avg('suite'));
    }

}
