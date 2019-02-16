<?php

namespace App\Http\Controllers\Backend\User;

use App\Models\Conference;
use App\Models\Contribution;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ContributionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $has_contribution = Contribution::where('user_id', Auth::id())->count() == 1;

        $conference = Conference::where('status', 1)->first();

        if(!$conference){
            return view('backend.contribution.user_contribution')
                ->with('no_conference');
        }

        $contrib_deadline = Conference::where('status', 1)->first()->registration_end;



        if($has_contribution == 0) return view('backend.contribution.user_contribution')
            ->with('no_contribution', $has_contribution)
            ->with('deadline', $contrib_deadline);
        else {
            $contribution = Contribution::where('user_id', Auth::id())->first();
            return view('backend.contribution.user_contribution')
                ->with('contribution', $contribution)
                ->with('deadline', $contrib_deadline);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Contribution::where('user_id', Auth::id())->count() > 0){
            return redirect()->route('user.myContribution.index')
                ->with('message', 'You can upload only one contribution')
                ->with('message_type', 'danger');
        }
        return view('backend.contribution.contribution_add');
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
        $module = 'contributions';

        $rules = [
            'title' => 'required|min:6',
            'type' => 'required',
            'abstract' => 'required',
            'file' => 'required|mimes:pdf',
        ];

        $this->validate($request, $rules);

        $contribution = new Contribution();

        $contribution->user_id = Auth::id();
        $contribution->title = $request->title;
        $contribution->type = $request->type;
        $contribution->abstract = $request->abstract;
        $contribution->conference_id = Conference::where('status', 1)->first()->id;

        if($request->hasFile('file') and $request->file('file')->isValid()){
            $file = $request->file('file');

            $file_path = public_path('/files/'.$module.'/');
            if(File::isDirectory($file_path) or File::makeDirectory($file_path, 0777, true, true));

            $file_extension = strtolower($file->getClientOriginalExtension());
            $file_name = "contribution_".$contribution->user_id.".".$file_extension;

            if (!$file->move($file_path, $file_name)) {
                redirect()->route('user.myContribution.index')
                    ->with('message', 'Error while saving files')
                    ->with('message_type', 'danger');
                ;
            }

            $contribution->file = $file_name;

        }
        else return redirect()->route('user.myContribution.index')
            ->with('message', 'Error while uploading files')
            ->with('message_type', 'danger');
        ;

        $contribution->save();

        return redirect()->route('user.myContribution.index')
            ->with('message', 'Contribution was successfully updated')
            ->with('message_type', 'success');
        ;
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
        $contribution = Contribution::find($id);

        if(!$contribution or $contribution->user_id != Auth::id()) return redirect()->route('user.myContribution.index')
            ->with('message', 'Invalid action')
            ->with('message_type', 'danger');

        return view('backend.contribution.contribution_edit')
            ->with('data', $contribution);
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
        $module = 'contributions';

        $rules = [
            'title' => 'required|min:6',
            'type' => 'required',
            'abstract' => 'required',
        ];

        $this->validate($request, $rules);

        $contribution = Contribution::findOrFail($id);

        $contribution->title = $request->title;
        $contribution->type = $request->type;
        $contribution->abstract = $request->abstract;

        if($request->hasFile('file')){
            if(!$request->file('file')->isValid()){
                return redirect()->route('user.myContribution.index')
                    ->with('message', 'Error while uploading files')
                    ->with('message_type', 'danger');
                ;
            }

            $file = $request->file('file');

            $file_path = public_path('/files/'.$module.'/');
            if(File::isDirectory($file_path) or File::makeDirectory($file_path, 0777, true, true));


            $file_extension = strtolower($file->getClientOriginalExtension());
            $file_name = "contribution_".$contribution->user_id.".".$file_extension;

            if(File::exists($file_path.$file_name)){
                File::delete($file_path.$file_name);
            }

            if (!$file->move($file_path, $file_name)) {
                redirect()->route('user.myContribution.index')
                    ->with('message', 'Error while saving files')
                    ->with('message_type', 'danger');
                ;
            }

            $contribution->file = $file_name;

        }

        $contribution->save();

        return redirect()->route('user.myContribution.index')
            ->with('message', 'Contribution was successfully updated')
            ->with('message_type', 'success');
        ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contribution = Contribution::find($id);
        if(File::exists(public_path('/files/contributions/').$contribution->file)){
            File::delete(public_path('/files/contributions/').$contribution->file);
        }
        Contribution::destroy($id);

        return redirect()->route('user.myContribution.index')
            ->with('message', 'Your contribution was successfully deleted.')
            ->with('message_type', 'success');
    }



    public function downloadContribution($id)
    {

        $contribution = Contribution::find($id);
        $file = public_path(). "/files/contributions/".$contribution->file;

        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        return response()->download($file, $contribution->file, $headers);
    }

    public function downloadTemplate($id)
    {
        switch ($id){
            case 1: $archive = 'template_word_sk.zip'; break;
            case 2: $archive = 'template_tex_sk.zip'; break;
            case 3: $archive = 'template_word_cz.zip'; break;
            case 4: $archive = 'template_tex_cz.zip'; break;
            case 5: $archive = 'template_word_en.zip'; break;
            case 6: $archive = 'template_tex_en.zip'; break;
        }

        $file = public_path(). "/files/contribution_templates/".$archive;

        $headers = [
            'Content-Type' => 'application/zip',
        ];

        return response()->download($file, $archive, $headers);
    }
}
