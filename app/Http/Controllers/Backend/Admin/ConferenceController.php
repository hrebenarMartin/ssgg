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
use Illuminate\Support\Facades\Auth;
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
        if (!Auth::user()->roles()->where('role_id', 1)->first()) {
            return redirect()->back()->with('message', "Access denied")->with('message_type', "danger");
        }

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
        if (!Auth::user()->roles()->where('role_id', 1)->first()) {
            return redirect()->back()->with('message', "Access denied")->with('message_type', "danger");
        }

        $can_create = Conference::where('status', '!=', 3)->count();

        if ($can_create > 0) {
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
     * @param \Illuminate\Http\Request $request
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

        //Main page generate
        {
            $page = new Page();
            $page->module = 2;
            $page->title = $conf->year;
            $page->title_second = $conf->year;
            $page->alias = $conf->year;
            $page->description = $conf->title_sk;
            $page->conference_id = $conf->id;
            $page->save();

            $block = new Block();
            $block->page_id = $page->id;
            $block->title = $conf->year . " Home";
            $block->type = 4; //Fixed
            $block->fixed_id = 99; //Conference first block
            $block->rank = 0;
            $block->conference_id = $conf->id;
            $block->save();

            $block = new Block();
            $block->page_id = $page->id;
            $block->title = "Karty";
            $block->type = 3;
            $block->fixed_id = 0;
            $block->content = '<section class="section section-lg pt-lg-0 mt--200">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="row row-grid">
                        <div class="col-lg-4">
                            <div class="card card-lift--hover shadow border-0">
                                <div class="card-body py-5 text-center">
                                    <h3 class="text-primary text-uppercase">Viac info</h3>
                                    <a href="#viac" class="btn btn-primary mt-4">Klik</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card card-lift--hover shadow border-0">
                                <div class="card-body py-5 text-center">
                                    <h3 class="text-success text-uppercase">Účastníci a príspevky</h3>
                                    <a href="/konferencia/ucastnici-prispevky" class="btn btn-success mt-4">Tu</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card card-lift--hover shadow border-0">
                                <div class="card-body py-5 text-center">
                                    <h3 class="text-danger text-uppercase">Galéria</h3>
                                    <a href="/konferencia/galeria" class="btn btn-danger mt-4">Sem</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>';
            $block->content_en = '<section class="section section-lg pt-lg-0 mt--200">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="row row-grid">
                        <div class="col-lg-4">
                            <div class="card card-lift--hover shadow border-0">
                                <div class="card-body py-5 text-center">
                                    <h3 class="text-primary text-uppercase">Viac info</h3>
                                    <a href="#viac" class="btn btn-primary mt-4">Klik</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card card-lift--hover shadow border-0">
                                <div class="card-body py-5 text-center">
                                    <h3 class="text-success text-uppercase">Účastníci a príspevky</h3>
                                    <a href="/konferencia/ucastnici-prispevky" class="btn btn-success mt-4">Tu</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card card-lift--hover shadow border-0">
                                <div class="card-body py-5 text-center">
                                    <h3 class="text-danger text-uppercase">Galéria</h3>
                                    <a href="/konferencia/galeria" class="btn btn-danger mt-4">Sem</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>';
            $block->rank = 1;
            $block->conference_id = $conf->id;
            $block->save();

            $block = new Block();
            $block->page_id = $page->id;
            $block->title = "Uvod";
            $block->type = 3;
            $block->fixed_id = 0;
            $block->content = '<section class="section section-lg" id="viac">
    <div class="container shape-container d-flex align-items-center py-md">
        <div class="col px-0">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-10 text-center pb-3">
                    <h3 class="display-4">Slovenská spoločnosť pre Geometriu a grafiku<br>a<br>Česká společnost pro geometrii a grafiku</h3>
                </div>
                <div class="row aling-items-center py-3">
                    <p>Vás srdečne pozývajú na už [[poradie]] ročník súbežne organizovaných konferencií v Českej a Slovenskej republike: </p>
                </div>
                <div class="col-lg-10 text-center pt-3">
                    <h2 class="display-3">39. konferencia o geometrii a grafike<br>' . $conf->volume . ' Sympózium o počítačovej geometrii SCG´' . $conf->year . '</h2>
                </div>
                <div class="col-lg-10 text-center pt-3">
                    <a href="#dalej"><h2 class="display-3 animated infinite heartBeat"><i class="fa fa-fw fa-chevron-down"></i></h2></a>
                </div>
            </div>
        </div>
    </div>';
            $block->content_en = '<section class="section section-lg" id="viac">
    <div class="container shape-container d-flex align-items-center py-md">
        <div class="col px-0">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-10 text-center pb-3">
                    <h3 class="display-4">Slovenská spoločnosť pre Geometriu a grafiku<br>a<br>Česká společnost pro geometrii a grafiku</h3>
                </div>
                <div class="row aling-items-center py-3">
                    <p>Vás srdečne pozývajú na už [[poradie]] ročník súbežne organizovaných konferencií v Českej a Slovenskej republike: </p>
                </div>
                <div class="col-lg-10 text-center pt-3">
                    <h2 class="display-3">[[poradie]] konferencia o geometrii a grafike<br>' . $conf->volume . ' Sympózium o počítačovej geometrii SCG´' . $conf->year . '</h2>
                </div>
                <div class="col-lg-10 text-center pt-3">
                    <a href="#dalej"><h2 class="display-3 animated infinite heartBeat"><i class="fa fa-fw fa-chevron-down"></i></h2></a>
                </div>
            </div>
        </div>
    </div>';
            $block->rank = 2;
            $block->conference_id = $conf->id;
            $block->save();

            $block = new Block();
            $block->page_id = $page->id;
            $block->title = "Programove zameranie a výbor";
            $block->type = 3;
            $block->fixed_id = 0;
            $block->content = '<div class="section section-sm" id="dalej">
    <div class="container shape-container d-flex">
        <div class="col px-0">
            <div class="row align-items-center justify-content-center">
                <div class="col-sm-10">
                    <h3 class="py-2">Programové zameranie</h3>
                    <ul>
                        <li>nové technológie a stratégie vo výučbe geometrie</li>
                        <li>geometria a jej aplikácie vo vede, technike a umení</li>
                        <li>geometrické modelovanie</li>
                    </ul>
                    <br>
                    <p>Vítané sú všetky príspevky týkajúce sa metodiky výučby 
                    geometrie, referáty a prednášky zo všetkých oblastí geometrie a 
                    jej aplikácií v technických a vedných disciplínach. 
                    Svoje príspevky môžu účastníci sympózia prezentovať 
                    aj formou posterov, na výstavke modelov, prípadne ukážkami 
                    didaktických materiálov alebo predvádzaním počítačových programov 
                    počas celého trvania sympózia.</p>
                    <br>
                    <br>
                    <h3 class="py-2">Programový výbor</h3>
                    <ul>
                        <li>Priezvisko Meno, Univerzita, Mesto, Štát</li>
                        <li>Priezvisko Meno, Univerzita, Mesto, Štát</li>
                        <li>Priezvisko Meno, Univerzita, Mesto, Štát</li>
                        <li>Priezvisko Meno, Univerzita, Mesto, Štát</li>
                        <li>...</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>';
            $block->content_en = '<div class="section section-sm" id="dalej">
    <div class="container shape-container d-flex">
        <div class="col px-0">
            <div class="row align-items-center justify-content-center">
                <div class="col-sm-10">
                    <h3 class="py-2">Programové zameranie</h3>
                    <ul>
                        <li>nové technológie a stratégie vo výučbe geometrie</li>
                        <li>geometria a jej aplikácie vo vede, technike a umení</li>
                        <li>geometrické modelovanie</li>
                    </ul>
                    <br>
                    <p>Vítané sú všetky príspevky týkajúce sa metodiky výučby 
                    geometrie, referáty a prednášky zo všetkých oblastí geometrie a 
                    jej aplikácií v technických a vedných disciplínach. 
                    Svoje príspevky môžu účastníci sympózia prezentovať 
                    aj formou posterov, na výstavke modelov, prípadne ukážkami 
                    didaktických materiálov alebo predvádzaním počítačových programov 
                    počas celého trvania sympózia.</p>
                    <br>
                    <br>
                    <h3 class="py-2">Programový výbor</h3>
                    <ul>
                        <li>Priezvisko Meno, Univerzita, Mesto, Štát</li>
                        <li>Priezvisko Meno, Univerzita, Mesto, Štát</li>
                        <li>Priezvisko Meno, Univerzita, Mesto, Štát</li>
                        <li>Priezvisko Meno, Univerzita, Mesto, Štát</li>
                        <li>...</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>';
            $block->rank = 3;
            $block->conference_id = $conf->id;
            $block->save();

            $block = new Block();
            $block->page_id = $page->id;
            $block->title = "Termín, miesto konania a poplatky";
            $block->type = 3;
            $block->fixed_id = 0;
            $block->content = '<div class="section section-sm" id="dalej">
    <div class="container shape-container d-flex">
        <div class="col px-0">
            <div class="row align-items-center justify-content-center">
                <div class="col-sm-10">
                    <h3 class="py-2">Termín a miesto konania</h3>
                    <ul>
                        <li>' . Carbon::createFromFormat("Y-m-d", $conf->conference_start)->format("d,M Y") . '</li>
                        <li>' . $conf->address_place . '</li>
                        <li>' . $conf->address_city . '</li>
                        <li><a href="/konferencia/miesto-konania">Klikni pre viac informácií</a></li>
                    </ul>
                    <br>
                    <br>
                    <h3 class="py-2">Prihlášky a registračný poplatok</h3>
                    <ul>
                        <li>Všetky potrebné údaje nádjete v sekcii [Názov sekcie] po prihlásení do systému</li>
                        <li><a href="/dashboard">Prihlásenie/Registrácia do systému</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>';
            $block->content_en = '<div class="section section-sm" id="dalej">
    <div class="container shape-container d-flex">
        <div class="col px-0">
            <div class="row align-items-center justify-content-center">
                <div class="col-sm-10">
                    <h3 class="py-2">Termín a miesto konania</h3>
                    <ul>
                        <li>' . Carbon::createFromFormat("Y-m-d", $conf->conference_start)->format("d,M Y") . '</li>
                        <li>' . $conf->address_place . '</li>
                        <li>' . $conf->address_city . '</li>
                        <li><a href="/konferencia/miesto-konania">Klikni pre viac informácií</a></li>
                    </ul>
                    <br>
                    <br>
                    <h3 class="py-2">Prihlášky a registračný poplatok</h3>
                    <ul>
                        <li>Všetky potrebné údaje nádjete v sekcii [Názov sekcie] po prihlásení do systému</li>
                        <li><a href="/dashboard">Prihlásenie/Registrácia do systému</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>';
            $block->rank = 4;
            $block->conference_id = $conf->id;
            $block->save();

            $block = new Block();
            $block->page_id = $page->id;
            $block->title = "Program konferencie";
            $block->type = 4;
            $block->fixed_id = 98;
            $block->rank = 5;
            $block->conference_id = $conf->id;
            $block->save();
        }

        //Page venue
        {
            $page = new Page();
            $page->module = 2;
            $page->title = "Miesto konania";
            $page->title_second = "Venue";
            $page->alias = "miesto-konania";
            $page->description = $conf->title_sk;
            $page->conference_id = $conf->id;
            $page->save();

            $block = new Block();
            $block->page_id = $page->id;
            $block->title = "Hlavička";
            $block->type = 3;
            $block->fixed_id = 0;
            $block->content = '<section class="section section-lg section-hero section-shaped pb-5">
    <!-- Background circles -->
    <div class="shape shape-style-1 shape-primary">
        <span class="span-150 animated pulse infinite delay-1s slow"></span>
        <span class="span-50 animated pulse infinite delay-2s slower"></span>
        <span class="span-50 animated pulse infinite delay-4s slow"></span>
        <span class="span-75 animated pulse infinite delay-2s slow"></span>
        <span class="span-100 animated pulse infinite delay-3s slow"></span>
        <span class="span-75 animated pulse infinite delay-1s slow"></span>
        <span class="span-50 animated pulse infinite delay-5s slow"></span>
        <span class="span-100 animated pulse infinite delay-2s slow"></span>
        <span class="span-50 animated pulse infinite delay-5s slow"></span>
        <span class="span-100 animated pulse infinite delay-3s slow"></span>

    </div>
    <div class="container shape-container d-flex align-items-center py-lg">
        <div class="col px-0">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-2 text-white">Detaily, ktoré musíte poznať</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- SVG separator -->
    <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
            <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
        </svg>
    </div>
</section>';
            $block->content_en = '<section class="section section-lg section-hero section-shaped pb-5">
    <!-- Background circles -->
    <div class="shape shape-style-1 shape-primary">
        <span class="span-150 animated pulse infinite delay-1s slow"></span>
        <span class="span-50 animated pulse infinite delay-2s slower"></span>
        <span class="span-50 animated pulse infinite delay-4s slow"></span>
        <span class="span-75 animated pulse infinite delay-2s slow"></span>
        <span class="span-100 animated pulse infinite delay-3s slow"></span>
        <span class="span-75 animated pulse infinite delay-1s slow"></span>
        <span class="span-50 animated pulse infinite delay-5s slow"></span>
        <span class="span-100 animated pulse infinite delay-2s slow"></span>
        <span class="span-50 animated pulse infinite delay-5s slow"></span>
        <span class="span-100 animated pulse infinite delay-3s slow"></span>

    </div>
    <div class="container shape-container d-flex align-items-center py-lg">
        <div class="col px-0">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-2 text-white">Must know details</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- SVG separator -->
    <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
            <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
        </svg>
    </div>
</section>';
            $block->rank = 0;
            $block->conference_id = $conf->id;
            $block->save();

            $block = new Block();
            $block->page_id = $page->id;
            $block->title = "Lokácia";
            $block->type = 4;
            $block->fixed_id = 97;
            $block->rank = 1;
            $block->conference_id = $conf->id;
            $block->save();

            $block = new Block();
            $block->page_id = $page->id;
            $block->title = "Lokácia";
            $block->type = 4;
            $block->fixed_id = 96;
            $block->rank = 2;
            $block->conference_id = $conf->id;
            $block->save();

            $block = new Block();
            $block->page_id = $page->id;
            $block->title = "Lokácia";
            $block->type = 4;
            $block->fixed_id = 95;
            $block->rank = 3;
            $block->conference_id = $conf->id;
            $block->save();
        }

        //Page Participants and Contributions
        {
            $page = new Page();
            $page->module = 2;
            $page->title = "Účatníci a príspevky";
            $page->title_second = "Participants and Contributions";
            $page->alias = "ucastnici-prispevky";
            $page->description = $conf->title_sk;
            $page->conference_id = $conf->id;
            $page->save();

            $block = new Block();
            $block->page_id = $page->id;
            $block->title = "Hlavička";
            $block->type = 3;
            $block->fixed_id = 0;
            $block->content = '<section class="section section-lg section-hero section-shaped pb-5">
    <!-- Background circles -->
    <div class="shape shape-style-1 shape-primary">
        <span class="span-150 animated pulse infinite delay-1s slow"></span>
        <span class="span-50 animated pulse infinite delay-2s slower"></span>
        <span class="span-50 animated pulse infinite delay-4s slow"></span>
        <span class="span-75 animated pulse infinite delay-2s slow"></span>
        <span class="span-100 animated pulse infinite delay-3s slow"></span>
        <span class="span-75 animated pulse infinite delay-1s slow"></span>
        <span class="span-50 animated pulse infinite delay-5s slow"></span>
        <span class="span-100 animated pulse infinite delay-2s slow"></span>
        <span class="span-50 animated pulse infinite delay-5s slow"></span>
        <span class="span-100 animated pulse infinite delay-3s slow"></span>

    </div>
    <div class="container shape-container d-flex align-items-center py-lg">
        <div class="col px-0">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-2 text-white">Účastníci a príspevky</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- SVG separator -->
    <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
            <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
        </svg>
    </div>
</section>';
            $block->content_en = '<section class="section section-lg section-hero section-shaped pb-5">
    <!-- Background circles -->
    <div class="shape shape-style-1 shape-primary">
        <span class="span-150 animated pulse infinite delay-1s slow"></span>
        <span class="span-50 animated pulse infinite delay-2s slower"></span>
        <span class="span-50 animated pulse infinite delay-4s slow"></span>
        <span class="span-75 animated pulse infinite delay-2s slow"></span>
        <span class="span-100 animated pulse infinite delay-3s slow"></span>
        <span class="span-75 animated pulse infinite delay-1s slow"></span>
        <span class="span-50 animated pulse infinite delay-5s slow"></span>
        <span class="span-100 animated pulse infinite delay-2s slow"></span>
        <span class="span-50 animated pulse infinite delay-5s slow"></span>
        <span class="span-100 animated pulse infinite delay-3s slow"></span>

    </div>
    <div class="container shape-container d-flex align-items-center py-lg">
        <div class="col px-0">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-2 text-white">Participants and Contributions</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- SVG separator -->
    <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
            <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
        </svg>
    </div>
</section>';
            $block->rank = 0;
            $block->conference_id = $conf->id;
            $block->save();

            $block = new Block();
            $block->page_id = $page->id;
            $block->title = "Zoznam účastníkov a príspevky";
            $block->type = 4;
            $block->fixed_id = 94;
            $block->rank = 1;
            $block->conference_id = $conf->id;
            $block->save();
        }

        //Page gallery
        {
            $page = new Page();
            $page->module = 2;
            $page->title = "Galária";
            $page->title_second = "Gallery";
            $page->alias = "galeria";
            $page->description = $conf->title_sk;
            $page->conference_id = $conf->id;
            $page->save();

            $block = new Block();
            $block->page_id = $page->id;
            $block->title = "Hlavička";
            $block->type = 3;
            $block->fixed_id = 0;
            $block->content = '<section class="section section-lg section-hero section-shaped pb-5">
    <!-- Background circles -->
    <div class="shape shape-style-1 shape-primary">
        <span class="span-150 animated pulse infinite delay-1s slow"></span>
        <span class="span-50 animated pulse infinite delay-2s slower"></span>
        <span class="span-50 animated pulse infinite delay-4s slow"></span>
        <span class="span-75 animated pulse infinite delay-2s slow"></span>
        <span class="span-100 animated pulse infinite delay-3s slow"></span>
        <span class="span-75 animated pulse infinite delay-1s slow"></span>
        <span class="span-50 animated pulse infinite delay-5s slow"></span>
        <span class="span-100 animated pulse infinite delay-2s slow"></span>
        <span class="span-50 animated pulse infinite delay-5s slow"></span>
        <span class="span-100 animated pulse infinite delay-3s slow"></span>

    </div>
    <div class="container shape-container d-flex align-items-center py-lg">
        <div class="col px-0">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-2 text-white">Galéria</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- SVG separator -->
    <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
            <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
        </svg>
    </div>
</section>';
            $block->content_en = '<section class="section section-lg section-hero section-shaped pb-5">
    <!-- Background circles -->
    <div class="shape shape-style-1 shape-primary">
        <span class="span-150 animated pulse infinite delay-1s slow"></span>
        <span class="span-50 animated pulse infinite delay-2s slower"></span>
        <span class="span-50 animated pulse infinite delay-4s slow"></span>
        <span class="span-75 animated pulse infinite delay-2s slow"></span>
        <span class="span-100 animated pulse infinite delay-3s slow"></span>
        <span class="span-75 animated pulse infinite delay-1s slow"></span>
        <span class="span-50 animated pulse infinite delay-5s slow"></span>
        <span class="span-100 animated pulse infinite delay-2s slow"></span>
        <span class="span-50 animated pulse infinite delay-5s slow"></span>
        <span class="span-100 animated pulse infinite delay-3s slow"></span>

    </div>
    <div class="container shape-container d-flex align-items-center py-lg">
        <div class="col px-0">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-2 text-white">Gallery</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- SVG separator -->
    <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
            <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
        </svg>
    </div>
</section>';
            $block->rank = 0;
            $block->conference_id = $conf->id;
            $block->save();

            $block = new Block();
            $block->page_id = $page->id;
            $block->title = "Galéria";
            $block->type = 4;
            $block->fixed_id = 93;
            $block->rank = 1;
            $block->conference_id = $conf->id;
            $block->save();
        }

        //Base Menu items
        {
            $menu = new FrontMenu();

            $menu->name_sk = "Hlavná stránka";
            $menu->name_en = "Main page";
            $menu->route = "/konferencia";
            $menu->rank = 0;
            $menu->module = 2;
            $menu->conference_id = $conf->id;

            $menu->save();

            $menu = new FrontMenu();

            $menu->name_sk = "Miesto konania";
            $menu->name_en = "Venue";
            $menu->route = "/konferencia/miesto-konania";
            $menu->rank = 1;
            $menu->module = 2;
            $menu->conference_id = $conf->id;

            $menu->save();

            $menu = new FrontMenu();

            $menu->name_sk = "Účastníci a príspevky";
            $menu->name_en = "Participants and Contributions";
            $menu->route = "/konferencia/ucastnici-prispevky";
            $menu->rank = 2;
            $menu->module = 2;
            $menu->conference_id = $conf->id;

            $menu->save();

            $menu = new FrontMenu();

            $menu->name_sk = "Galéria";
            $menu->name_en = "Gallery";
            $menu->route = "/konferencia/galeria";
            $menu->rank = 3;
            $menu->module = 2;
            $menu->conference_id = $conf->id;

            $menu->save();
        }
        //----------------------------------------------------------

        return redirect()->route('admin.conferences.index')
            ->with('message', "Conference successfully created")
            ->with('message_type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $conference = Conference::find($id);
        if (!Auth::user()->roles()->where('role_id', 1)->first() and $conference->status == 3) {
            return redirect()->back()->with('message', "Access denied")->with('message_type', "danger");
        }
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $conference = Conference::find($id);

        if (!Auth::user()->roles()->where('role_id', 1)->first() and $conference->status == 3) {
            return redirect()->back()->with('message', "Access denied")->with('message_type', "danger");
        }

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
     * @param \Illuminate\Http\Request $request
     * @param int $id
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

        if ($request->hasFile('pro_file') and $request->file('pro_file')->isValid()) {
            $file = $request->file('pro_file');

            $file_path = public_path('/files/conference_proceedings/');
            if (File::isDirectory($file_path) or File::makeDirectory($file_path, 0777, true, true)) ;

            $file_extension = strtolower($file->getClientOriginalExtension());
            $file_name = "conference_" . $conf->year . "." . $file_extension;

            if (File::exists($file_path . $file_name)) {
                File::delete($file_path . $file_name);
            }

            if (!$file->move($file_path, $file_name)) {
                redirect()->route('admin.conferences.show', $id)
                    ->with('message', 'Error while saving file')
                    ->with('message_type', 'danger');
            }

            $conf->proceedings_file = $file_name;
        }

        $conf->save();

        if ($conf->status == 3) {
            FrontMenu::disableMenuOfConference($conf->id);
            Page::disablePagesOfConference($conf->id);
        } else {
            FrontMenu::enableMenuOfConference($conf->id);
            Page::enablePagesOfConference($conf->id);
        }

        $config = ConferenceConfiguration::where('conference_id', $id)->first();

        if (!empty($request->day_1_break)) {
            $config->day1_breakfast = $request->day_1_break;
        } else $config->day1_breakfast = 0;
        if (!empty($request->day_1_lunch)) {
            $config->day1_lunch = $request->day_1_lunch;
        } else $config->day1_lunch = 0;
        if (!empty($request->day_1_dinner)) {
            $config->day1_dinner = $request->day_1_dinner;
        } else $config->day1_dinner = 0;
        if (!empty($request->day_2_break)) {
            $config->day2_breakfast = $request->day_2_break;
        } else $config->day2_breakfast = 0;
        if (!empty($request->day_2_lunch)) {
            $config->day2_lunch = $request->day_2_lunch;
        } else $config->day2_lunch = 0;
        if (!empty($request->day_2_dinner)) {
            $config->day2_dinner = $request->day_2_dinner;
        } else  $config->day2_dinner = 0;
        if (!empty($request->day_3_break)) {
            $config->day3_breakfast = $request->day_3_break;
        } else $config->day3_breakfast = 0;
        if (!empty($request->day_3_lunch)) {
            $config->day3_lunch = $request->day_3_lunch;
        } else $config->day3_lunch = 0;
        if (!empty($request->day_3_dinner)) {
            $config->day3_dinner = $request->day_3_dinner;
        } else $config->day3_dinner = 0;
        if (!empty($request->day_4_break)) {
            $config->day4_breakfast = $request->day_4_break;
        } else $config->day4_breakfast = 0;
        if (!empty($request->day_4_lunch)) {
            $config->day4_lunch = $request->day_4_lunch;
        } else $config->day4_lunch = 0;
        if (!empty($request->day_4_dinner)) {
            $config->day4_dinner = $request->day_4_dinner;
        } else $config->day4_dinner = 0;
        if (!empty($request->day_5_break)) {
            $config->day5_breakfast = $request->day_5_break;
        } else $config->day5_breakfast = 0;
        if (!empty($request->day_5_lunch)) {
            $config->day5_lunch = $request->day_5_lunch;
        } else $config->day5_lunch = 0;
        if (!empty($request->day_5_dinner)) {
            $config->day5_dinner = $request->day_5_dinner;
        } else $config->day5_dinner = 0;

        if (!empty($request->special_1)) {
            $config->special_1 = $request->special_1;
            $config->special_1_sk = $request->special_1_sk;
            $config->special_1_en = $request->special_1_en;
        } else {
            $config->special_1 = 0;
            $config->special_1_sk = null;
            $config->special_1_en = null;
        }
        if (!empty($request->special_2)) {
            $config->special_2 = $request->special_2;
            $config->special_2_sk = $request->special_2_sk;
            $config->special_2_en = $request->special_2_en;
        } else {
            $config->special_2 = 0;
            $config->special_2_sk = null;
            $config->special_2_en = null;
        }
        if (!empty($request->special_3)) {
            $config->special_3 = $request->special_3;
            $config->special_3_sk = $request->special_3_sk;
            $config->special_3_en = $request->special_3_en;
        } else {
            $config->special_3 = 0;
            $config->special_3_sk = null;
            $config->special_3_en = null;
        }

        if (!empty($request->room_1)) {
            $config->accom_1 = $request->room_1;
            $config->accom_1_price = $request->room_1_price;
        } else {
            $config->accom_1 = 0;
            $config->accom_1_price = 0;
        }
        if (!empty($request->room_2)) {
            $config->accom_2 = $request->room_2;
            $config->accom_2_price = $request->room_2_price;
        } else {
            $config->accom_2 = 0;
            $config->accom_2_price = 0;
        }
        if (!empty($request->room_3)) {
            $config->accom_3 = $request->room_3;
            $config->accom_3_price = $request->room_3_price;
        } else {
            $config->accom_3 = 0;
            $config->accom_3_price = 0;
        }
        if (!empty($request->room_4)) {
            $config->accom_4 = $request->room_4;
            $config->accom_4_price = $request->room_4_price;
        } else {
            $config->accom_4 = 0;
            $config->accom_4_price = 0;
        }
        if (!empty($request->room_5)) {
            $config->accom_5 = $request->room_5;
            $config->accom_5_price = $request->room_5_price;
        } else {
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->roles()->where('role_id', 1)->first()) {
            return redirect()->back()->with('message', "Access denied")->with('message_type', "danger");
        }

        //FrontMenu::destroyMenuOfConference($id);

        Page::destroyPagesOfConference($id);

        Contribution::destroyContributionsOfConference($id);

        //ConferenceConfiguration::destroyConfigOfConference($id);

        Conference::destroy($id);

        return redirect()->back()->with('message', 'Action successful')->with('message_type', 'success');
    }

    public function uploadImagesBlueImp(Request $request)
    {
        $image_class = new UploadImages();

        $files = Input::file('files');

        $conference_id = intval(Input::get('conference_id'));

        $conference = Conference::find($conference_id);

        $conference_file_name = 'Conference-' . $conference->year . '-';

        $res = $image_class->processImages($files, 'conference', $conference_id, $conference_file_name);

        Log::info('upload_blue_imp', ['object' => $res]);

        // errors, no uploaded file
        return response()->json(['files' => $res]);
    }

    public function conferenceParticipants($cid)
    {
        $conference = Conference::find($cid);
        if (!Auth::user()->roles()->where('role_id', 1)->first() and $conference->status == 3) {
            return redirect()->back()->with('message', "Access denied")->with('message_type', "danger");
        }
        $not_confirmed = $conference->applications()->where('status', 1)->get();
        $confirmed = $conference->applications()->where('status', '>', 1)->get();

        return view('backend.conference.conference_participants_list')
            ->with('not_confirmed', $not_confirmed)
            ->with('confirmed', $confirmed);
    }

    public function conferenceContributions($cid)
    {
        $conference = Conference::find($cid);
        if (!Auth::user()->roles()->where('role_id', 1)->first() and $conference->status == 3) {
            return redirect()->back()->with('message', "Access denied")->with('message_type', "danger");
        }

        $contributions = Contribution::getListDetail($conference->id);

        return view('backend.contribution.contribution_listing_admin')
            ->with('contributions', $contributions);
    }

    public function conferenceStatistics($cid)
    {
        $conference = Conference::find($cid);
        if (!Auth::user()->roles()->where('role_id', 1)->first() and $conference->status == 3) {
            return redirect()->back()->with('message', "Access denied")->with('message_type', "danger");
        }

        $stats = collect();
        $stats->contributions_all = $conference->contributions()->count();
        $stats->contributions = DB::table('contributions')->select(DB::raw("type, count(*) as count"))
            ->groupBy('type')
            ->where('conference_id', $conference->id)
            ->get();

        $stats->reviews = 0;
        $stats->reviews_approved = 0;
        $stats->reviews_not_approved = 0;
        $stats->reviews_avg_score = 0;

        foreach ($conference->contributions as $cc) {
            $rev = $cc->review;
            if ($rev and $rev->accepted == 1) {
                $stats->reviews += 1;
                if ($rev->approved == 1) {
                    $stats->reviews_approved += 1;
                } else {
                    $stats->reviews_not_approved += 1;
                }
                $stats->reviews_avg_score += $rev->rating;
            }
        }
        if ($stats->reviews > 0) {
            $stats->reviews_avg_score /= $stats->reviews;
        }

        $appl_conf = $conference->applications()->where('status', '>', 1)->get();

        $stats->applications_all = $conference->applications()->count();
        $stats->applications_confirmed = $conference->applications()->where('status', '>', 1)->get()->count();
        $stats->applications_paid = $conference->applications()->where('status', 3)->get()->count();
        $stats->applications_more = collect();
        for ($i = 1; $i <= 5; $i++) {
            $stats->applications_more['d' . $i . 'b'] = 0;
            $stats->applications_more['d' . $i . 'l'] = 0;
            $stats->applications_more['d' . $i . 'd'] = 0;
            $stats->applications_more['accom' . $i] = 0;
        }
        $stats->applications_more['special_1'] = 0;
        $stats->applications_more['special_2'] = 0;
        $stats->applications_more['special_3'] = 0;
        $stats->applications_more['accom98'] = 0;
        $stats->applications_more['accom99'] = 0;

        foreach ($appl_conf as $a) {
            for ($i = 1; $i <= 5; $i++) {
                $stats->applications_more['d' . $i . 'b'] += $a['day' . $i . '_breakfast'];
                $stats->applications_more['d' . $i . 'l'] += $a['day' . $i . '_lunch'];
                $stats->applications_more['d' . $i . 'd'] += $a['day' . $i . '_dinner'];
                $stats->applications_more['accom' . $i] += $a['accom_' . $i];
            }
            $stats->applications_more['special_1'] += $a->special_1;
            $stats->applications_more['special_2'] += $a->special_2;
            $stats->applications_more['special_3'] += $a->special_3;
            $stats->applications_more['accom98'] += $a->accom_98;
            $stats->applications_more['accom99'] += $a->accom_99;
        }

        //dd($stats);

        $conference_config = $conference->config;

        return view('backend.conference.stats')
            ->with('stats', $stats)
            ->with('conference', $conference)
            ->with('config', $conference_config);
    }

}
