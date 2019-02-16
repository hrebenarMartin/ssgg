<?php

namespace App\Http\Controllers\Backend\CMS;

use App\Models\FrontMenu;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages_ssgg = Page::where('module', 1)->get();
        $pages_conference = Page::where('module', 2)->get();
        $menu_conf = FrontMenu::where('module', 2)->get();
        $menu_ssgg = FrontMenu::where('module', 1)->get();

        return view("backend.cms.pages_listing")
            ->with("pages_ssgg", $pages_ssgg)
            ->with("pages_conference", $pages_conference)
            ->with("menu_ssgg", $menu_ssgg)
            ->with("menu_conf", $menu_conf);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("backend.cms.pages_add");
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
        $rules = [
            'page_title' => 'required',
            'page_title_second' => 'required',
            'page_alias' => 'required',
            'page_description' => 'required'
        ];

        $this->validate($request, $rules);

        $page = new Page();

        $page->title = $request->page_title;
        $page->title_second = $request->page_title_second;
        $page->alias = $request->page_alias;
        $page->module = $request->page_module;
        $page->description = $request->page_description;

        $page->save();

        return redirect()->route('admin.cms.index')->with('message', "Action successful");

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
        $page = Page::find($id);
        return view("backend.cms.pages_edit")
            ->with('page',$page);
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
            'page_title' => 'required',
            'page_title_second' => 'required',
            'page_alias' => 'required',
            'page_description' => 'required'
        ];

        $this->validate($request, $rules);

        $page = Page::findOrFail($id);

        $page->title = $request->page_title;
        $page->title_second = $request->page_title_second;
        $page->alias = $request->page_alias;
        $page->module = $request->page_module;
        $page->description = $request->page_description;

        $page->save();

        return redirect()->route('admin.cms.index')->with('message', "Action successful");
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
        Page::destroy($id);

        return redirect()->back()->with('message', 'Page successfully deleted.')->with('message_type', 'success');
    }
}
