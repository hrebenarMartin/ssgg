<?php

namespace App\Http\Controllers\Backend\Review;

use App\Models\EmailMessage;
use App\Models\Review;
use App\Models\ReviewFormFill;
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
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $review = Review::find($id);

        if ((Auth::user()->roles()->where('role_id', 4)->first() and Auth::id() == $review->reviewer->id) or
            Auth::user()->roles()->where('role_id', 1)->first()) {
            return view('backend.review.detail')
                ->with('review', $review)
                ->with('contribution', $review->contribution);
        } else {
            return redirect()->back()
                ->with("message", "You do not have permission to access that module")
                ->with("message_type", "danger");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $review = Review::find($id);
        if ((Auth::user()->roles()->where('role_id', 4)->first() and Auth::id() == $review->reviewer->id) or
            Auth::user()->roles()->where('role_id', 1)->first()) {
            return view('backend.review.edit')
                ->with('review', $review)
                ->with('form_fill', $review->form_fill)
                ->with('form', $review->form_fill->form);
        } else {
            return redirect()->back()
                ->with("message", "You do not have permission to access that module")
                ->with("message_type", "danger");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $review = Review::find($id);
        $fill = $review->form_fill;

        for ($i = 1; $i <= 10; $i++) {
            $fill["answer_" . $i] = $request['question_' . $i . '_a'];
        }

        $fill->conclusion = $request->conclusion;

        $fill->save();

        $review->rating = $request->rating_val;
        $review->approved = $request->approval;
        $review->review = $request->review;

        $review->save();

        //add email for contr author
        {
            $recipients[] = $review->contribution->author->email;
            $subject = __('email.review_updated_subject');
            $module = "Review-updated";
            $data = ["contribution_author" => $review->contribution->author->profile->id];

            EmailMessage::addMailToQueue($recipients, $subject, $module, $data);
        }

        return redirect()->route('review.myReview.show', $id)
            ->with('message', 'Review successfully updated')
            ->with('message_type', 'success');
    }

    public function acceptReview($id)
    {
        $review = Review::find($id);

        if ($review->reviewer->id != Auth::id()) {
            return redirect()->route('review.myReview.index')
                ->with('message', 'This review has not been assigned to you')
                ->with('message_type', 'danger');
        }


        $form_fill = new ReviewFormFill();

        $form_fill->review_id = $id;
        $form_fill->form_id = $review->contribution->conference->review_form->id;

        $form_fill->save();

        $review->accepted = 1;

        $review->form_fill_id = $form_fill->id;

        $review->save();

        //add email for contr author
        {
            $recipients[] = $review->contribution->author->email;
            $subject = __('email.review_accepted_subject');
            $module = "Review-accepted";
            $data = ["contribution_author" => $review->contribution->author->profile->id];

            EmailMessage::addMailToQueue($recipients, $subject, $module, $data);
        }

        if ($review->reviever != Auth::id()) {
            return redirect()->route('review.myReview.index')
                ->with('message', 'You accepted review #' . $review->id)
                ->with('message_type', 'success');
        }

    }

    public function rejectReview($id)
    {
        $review = Review::find($id);

        if ($review->reviewer->id != Auth::id()) {
            return redirect()->back()
                ->with('message', 'This review has not been assigned to you')
                ->with('message_type', 'danger');
        }

        $review->accepted = -1;

        $review->save();

        //add email for admin
        {
            $recipients[] = $review->assigner->email;
            $subject = __('email.review_rejected_subject');
            $module = "Review-rejected";
            $data = ["review_assigned_by" => $review->assigned_by, 'reviewer' => $review->reviewer->id];

            EmailMessage::addMailToQueue($recipients, $subject, $module, $data);
        }

        if ($review->reviever != Auth::id()) {
            return redirect()->back()
                ->with('message', 'You accepted review #' . $review->id)
                ->with('message_type', 'success');
        }

    }
}
