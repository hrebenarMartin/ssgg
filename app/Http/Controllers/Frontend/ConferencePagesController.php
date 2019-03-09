<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Application;
use App\Models\Block;
use App\Models\Conference;
use App\Models\ConferenceConfiguration;
use App\Models\Contribution;
use App\Models\Country;
use App\Models\Page;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConferencePagesController extends Controller
{

    public function __construct()
    {
        session()->put('module', 2);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conference = Conference::where('status', 1)->first();

        if (!$conference) return abort(404);

        $page = Page::where('alias', $conference->year)->where('module', 2)->where('active', 1)->first();

        if (!$page) return abort(404);

        $page_blocks = Block::where('page_id', $page->id)->orderBy('rank', 'ASC')->get();

        //Dáta pre fixné dynamické bloky
        $dynamic_data = collect();
        $dynamic_data->conference = $conference;
        $dynamic_data->conf_config = ConferenceConfiguration::where('conference_id', $conference->id)->first();
        $dynamic_data->conf_contributions = Contribution::where('conference_id', $conference->id)->get();
        return view('page')
            ->with('page', $page)
            ->with('data', $page_blocks)
            ->with('dynamic_data', $dynamic_data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $conference = Conference::where('status', 1)->first();

        if (!$conference) return abort(404);

        $page = Page::where('alias', $id)->where('module', 2)->where('active', 1)->first();

        if (!$page) return abort(404);

        $page_blocks = Block::where('page_id', $page->id)->orderBy('rank', 'ASC')->get();

        //Dáta pre fixné dynamické bloky
        $dynamic_data = collect();
        $dynamic_data->conference = $conference;
        $dynamic_data->conference->country_name = Country::getCountryName($conference->address_country);
        $dynamic_data->conf_config = ConferenceConfiguration::where('conference_id', $conference->id)->first();
        $dynamic_data->conf_contributions = Contribution::where('conference_id', $conference->id)->get();
        $dynamic_data->participants = collect();
        foreach (Application::where('status', '>=', '3')->where('conference_id', $conference->id)->get() as $p) {
            $p->profile = Profile::where('user_id', $p->user_id)->first();
            $p->contribution = Contribution::where('user_id', $p->user_id)->where('conference_id', $conference->id)->first();
            $dynamic_data->participants->put($p->id, $p);
        }
        return view('page')
            ->with('page', $page)
            ->with('data', $page_blocks)
            ->with('dynamic_data', $dynamic_data);
    }


    public function proceedingsDownload($year)
    {
        $name = 'conference_' . $year . ".pdf";

        $file = public_path() . "/files/conference_proceedings/" . $name;

        $headers = [
            'Content-Type' => 'application/zip',
        ];

        return response()->download($file, $name, $headers);
    }
}
