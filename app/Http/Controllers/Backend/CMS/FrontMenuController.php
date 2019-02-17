<?php

namespace App\Http\Controllers\Backend\CMS;

use App\Models\Conference;
use App\Models\FrontMenu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $conference = Conference::where('status', '!=', 3)->first();
        if(!$conference){
            session(['message'=>__('messages.no_active_conference'), 'message_type' => 'warning']);
            return view("backend.cms.menu_add");
        }
        return view("backend.cms.menu_add")->with('conference_id', $conference->id);
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
            'menu_title_sk' => 'required',
            'menu_title_en' => 'required',
            'menu_route' => 'required',
            'menu_module' => 'required',
            'menu_rank' => 'required',
        ];

        $this->validate($request, $rules);

        $item = new FrontMenu();

        $item->name_sk = $request->menu_title_sk;
        $item->name_en = $request->menu_title_en;
        $item->route = $request->menu_route;
        $item->module = $request->menu_module;
        if($request->menu_module == 2) $item->conference_id = $request->conference_id;
        $item->rank = $request->menu_rank;

        $item->save();

        return redirect()->route('admin.cms.index')
            ->with('message', 'Creation successful')
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
        $item = FrontMenu::find($id);

        return view('backend.cms.menu_edit')
            ->with('data', $item);
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
            'menu_title_sk' => 'required',
            'menu_title_en' => 'required',
            'menu_route' => 'required',
            'menu_module' => 'required',
            'menu_rank' => 'required',
        ];

        $this->validate($request, $rules);

        $item = FrontMenu::find($id);

        $item->name_sk = $request->menu_title_sk;
        $item->name_en = $request->menu_title_en;
        $item->route = $request->menu_route;
        $item->module = $request->menu_module;
        $item->rank = $request->menu_rank;

        $item->save();

        return redirect()->route('admin.cms.index')
            ->with('message', 'Update successful')
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
        FrontMenu::destroy($id);

        return redirect()->back()->with('message', 'Item successfully deleted.')->with('message_type', 'success');
    }
}
