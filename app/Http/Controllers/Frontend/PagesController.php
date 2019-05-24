<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Block;
use App\Models\Conference;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{

    public function __construct()
    {
        session()->put('module', 1);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = Page::where('alias', 'home')->where('module', 1)->first();
        $page_blocks = Block::where('page_id', $page->id)->get();

        $dynamic_data = collect();
        $dynamic_data->conferences = Conference::where('status', 3)->get();

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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = Page::where('alias', $id)->where('module', 1)->first();

        if (!$page) return abort(404);

        $page_blocks = Block::where('page_id', $page->id)->orderBy('rank')->get();

        $dynamic_data = collect();
        $dynamic_data->conferences = Conference::where('status', 3)->get();

        //dd($dynamic_data);

        return view('page')
            ->with('page', $page)
            ->with('data', $page_blocks)
            ->with('dynamic_data', $dynamic_data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function archiveEntry($year)
    {
        $conference = Conference::where('year', $year)->first();

        if(!$conference) abort(404);

        return view('archive_show')
            ->with('data', $conference);
    }
}
