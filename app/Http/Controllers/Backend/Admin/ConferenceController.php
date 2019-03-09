<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Application;
use App\Models\Block;
use App\Models\Conference;
use App\Models\ConferenceConfiguration;
use App\Models\ConferenceGallery;
use App\Models\Contribution;
use App\Models\Country;
use App\Models\FrontMenu;
use App\Models\Page;
use App\Models\Profile;
use App\Models\UploadImages;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

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
            //'schedule_sk' => 'required',
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

        $config = new ConferenceConfiguration();

        $config->conference_id = $conf->id;
        if (!empty($request->day_1_break)) {
            $config->day1_breakfast = $request->day_1_break;
        }
        if (!empty($request->day_1_lunch)) {
            $config->day1_lunch = $request->day_1_lunch;
        }
        if (!empty($request->day_1_dinner)) {
            $config->day1_dinner = $request->day_1_dinner;
        }
        if (!empty($request->day_2_break)) {
            $config->day2_breakfast = $request->day_2_break;
        }
        if (!empty($request->day_2_lunch)) {
            $config->day2_lunch = $request->day_2_lunch;
        }
        if (!empty($request->day_2_dinner)) {
            $config->day2_dinner = $request->day_2_dinner;
        }
        if (!empty($request->day_3_break)) {
            $config->day3_breakfast = $request->day_3_break;
        }
        if (!empty($request->day_3_lunch)) {
            $config->day3_lunch = $request->day_3_lunch;
        }
        if (!empty($request->day_3_dinner)) {
            $config->day3_dinner = $request->day_3_dinner;
        }
        if (!empty($request->day_4_break)) {
            $config->day4_breakfast = $request->day_4_break;
        }
        if (!empty($request->day_4_lunch)) {
            $config->day4_lunch = $request->day_4_lunch;
        }
        if (!empty($request->day_4_dinner)) {
            $config->day4_dinner = $request->day_4_dinner;
        }
        if (!empty($request->day_5_break)) {
            $config->day5_breakfast = $request->day_5_break;
        }
        if (!empty($request->day_5_lunch)) {
            $config->day5_lunch = $request->day_5_lunch;
        }
        if (!empty($request->day_5_dinner)) {
            $config->day5_dinner = $request->day_5_dinner;
        }

        if (!empty($request->special_1)) {
            $config->special_1 = $request->special_1;
            $config->special_1_sk = $request->special_1_sk;
            $config->special_1_en = $request->special_1_en;
        }
        if (!empty($request->special_2)) {
            $config->special_2 = $request->special_2;
            $config->special_2_sk = $request->special_2_sk;
            $config->special_2_en = $request->special_2_en;
        }
        if (!empty($request->special_3)) {
            $config->special_3 = $request->special_3;
            $config->special_3_sk = $request->special_3_sk;
            $config->special_3_en = $request->special_3_en;
        }

        if (!empty($request->room_1)) {
            $config->accom_1 = $request->room_1;
            $config->accom_1_price = $request->room_1_price;
        }
        if (!empty($request->room_2)) {
            $config->accom_2 = $request->room_2;
            $config->accom_2_price = $request->room_2_price;
        }
        if (!empty($request->room_3)) {
            $config->accom_3 = $request->room_3;
            $config->accom_3_price = $request->room_3_price;
        }
        if (!empty($request->room_4)) {
            $config->accom_4 = $request->room_4;
            $config->accom_4_price = $request->room_4_price;
        }
        if (!empty($request->room_5)) {
            $config->accom_5 = $request->room_5;
            $config->accom_5_price = $request->room_5_price;
        }

        $config->extra_info_sk = $request->extra_sk;
        $config->extra_info_en = $request->extra_en;

        $config->updated_at = Carbon::now();
        $config->created_at = Carbon::now();

        $config->save();

        //Základné stránky s blokmi a odkazy sa vygenerujú automaticky
        $page = new Page();

        $page->module = 2;
        $page->title = $conf->year;
        $page->title_second = $conf->year;
        $page->alias = $conf->year;
        $page->description = $conf->title_sk;

        $page->save();

        $block = new Block();
        $block->page_id = $page->id;
        $block->title = $conf->year." Home";
        $block->type = 4; //Fixed
        $block->fixed_id = 99; //Conference first block
        $block->rank = 0;
        $block->conference_id = $conf->id;

        $block->save();

        $menu = new FrontMenu();

        $menu->name_sk = "Hlavná stránka";
        $menu->name_en = "Main page";
        $menu->route = "/konferencia";
        $menu->rank = 0;
        $menu->module = 2;
        $menu->conference_id = $conf->id;

        $menu->save();
        //----------------------------------------------------------

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
        $conference->address_country = Country::getCountryName($conference->address_country);
        $config = ConferenceConfiguration::where('conference_id', $id)->first();
        $gallery = ConferenceGallery::getConferenceGallery($id);

        $stats = collect();
        $stats->attendees = Application::where('status', '>=', 3)->where('conference_id', $id)->count();
        $stats->contributions = Contribution::where('conference_id', $id)->count();

        return view('backend.conference.detail')
            ->with('data', $conference)
            ->with('stats', $stats)
            ->with('config', $config)
            ->with('gallery', $gallery);
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
        $config = ConferenceConfiguration::where('conference_id', $id)->first();

        return view('backend.conference.edit')
            ->with('data', $conference)
            ->with('countries', $countries)
            ->with('config', $config);
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

        if($request->hasFile('pro_file') and $request->file('pro_file')->isValid()){
            $file = $request->file('pro_file');

            $file_path = public_path('/files/conference_proceedings/');
            if(File::isDirectory($file_path) or File::makeDirectory($file_path, 0777, true, true));

            $file_extension = strtolower($file->getClientOriginalExtension());
            $file_name = "conference_".$conf->year.".".$file_extension;

            if(File::exists($file_path.$file_name)){
                File::delete($file_path.$file_name);
            }

            if (!$file->move($file_path, $file_name)) {
                redirect()->route('admin.conferences.show', $id)
                    ->with('message', 'Error while saving file')
                    ->with('message_type', 'danger');
            }

            $conf->proceedings_file = $file_name;
        }

        $conf->save();

        if($conf->status == 3){
            FrontMenu::disableMenuOfConference($conf->id);
            Page::disablePagesOfConference($conf->id);
        }
        else{
            FrontMenu::enableMenuOfConference($conf->id);
            Page::enablePagesOfConference($conf->id);
        }

        $config = ConferenceConfiguration::where('conference_id', $id)->first();

        if (!empty($request->day_1_break)) {
            $config->day1_breakfast = $request->day_1_break;
        }
        else $config->day1_breakfast = 0;
        if (!empty($request->day_1_lunch)) {
            $config->day1_lunch = $request->day_1_lunch;
        }
        else $config->day1_lunch = 0;
        if (!empty($request->day_1_dinner)) {
            $config->day1_dinner = $request->day_1_dinner;
        }
        else $config->day1_dinner = 0;
        if (!empty($request->day_2_break)) {
            $config->day2_breakfast = $request->day_2_break;
        }
        else $config->day2_breakfast = 0;
        if (!empty($request->day_2_lunch)) {
            $config->day2_lunch = $request->day_2_lunch;
        }
        else $config->day2_lunch = 0;
        if (!empty($request->day_2_dinner)) {
            $config->day2_dinner = $request->day_2_dinner;
        }
        else  $config->day2_dinner = 0;
        if (!empty($request->day_3_break)) {
            $config->day3_breakfast = $request->day_3_break;
        }
        else $config->day3_breakfast = 0;
        if (!empty($request->day_3_lunch)) {
            $config->day3_lunch = $request->day_3_lunch;
        }
        else $config->day3_lunch = 0;
        if (!empty($request->day_3_dinner)) {
            $config->day3_dinner = $request->day_3_dinner;
        }
        else $config->day3_dinner = 0;
        if (!empty($request->day_4_break)) {
            $config->day4_breakfast = $request->day_4_break;
        }
        else $config->day4_breakfast = 0;
        if (!empty($request->day_4_lunch)) {
            $config->day4_lunch = $request->day_4_lunch;
        }
        else $config->day4_lunch = 0;
        if (!empty($request->day_4_dinner)) {
            $config->day4_dinner = $request->day_4_dinner;
        }
        else $config->day4_dinner = 0;
        if (!empty($request->day_5_break)) {
            $config->day5_breakfast = $request->day_5_break;
        }
        else $config->day5_breakfast = 0;
        if (!empty($request->day_5_lunch)) {
            $config->day5_lunch = $request->day_5_lunch;
        }
        else $config->day5_lunch = 0;
        if (!empty($request->day_5_dinner)) {
            $config->day5_dinner = $request->day_5_dinner;
        }
        else $config->day5_dinner = 0;

        if (!empty($request->special_1)) {
            $config->special_1 = $request->special_1;
            $config->special_1_sk = $request->special_1_sk;
            $config->special_1_en = $request->special_1_en;
        }
        else {
            $config->special_1 = 0;
            $config->special_1_sk = null;
            $config->special_1_en = null;
        }
        if (!empty($request->special_2)) {
            $config->special_2 = $request->special_2;
            $config->special_2_sk = $request->special_2_sk;
            $config->special_2_en = $request->special_2_en;
        }
        else{
            $config->special_2 = 0;
            $config->special_2_sk = null;
            $config->special_2_en = null;
        }
        if (!empty($request->special_3)) {
            $config->special_3 = $request->special_3;
            $config->special_3_sk = $request->special_3_sk;
            $config->special_3_en = $request->special_3_en;
        }
        else{
            $config->special_3 = 0;
            $config->special_3_sk = null;
            $config->special_3_en = null;
        }

        if (!empty($request->room_1)) {
            $config->accom_1 = $request->room_1;
            $config->accom_1_price = $request->room_1_price;
        }
        else {
            $config->accom_1 = 0;
            $config->accom_1_price = 0;
        }
        if (!empty($request->room_2)) {
            $config->accom_2 = $request->room_2;
            $config->accom_2_price = $request->room_2_price;
        }
        else{
            $config->accom_2 = 0;
            $config->accom_2_price = 0;
        }
        if (!empty($request->room_3)) {
            $config->accom_3 = $request->room_3;
            $config->accom_3_price = $request->room_3_price;
        }
        else{
            $config->accom_3 = 0;
            $config->accom_3_price = 0;
        }
        if (!empty($request->room_4)) {
            $config->accom_4 = $request->room_4;
            $config->accom_4_price = $request->room_4_price;
        }
        else{
            $config->accom_4 = 0;
            $config->accom_4_price = 0;
        }
        if (!empty($request->room_5)) {
            $config->accom_5 = $request->room_5;
            $config->accom_5_price = $request->room_5_price;
        }
        else{
            $config->accom_5 = 0;
            $config->accom_5_price = 0;
        }

        $config->extra_info_sk = $request->extra_sk;
        $config->extra_info_en = $request->extra_en;

        $config->updated_at = Carbon::now();
        $config->created_at = Carbon::now();

        $config->save();

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

        //FrontMenu::destroyMenuOfConference($id);

        Page::destroyPagesOfConference($id);

        Contribution::destroyContributionsOfConference($id);

        ConferenceConfiguration::destroyConfigOfConference($id);

        Conference::destroy($id);

        return redirect()->back()->with('message', 'Action successful')->with('message_type', 'success');
    }

    public function uploadImagesBlueImp(Request $request){
        $image_class = new UploadImages();

        $files = Input::file('files');
        $data = [];

        $conference_id = intval(Input::get('conference_id'));

        $conference = Conference::find($conference_id);

        $conference_file_name = 'Conference-'.$conference->year . '-';

        $data['conference_id'] = $conference_id;

        $res = $image_class->processImagesBlueImp($files, 'conference', $data['conference_id'], $conference_file_name, $data);

        Log::info('upload_blue_imp', ['object' => $res] );

        // errors, no uploaded file
        return response()->json(['files' => $res ]);
    }

}
