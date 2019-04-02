<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Contribution;
use App\Models\ContributionComment;
use App\Models\Review;
use App\User;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContributionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contr = Contribution::getListDetail();

        //dd($contr);

        return view('backend.contribution.contribution_listing_admin')
            ->with('contributions', $contr);
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

        $contribution = Contribution::find($id);


        $contribution_author = $contribution->author->profile;
        $comments = $contribution->comments;

        $reviewers = User::whereHas('roles', function($query){
            $query->where('role_id', '=', 4);
        })->get();

        foreach ($reviewers as $r){
            $r->profile = User::find($r->id)->profile;
        }

        return view('backend.contribution.contribution_detail_admin')
            ->with('contribution', $contribution)
            ->with('contribution_author', $contribution_author)
            ->with('contribution_comments', $comments)
            ->with('reviewers', $reviewers);

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

    public function assignReviewer(Request $request, $contribution_id){

        $old_review = Contribution::find($contribution_id)->review;

        if($old_review){
            $old_review->delete();
        }

        $review = new Review();
        $review->user_id = $request->rev;
        $review->contribution_id = $contribution_id;
        $review->save();

        return redirect()->route('admin.contributions.show',$contribution_id);
    }
}
