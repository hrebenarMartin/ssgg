<?php

namespace App\Http\Controllers\Backend\User;

use App\Models\Profile;
use app\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        $user = User::find($id);
        $profile = Profile::where('user_id', $id)->first();
        $profile->country = DB::table('countries')->where('id', $profile->address_country)->first();
        $profile->email = $user->email;

        //dd($profile);
        return view('backend.profile.detail')
            ->with('profile', $profile);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Profile::where('user_id', $id)->first();
        $user = User::find($id);
        $data->email = $user->email;
        $countries = DB::table('countries')->get();
        return view('backend.profile.edit')
            ->with('data', $data)
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
        $module = "profiles";

        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'workplace' => 'required',
            'country' => 'required',
            'city' => 'required',
            'street' => 'required',
            'psc' => 'required',
        ];

        $this->validate($request, $rules);

        $profile = Profile::findOrFail($id);

        $profile->title_before = $request->title_before;
        $profile->first_name = $request->first_name;
        $profile->middle_name = $request->middle_name;
        $profile->last_name = $request->last_name;
        $profile->title_after = $request->title_after;
        $profile->gender = $request->gender;
        $profile->birthday = $request->birthday;
        $profile->workplace = $request->workplace;
        $profile->address_country = $request->country;
        $profile->address_city = $request->city;
        $profile->address_street = $request->street;
        $profile->address_psc = $request->psc;
        $profile->ico = $request->ico;
        $profile->dic = $request->dic;
        $profile->phone = $request->phone;

        if($request->hasFile('file')){

            if(!$request->file('file')->isValid()){
                return redirect()->route('user.profile.show', $profile->user_id)
                    ->with('message', 'Error while uploading files')
                    ->with('message_type', 'danger');
            }

            $file = $request->file('file');

            $file_path = public_path('/images/'.$module.'/'.$profile->user_id.'/');
            if(File::isDirectory($file_path) or File::makeDirectory($file_path, 0777, true, true));


            $file_extension = strtolower($file->getClientOriginalExtension());
            $file_name = "profile_".$profile->user_id.".".$file_extension;
            $file_name_no_extension =  "profile_".$profile->user_id;

            if(File::exists($file_path.$file_name_no_extension.".png")){
                File::delete($file_path.$file_name_no_extension.".png");
            }
            if(File::exists($file_path.$file_name_no_extension.".jpg")){
                File::delete($file_path.$file_name_no_extension.".jpg");
            }
            if(File::exists($file_path.$file_name_no_extension.".jpeg")){
                File::delete($file_path.$file_name_no_extension.".jpeg");
            }
            if(File::exists($file_path."orig_".$file_name_no_extension.".png")){
                File::delete($file_path."orig_".$file_name_no_extension.".png");
            }
            if(File::exists($file_path."orig_".$file_name_no_extension.".jpg")){
                File::delete($file_path."orig_".$file_name_no_extension.".jpg");
            }
            if(File::exists($file_path."orig_".$file_name_no_extension.".jpeg")){
                File::delete($file_path."orig_".$file_name_no_extension.".jpeg");
            }

            if (in_array($file_extension,['png', 'jpg', 'jpeg'])){

                // vyroime thumbnail a ulozime files/images
                $img = Image::make($file);


                // add callback functionality to retain maximal original image size
                $img->fit(500, 500);

                // save image
                $img->save($file_path.$file_name);

                //ulozime original suboru
                if (!$file->move($file_path, "orig_".$file_name)) {
                    redirect()->route('user.myContribution.index')->with('message', 'Error while saving files');
                }

            }

            $profile->image = $file_name;

        }

        $profile->save();

        return redirect()->route('user.profile.show', $id);

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
