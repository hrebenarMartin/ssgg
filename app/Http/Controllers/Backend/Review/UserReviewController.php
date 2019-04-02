<?php

namespace App\Http\Controllers\Backend\Review;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $accepted = $user->reviews()->where('accepted', 1)->get();
        $rejected = $user->reviews()->where('accepted', 0)->get();
        $new = $user->reviews()->where('accepted', null)->get();

        return view('backend.review.user_reviews')
            ->with('accepted', $accepted)
            ->with('rejected', $rejected)
            ->with('new', $new);
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
        $review = Review::find($id);

        return view('backend.review.detail')
            ->with('review', $review)
            ->with('contribution', $review->contribution);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backend.review.edit')
            ->with('review', Review::find($id));
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
        $review = Review::find($id);

        $review->rating = $request->rating_val;
        $review->approved = $request->approval;
        $review->review = $request->review;

        $review->save();

        return redirect()->route('review.myReview.show', $id)
            ->with('message', 'Review successfully updated')
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

    public function acceptReview($id){
        $review = Review::find($id);

        if($review->reviewer->id != Auth::id()){
            return redirect()->route('review.myReview.index')
                ->with('message', 'This review has not been assigned to you')
                ->with('message_type', 'danger');
        }

        $review->accepted = 1;

        $review->save();

        if($review->reviever != Auth::id()){
            return redirect()->route('review.myReview.index')
                ->with('message', 'You accepted review #'.$review->id)
                ->with('message_type', 'success');
        }

    }

    public function rejectReview($id){
        $review = Review::find($id);

        if($review->reviewer->id != Auth::id()){
            return redirect()->back()
                ->with('message', 'This review has not been assigned to you')
                ->with('message_type', 'danger');
        }

        $review->accepted = -1;

        $review->save();

        if($review->reviever != Auth::id()){
            return redirect()->back()
                ->with('message', 'You accepted review #'.$review->id)
                ->with('message_type', 'success');
        }

    }
}
