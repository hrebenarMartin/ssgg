<?php

namespace App\Http\Controllers\Backend\Dashboard;

use App\Models\Application;
use App\Models\Conference;
use App\Models\ConferenceGallery;
use App\Models\Contribution;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = Profile::where('user_id', Auth::id())->first();
        $conference = Conference::where('status', '!=', 3)->first();
        $stats = collect();
        $stats->put('participants', $conference ? Application::getConferenceParticipantsCount($conference->id) : -1);
        $stats->put('participants_at', Application::getAllTimeParticipantsCount());
        $stats->put('contributions', $conference ? Contribution::getConferenceContributionsCount($conference->id) : -1);
        $stats->put('contributions_at', Contribution::getAllTimeContributionsCount());
        $stats->put('conferences', Conference::getAllTimeConferenceCount());
        $stats->put('photos_at', ConferenceGallery::getAllTimePhotosCount());

        return view('backend.dashboard.index')
            ->with('profile', $profile)
            ->with('conference', $conference)
            ->with('stats', $stats);
    }

}
