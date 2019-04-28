<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Conference;
use App\Models\ReviewForm;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConferenceReviewFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($cid)
    {
        $conference = Conference::find($cid);
        $form = null;
        if ($conference->review_form) {
            $form = $conference->review_form;
            return view('backend.conference.review_form_edit')
                ->with('data', $form);
        } else {
            return view('backend.conference.review_form_create')
                ->with('conference', $conference);
        }
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
    public function store(Request $request, $cid)
    {
        $form = new ReviewForm();

        $form->conference_id = $cid;

        for ($i = 1; $i <= 10; $i++){
            $form["question_".$i."_sk"] = $request['q_'.$i.'_sk'];
            $form["question_".$i."_en"] = $request['q_'.$i.'_en'];
            if(isset($request['q_'.$i.'_t'])){
                $form["question_".$i."_type"] = $request['q_'.$i.'_t'];
            }
        }

        $form->question_conclusion_sk = $request['q_conclusion_sk'];
        $form->question_conclusion_en = $request['q_conclusion_en'];

        if (isset($request->opened)) {
            $form->opened = 1;
        }
        else{
            $form->opened = 0;
        }

        $form->fill_until = Carbon::now();

        $form->save();

        return redirect()->route('admin.conferences.review_form.index', $cid)
            ->with('message', "Update successful")->with('message_type', "success");
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $cid)
    {
        //dd($request);

        $conference = Conference::find($cid);
        $form = $conference->review_form;

        for ($i = 1; $i <= 10; $i++){
            $form["question_".$i."_sk"] = $request['q_'.$i.'_sk'];
            $form["question_".$i."_en"] = $request['q_'.$i.'_en'];
            $form["question_".$i."_type"] = $request['q_'.$i.'_t'];
        }

        $form->question_conclusion_sk = $request['q_conclusion_sk'];
        $form->question_conclusion_en = $request['q_conclusion_en'];

        if (isset($request->opened)) {
            $form->opened = 1;
        }
        else{
            $form->opened = 0;
        }

        $form->fill_until = Carbon::now();

        $form->save();

        return redirect()->route('admin.conferences.review_form.index', $cid)
            ->with('message', "Update successful")->with('message_type', "success");
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
}
