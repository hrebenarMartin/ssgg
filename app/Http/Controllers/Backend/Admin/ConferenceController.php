<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Conference;
use App\Models\Contribution;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ConferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conferences = Conference::orderBy('year', 'DESC')->get();

        return view('backend.conference.listing')
            ->with('conferences', $conferences);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $can_create = Conference::where('status' , '!=', 3)->count();

        if($can_create > 0){
            return redirect()->route('admin.conferences.index')
                ->with('message', 'You cannot create new conference while the last one is not archived yet')
                ->with('message_type', 'danger');
        }

        $countries = DB::table('countries')->get();

        return view('backend.conference.add')
            ->with('countries', $countries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $rules = [
            'title_sk' => 'required',
            'title_en' => 'required',
            'status' => 'required',
            'year' => 'required',
            'volume' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'addr_country' => 'required',
            'addr_city' => 'required',
            'addr_place' => 'required',
            'reg_start' => 'required|date|before:reg_end',
            'reg_end' => 'required|date|before:conf_start|after:reg_start',
            'conf_start' => 'required|date|before:conf_end|after:reg_end',
            'conf_end' => 'required|date|after:conf_start',
            'schedule_sk' => 'required',
        ];

        $this->validate($request, $rules);

        $conf = new Conference();

        $conf->title_sk = $request->title_sk;
        $conf->title_en = $request->title_en;
        $conf->status = $request->status;
        $conf->year = $request->year;
        $conf->volume = $request->volume;
        $conf->lat = $request->lat;
        $conf->lng = $request->lng;
        $conf->address_city = $request->addr_city;
        $conf->address_country = $request->addr_country;
        $conf->address_place = $request->addr_place;
        $conf->registration_start = $request->reg_start;
        $conf->registration_end = $request->reg_end;
        $conf->conference_start = $request->conf_start;
        $conf->conference_end = $request->conf_end;
        $conf->schedule_sk = $request->schedule_sk;
        if (!empty($request->schedule_en)) {
            $conf->schedule_en = $request->schedule_en;
        }
        $conf->updated_at = Carbon::now();
        $conf->created_at = Carbon::now();

        $conf->save();

        return redirect()->route('admin.conferences.index')
            ->with('message', "Conference successfully created")
            ->with('message_type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $conference = Conference::find($id);
        $stats = collect();
        $stats->attendees = -1;
        $stats->contributions = Contribution::where('conference_id', $id)->count();

        return view('backend.conference.detail')
            ->with('data', $conference)
            ->with('stats', $stats);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $conference = Conference::find($id);
        $countries = DB::table('countries')->get();

        return view('backend.conference.edit')
            ->with('data', $conference)
            ->with('countries', $countries);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'title_sk' => 'required',
            'title_en' => 'required',
            'status' => 'required',
            'year' => 'required',
            'volume' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'addr_country' => 'required',
            'addr_city' => 'required',
            'addr_place' => 'required',
            'reg_start' => 'required|date|before:reg_end',
            'reg_end' => 'required|date|before:conf_start|after:reg_start',
            'conf_start' => 'required|date|before:conf_end|after:reg_end',
            'conf_end' => 'required|date|after:conf_start',
            'schedule_sk' => 'required',
        ];

        $this->validate($request, $rules);

        $conf = Conference::find($id);

        $conf->title_sk = $request->title_sk;
        $conf->title_en = $request->title_en;
        $conf->status = $request->status;
        $conf->year = $request->year;
        $conf->volume = $request->volume;
        $conf->lat = $request->lat;
        $conf->lng = $request->lng;
        $conf->address_city = $request->addr_city;
        $conf->address_country = $request->addr_country;
        $conf->address_place = $request->addr_place;
        $conf->registration_start = $request->reg_start;
        $conf->registration_end = $request->reg_end;
        $conf->conference_start = $request->conf_start;
        $conf->conference_end = $request->conf_end;
        $conf->schedule_sk = $request->schedule_sk;
        if (!empty($request->schedule_en)) {
            $conf->schedule_en = $request->schedule_en;
        }
        $conf->updated_at = Carbon::now();

        //TODO upload proceedings file if provided

        $conf->save();

        return redirect()->route('admin.conferences.show', $id)
            ->with('message', "Conference successfully updated")
            ->with('message_type', 'success');
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
