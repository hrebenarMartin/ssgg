<?php

namespace App\Http\Controllers\Backend\User;

use App\Models\Profile;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Translation\Dumper\PoFileDumper;

class UserController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = DB::table('users')->get();

        //dd($users);

        return view('backend.user.listing')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->pass_1 != $request->pass_2) {
            return redirect()->back()->with('message', "Entered passwords are not the same")->with('message_type', "warning");
        }

        $user = new User();

        $user->name = $request->name . " " . $request->surname;
        $user->email = $request->email;
        $user->password = bcrypt($request->pass_1);
        $user->created_at = now();
        $user->updated_at = now();

        $user->save();

        $profile = new Profile();

        $profile->user_id = $user->id;
        $profile->first_name = $request->name;
        $profile->last_name = $request->surname;
        $profile->created_at = now();
        $profile->updated_at = now();

        $profile->save();

        $ur1 = array_search(1, array_values($request->roles)) === false ? false : true;
        $ur2 = array_search(2, array_values($request->roles)) === false ? false : true;
        $ur3 = array_search(3, array_values($request->roles)) === false ? false : true;
        $ur4 = array_search(4, array_values($request->roles)) === false ? false : true;

        $ur1 ? $user->roles()->attach(1) : $user->roles()->detach(1);
        $ur2 ? $user->roles()->attach(2) : $user->roles()->detach(2);
        $ur3 ? $user->roles()->attach(3) : $user->roles()->detach(3);
        $ur4 ? $user->roles()->attach(4) : $user->roles()->detach(4);

        return redirect()->route('admin.user.index')->with('message', "User created")->with('message_type', "success");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $u_roles = $user->roles;
        $user_roles = array();

        foreach ($u_roles as $ur) {
            $user_roles[$ur->id] = true;
        }

        return view('backend.user.edit')
            ->with('user', $user)
            ->with('roles', $user_roles);
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
        $user = User::findOrFail($id);

        if (!$user) {
            return redirect()->back()->with('message', "Wrong user ID")->with('message_type', "danger");
        }

        if (isset($request->pass_1) and $request->pass_1 != $request->pass_2) {
            return redirect()->back()->with('message', "Entered passwords are not the same")->with('message_type', "warning");
        }

        $ur1 = array_search(1, array_values($request->roles)) === false ? false : true;
        $ur2 = array_search(2, array_values($request->roles)) === false ? false : true;
        $ur3 = array_search(3, array_values($request->roles)) === false ? false : true;
        $ur4 = array_search(4, array_values($request->roles)) === false ? false : true;

        if ($ur1 != $user->roles()->where('role_id', 1)->first()) {
            $ur1 ? $user->roles()->attach(1) : $user->roles()->detach(1);
        }
        if ($ur2 != $user->roles()->where('role_id', 2)->first()) {
            $ur2 ? $user->roles()->attach(2) : $user->roles()->detach(2);
        }
        if ($ur3 != $user->roles()->where('role_id', 3)->first()) {
            $ur3 ? $user->roles()->attach(3) : $user->roles()->detach(3);
        }
        if ($ur4 != $user->roles()->where('role_id', 4)->first()) {
            $ur4 ? $user->roles()->attach(4) : $user->roles()->detach(4);
        }

        if (isset($request->pass_1)) {
            $user->password = bcrypt($request->pass_1);
            $user->save();
        }

        return redirect()->route('admin.user.index')->with('message', "User updated")->with('message_type', "success");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user_contributions = $user->contributions;

        foreach ($user_contributions as $c){
            $c->user_id = 9999;
            $c->save();
        }

        $user_reviews = $user->reviews;

        foreach ($user_reviews as $r){
            $r->user_id = 9999;
            $r->save();
        }

        $user_comments = $user->comments;

        foreach ($user_comments as $c) {
            $c->user_id = 9999;
            $c->save();
        }

        $user_applications = $user->applications;

        foreach ($user_applications as $a){
            $a->user_id = 9999;
            $a->save();
        }

        User::destroy($id);
        return redirect()->route('admin.user.index')->with('message', "User deleted")->with('message_type', "success");
    }
}
