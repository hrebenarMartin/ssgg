<?php

namespace App\Http\Controllers\Backend\User;

use App\Models\Application;
use App\Models\Conference;
use App\Models\ConferenceConfiguration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conference = Conference::where('status', 1)->first();
        //dd($conference);
        if(!$conference){
            return view('backend.application.user_application')
                ->with('no_conference', true);
        }
        $config = ConferenceConfiguration::where('conference_id', $conference->id)->first();
        $appl = Application::where('user_id', Auth::id())->where('conference_id', $conference->id)->first();

        $has_application = $appl != null;
        return view('backend.application.user_application')
            ->with('has_application' , $has_application)
            ->with('conference', $conference)
            ->with('config', $config)
            ->with('appl', $appl);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $appl = new Application();

        $appl->user_id = Auth::id();
        $appl->conference_id = Conference::where('status', 1)->first()->id;
        $appl->status = 1;

        $appl->save();

        return redirect()->route('user.application.index');
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
        //
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
