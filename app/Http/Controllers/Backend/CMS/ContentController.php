<?php

namespace App\Http\Controllers\Backend\CMS;

use App\Models\Block;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.cms.content_listing');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd('Use createForPage()');
    }

    public function createForPage($page_id)
    {
        $pages = Page::all();

        return view('backend.cms.content_add')
            ->with('page_id', $page_id)
            ->with('pages', $pages);
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
            'block_title' => 'required',
            'block_parent' => 'required',
            'block_type' => 'required',
        ];

        $this->validate($request, $rules);

        $block = new Block();

        $block->title = $request->block_title;
        $block->page_id = $request->block_parent;
        $block->type = $request->block_type;

        if ($request->block_type == 1){
            $block->content = $request->block_content_text;
            $block->content_en = $request->block_content_text_en;
        }
        elseif ($request->block_type == 2){
            $block->content = $request->block_content_markdown;
            $block->content_en = $request->block_content_markdown_en;
        }
        elseif ($request->block_type == 3){
            $block->content = $request->block_content_html;
            $block->content_en = $request->block_content_html_en;
        }
        elseif ($request->block_type == 4){
            $block->fixed_id = $request->block_content_fixed;
            $block->content_en = "";
        }
        else{
            $block->content = "";
            $block->content_en = "";
        }

        $blocks_before_count = Block::where('page_id', $request->block_parent)->count();

        $block->rank = $blocks_before_count + 1;

        $block->save();

        return redirect()->route('admin.content.show', $request->block_parent);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($page_id)
    {
        $blocks = Block::where('page_id', $page_id)->orderBy('rank')->get();

        return view('backend.cms.content_listing')
            ->with('blocks', $blocks)
            ->with('page_id', $page_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $block = Block::find($id);
        $pages = Page::all();

        return view('backend.cms.content_edit')
            ->with('block', $block)
            ->with('pages', $pages);
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
            'block_title' => 'required',
            'block_parent' => 'required',
            'block_type' => 'required',
        ];

        $this->validate($request, $rules);

        $block = Block::findOrFail($id);

        $block->title = $request->block_title;
        $block->page_id = $request->block_parent;
        $block->type = $request->block_type;

        if ($request->block_type == 1){
            $block->content = $request->block_content_text;
            $block->content_en = $request->block_content_text_en;
        }
        elseif ($request->block_type == 2){
            $block->content = $request->block_content_markdown;
            $block->content_en = $request->block_content_markdown_en;
        }
        elseif ($request->block_type == 3){
            $block->content = $request->block_content_html;
            $block->content_en = $request->block_content_html_en;
        }
        elseif ($request->block_type == 4){
            $block->fixed_id = $request->block_content_fixed;
            $block->content_en = "";
        }
        else{
            $block->content = "";
            $block->content_en = "";
        }

        $block->save();

        if($request->stay == 1)  return redirect()->route('admin.content.edit', $id);


        return redirect()->route('admin.content.show', $request->block_parent);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd("NYI");
    }
}
