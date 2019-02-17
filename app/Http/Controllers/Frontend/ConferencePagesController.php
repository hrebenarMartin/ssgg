<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Block;
use App\Models\Conference;
use App\Models\ConferenceConfiguration;
use App\Models\Contribution;
use App\Models\Page;
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

        if(!$conference) return abort(404);

        $page = Page::where('alias', $conference->year)->where('module', 2)->where('active', 1)->first();

        if(!$page) return abort(404);

        $page_blocks = Block::where('page_id', $page->id)->orderBy('rank', 'ASC')->get();

        //Dáta pre fixné dynamické bloky
        $dynamic_data = collect();
        $dynamic_data->conference = $conference;
        $dynamic_data->conf_config = ConferenceConfiguration::where('conference_id', $conference->id);
        $dynamic_data->conf_contributions = Contribution::where('conference_id', $conference->id);

        return view('page')
            ->with('page', $page)
            ->with('data', $page_blocks)
            ->with('dynamic_data', $dynamic_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $conference = Conference::where('status', 1)->first();

        if(!$conference) return abort(404);

        $page = Page::where('alias', $id)->where('module', 2)->where('active', 1)->first();

        if(!$page) return abort(404);

        $page_blocks = Block::where('page_id', $page->id)->orderBy('rank', 'ASC')->get();

        //Dáta pre fixné dynamické bloky
        $dynamic_data = collect();
        $dynamic_data->conference = $conference;
        $dynamic_data->conf_config = ConferenceConfiguration::where('conference_id', $conference->id);
        $dynamic_data->conf_contributions = Contribution::where('conference_id', $conference->id);

        return view('page')
            ->with('page', $page)
            ->with('data', $page_blocks)
            ->with('dynamic_data', $dynamic_data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
