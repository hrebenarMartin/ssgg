<?php

namespace App\Http\Controllers\Backend\User;

use App\Models\Application;
use App\Models\Conference;
use App\Models\ConferenceConfiguration;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
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
            session()->put('message', "No active conference at the moment");
            session()->put('message_type', "danger");
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
        //Return back with message if no active conference
        if(!Conference::where('status', 1)->first()){
            return redirect()->route('user.application.index')
                ->with('message', 'There is no active conference at this moment')
                ->with('message_type', 'danger');
        }

        //Return back with message if user already have application for ongoing conference
        if(Application::where('user_id',Auth::id())->where('conference_id', Conference::where('status', 1)->first())->count() > 0){
            return redirect()->route('user.application.index')
                ->with('message', 'You already have your application for this conference created')
                ->with('message_type', 'danger');
        }

        $conference = Conference::where('status', 1)->first();
        $config = ConferenceConfiguration::where('conference_id', $conference->id)->first();

        return view('backend.application.add')
            ->with('conference', $conference)
            ->with('config', $config);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //create application for user on current conference
        $appl = new Application();

        $appl->user_id = Auth::id();
        $appl->conference_id = Conference::where('status', 1)->first()->id;

        $appl->status = 1;
        if (!empty($request->day_1_break)) {
            $appl->day1_breakfast = $request->day_1_break;
        }
        else $appl->day1_breakfast = 0;
        if (!empty($request->day_1_lunch)) {
            $appl->day1_lunch = $request->day_1_lunch;
        }
        else $appl->day1_lunch = 0;
        if (!empty($request->day_1_dinner)) {
            $appl->day1_dinner = $request->day_1_dinner;
        }
        else $appl->day1_dinner = 0;
        if (!empty($request->day_2_break)) {
            $appl->day2_breakfast = $request->day_2_break;
        }
        else $appl->day2_breakfast = 0;
        if (!empty($request->day_2_lunch)) {
            $appl->day2_lunch = $request->day_2_lunch;
        }
        else $appl->day2_lunch = 0;
        if (!empty($request->day_2_dinner)) {
            $appl->day2_dinner = $request->day_2_dinner;
        }
        else  $appl->day2_dinner = 0;
        if (!empty($request->day_3_break)) {
            $appl->day3_breakfast = $request->day_3_break;
        }
        else $appl->day3_breakfast = 0;
        if (!empty($request->day_3_lunch)) {
            $appl->day3_lunch = $request->day_3_lunch;
        }
        else $appl->day3_lunch = 0;
        if (!empty($request->day_3_dinner)) {
            $appl->day3_dinner = $request->day_3_dinner;
        }
        else $appl->day3_dinner = 0;
        if (!empty($request->day_4_break)) {
            $appl->day4_breakfast = $request->day_4_break;
        }
        else $appl->day4_breakfast = 0;
        if (!empty($request->day_4_lunch)) {
            $appl->day4_lunch = $request->day_4_lunch;
        }
        else $appl->day4_lunch = 0;
        if (!empty($request->day_4_dinner)) {
            $appl->day4_dinner = $request->day_4_dinner;
        }
        else $appl->day4_dinner = 0;
        if (!empty($request->day_5_break)) {
            $appl->day5_breakfast = $request->day_5_break;
        }
        else $appl->day5_breakfast = 0;
        if (!empty($request->day_5_lunch)) {
            $appl->day5_lunch = $request->day_5_lunch;
        }
        else $appl->day5_lunch = 0;
        if (!empty($request->day_5_dinner)) {
            $appl->day5_dinner = $request->day_5_dinner;
        }
        else $appl->day5_dinner = 0;

        if (!empty($request->special_1)) {
            $appl->special_1 = $request->special_1;
        }
        else $appl->special_1 = 0;

        if (!empty($request->special_2)) {
            $appl->special_2 = $request->special_2;
        }
        else $appl->special_2 = 0;
        if (!empty($request->special_3)) {
            $appl->special_3 = $request->special_3;
        }
        else $appl->special_3 = 0;

        if(!empty($request->accom)) {
            if ($request->accom == 1) {
                $appl->accom_1 = 1;
            } else $appl->accom_1 = 0;
            if ($request->accom == 2) {
                $appl->accom_2 = 1;
            } else $appl->accom_2 = 0;
            if ($request->accom == 3) {
                $appl->accom_3 = 1;
            } else $appl->accom_3 = 0;
            if ($request->accom == 4) {
                $appl->accom_4 = 1;
            } else $appl->accom_4 = 0;
            if ($request->accom == 5) {
                $appl->accom_5 = 1;
            } else $appl->accom_5 = 0;
            if ($request->accom == 98) {
                $appl->accom_98 = 1;
            } else $appl->accom_98 = 0;
            if ($request->accom == 99) {
                $appl->accom_99 = 1;
            } else $appl->accom_99 = 0;
        }
        $appl->extra = $request->extra;

        $appl->updated_at = Carbon::now();

        $appl->save();

        return redirect()->route('user.application.index')
            ->with('message', "Application created successfully")
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
        //Return back with message if no active conference
        if(!Conference::where('status', 1)->first()){
            return redirect()->route('user.application.index')
                ->with('message', 'There is no active conference at this moment')
                ->with('message_type', 'danger');
        }

        //Return back with message if user already have application for ongoing conference
        if(Application::findOrFail($id)->user_id != Auth::id()){
            return redirect()->route('user.application.index')
                ->with('message', 'You cant edit application ID '.$id.' because it is not your application')
                ->with('message_type', 'danger');
        }

        $conference = Conference::where('status', 1)->first();
        $config = ConferenceConfiguration::where('conference_id', $conference->id)->first();
        $appl = Application::findOrFail($id);

        return view('backend.application.edit')
            ->with('conference', $conference)
            ->with('config', $config)
            ->with('appl', $appl);
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
        
        $appl = Application::findOrFail($id);

        if (!empty($request->day_1_break)) {
            $appl->day1_breakfast = $request->day_1_break;
        }
        else $appl->day1_breakfast = 0;
        if (!empty($request->day_1_lunch)) {
            $appl->day1_lunch = $request->day_1_lunch;
        }
        else $appl->day1_lunch = 0;
        if (!empty($request->day_1_dinner)) {
            $appl->day1_dinner = $request->day_1_dinner;
        }
        else $appl->day1_dinner = 0;
        if (!empty($request->day_2_break)) {
            $appl->day2_breakfast = $request->day_2_break;
        }
        else $appl->day2_breakfast = 0;
        if (!empty($request->day_2_lunch)) {
            $appl->day2_lunch = $request->day_2_lunch;
        }
        else $appl->day2_lunch = 0;
        if (!empty($request->day_2_dinner)) {
            $appl->day2_dinner = $request->day_2_dinner;
        }
        else  $appl->day2_dinner = 0;
        if (!empty($request->day_3_break)) {
            $appl->day3_breakfast = $request->day_3_break;
        }
        else $appl->day3_breakfast = 0;
        if (!empty($request->day_3_lunch)) {
            $appl->day3_lunch = $request->day_3_lunch;
        }
        else $appl->day3_lunch = 0;
        if (!empty($request->day_3_dinner)) {
            $appl->day3_dinner = $request->day_3_dinner;
        }
        else $appl->day3_dinner = 0;
        if (!empty($request->day_4_break)) {
            $appl->day4_breakfast = $request->day_4_break;
        }
        else $appl->day4_breakfast = 0;
        if (!empty($request->day_4_lunch)) {
            $appl->day4_lunch = $request->day_4_lunch;
        }
        else $appl->day4_lunch = 0;
        if (!empty($request->day_4_dinner)) {
            $appl->day4_dinner = $request->day_4_dinner;
        }
        else $appl->day4_dinner = 0;
        if (!empty($request->day_5_break)) {
            $appl->day5_breakfast = $request->day_5_break;
        }
        else $appl->day5_breakfast = 0;
        if (!empty($request->day_5_lunch)) {
            $appl->day5_lunch = $request->day_5_lunch;
        }
        else $appl->day5_lunch = 0;
        if (!empty($request->day_5_dinner)) {
            $appl->day5_dinner = $request->day_5_dinner;
        }
        else $appl->day5_dinner = 0;

        if (!empty($request->special_1)) {
            $appl->special_1 = $request->special_1;
        }
        else $appl->special_1 = 0;

        if (!empty($request->special_2)) {
            $appl->special_2 = $request->special_2;
        }
        else $appl->special_2 = 0;
        if (!empty($request->special_3)) {
            $appl->special_3 = $request->special_3;
        }
        else $appl->special_3 = 0;

        if(!empty($request->accom)) {
            if ($request->accom == 1) {
                $appl->accom_1 = 1;
            } else $appl->accom_1 = 0;
            if ($request->accom == 2) {
                $appl->accom_2 = 1;
            } else $appl->accom_2 = 0;
            if ($request->accom == 3) {
                $appl->accom_3 = 1;
            } else $appl->accom_3 = 0;
            if ($request->accom == 4) {
                $appl->accom_4 = 1;
            } else $appl->accom_4 = 0;
            if ($request->accom == 5) {
                $appl->accom_5 = 1;
            } else $appl->accom_5 = 0;
            if ($request->accom == 98) {
                $appl->accom_98 = 1;
            } else $appl->accom_98 = 0;
            if ($request->accom == 99) {
                $appl->accom_99 = 1;
            } else $appl->accom_99 = 0;
        }
        $appl->extra = $request->extra;

        $appl->updated_at = Carbon::now();

        $appl->save();

        return redirect()->route('user.application.index')
            ->with('message', "Application updated successfully")
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
        Application::destroy($id);
        return redirect()
            ->route('user.application.index')
            ->with('message', 'Deleted')
            ->with('message_type', "success");
    }

    public function confirm(){
        $conference = Conference::where('status', 1)->first();
        if(!$conference){
            session()->put('message', "No active conference at the moment");
            session()->put('message_type', "danger");
            return view('backend.application.user_application')
                ->with('no_conference', true);
        }
        $appl = Application::where('user_id', Auth::id())->where('conference_id', $conference->id)->first();
        $appl->status = 2;

        $appl->save();

        return redirect()
            ->route('user.application.index')
            ->with('message', 'Confirmed')
            ->with('message_type', "success");
    }
}
