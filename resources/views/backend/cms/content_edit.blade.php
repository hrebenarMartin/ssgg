@extends('backend.layouts.app')

@section('title', __('titles.cms_page_content_edit'))

@section('content')

    <div class="col-md-12">
        <div class="container">
            <div class="d-flex flex-row-reverse">
                <div class="p-1">
                    <a href="{{ route('admin.content.show', $block->page_id) }}" class="btn btn-primary"><i class="fa fa-chevron-circle-left"></i> {{ __('form.action_back') }}</a>
                </div>
            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-header">
                <strong class="card-title">{{ __('form.cms_block_edit_form') }}</strong>
            </div>
            <div class="card-body">
                <form id="content_ssgg_edit" method="POST" action="{{ route('admin.content.update', $block->id) }}">
                @csrf
                {{ method_field('PUT') }}

                <!--Basic fields-->
                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="block_title" class="form-control-label">{{ __('form.cms_block_title') }}</label>
                    </div>
                    <div class="col col-md-4">
                        <input type="text" class="form-control" id="block_title" name="block_title" value="{{ old('block_title') ? old('block_title') : $block->title }}" required>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="block_parent" class="form-control-label">{{ __('form.cms_block_parent_page') }}</label>
                    </div>
                    <div class="col col-md-3">
                        <select class="form-control" id="block_parent" name="block_parent" required>
                            @foreach ($pages as $p)
                                <option value="{{ $p->id }}" @if(old('block_parent') == $p->id || $block->page_id == $p->id) selected @endif>{{ $p->title." (".$p->id.")" }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="block_type" class="form-control-label">{{ __('form.cms_block_type') }}</label>
                    </div>
                    <div class="col col-md-3">
                        <select class="form-control" id="block_type" name="block_type" required>
                            <option value="0" selected disabled>{{ __('form.cms_block_choose_type') }}</option>
                            <option value="1" @if(old('block_type') == 1 || $block->type == 1) selected @endif>{{ __('form.cms_block_type_plaintext') }}</option>
                            <option value="2" @if(old('block_type') == 2 || $block->type == 2) selected @endif>{{ __('form.cms_block_type_markdown') }}</option>
                            <option value="3" @if(old('block_type') == 3 || $block->type == 3) selected @endif>{{ __('form.cms_block_type_html') }}</option>
                            <option value="4" @if(old('block_type') == 4 || $block->type == 4) selected @endif>{{ __('form.cms_block_type_fixed') }}</option>
                        </select>
                    </div>
                </div>

                <hr>

                <!-- Slovak content input -->

                <div class="row form-group" id="content_text">
                    <div class="col col-md-2">
                        <label for="block_content_text" class="form-control-label">{{ __('form.cms_block_content') }}</label>
                    </div>
                    <div class="col col-md-8">
                        <textarea id="block_content_text" class="form-control" name="block_content_text" rows="6">{{ old('block_content_text') ? old('block_content_text') : $block->content }}</textarea>
                    </div>
                </div>

                <div class="row form-group" id="content_markdown">
                    <div class="col col-sm-6">
                        <label for="block_content_markdown" class="form-control-label">{{ __('form.cms_block_content') }}</label>
                    </div>
                    <div class="col col-sm-12">
                        <textarea id="block_content_markdown" class="form-control" name="block_content_markdown">{{ old('block_content_markdown') ? old('block_content_markdown') : $block->content }}</textarea>
                    </div>
                </div>

                <div class="row form-group" id="content_html">
                    <div class="col col-sm-6">
                        <label for="block_content_html" class="form-control-label">{{ __('form.cms_block_content') }}</label>
                    </div>
                    <div class="col col-sm-12">
                        <textarea id="block_content_html" class="form-control" name="block_content_html" hidden>{{ old('block_content_html') ? old('block_content_html') : $block->content }}</textarea>
                        <pre id="html_editor"></pre>
                    </div>
                </div>

                <div class="row form-group" id="content_fixed">
                    <div class="col col-md-2">
                        <label for="block_content_fixed" class="form-control-label">{{ __('form.cms_block_type_fixed') }}</label>
                    </div>
                    <div class="col col-md-8">
                        <select id="block_content_fixed" class="form-control" name="block_content_fixed">
                            <option value="0" selected disabled>Vyber blok...</option>
                            <option value="99" @if($block->fixed_id == 99) selected @endif>Úvodný blok konferencie, farebný, animovaný (#99)</option>
                            <option value="98" @if($block->fixed_id == 98) selected @endif>Program konferencie, obyčajný (#98)</option>
                            <option value="97" @if($block->fixed_id == 97) selected @endif>Adresa a mapa miesta konania (#97)</option>
                            <option value="96" @if($block->fixed_id == 96) selected @endif>Možnosti ubytovania a stravy (#96)</option>
                            <option value="95" @if($block->fixed_id == 95) selected @endif>Špeciálne udalosti konferencie (#95)</option>
                            <option value="94" @if($block->fixed_id == 94) selected @endif>Zoznam účastníkov a príspevky (#94)</option>
                            <option value="93" @if($block->fixed_id == 93) selected @endif>Galéria (#93)</option>
                            <option value="59" @if($block->fixed_id == 59) selected @endif>Archív SCG - Zoznam (#59)</option>
                        </select>
                    </div>
                </div>

                <!-- Copy slovak to english button -->

                <div class="row">
                    <div class="col col-sm-12 text-center">
                        <button type="button" class="btn btn-primary" id="copy_content_button"><i class="fa fa-copy"></i> Copy Slovak content</button>
                    </div>
                </div>

                <!-- English content input -->

                <div class="row form-group" id="content_text_en">
                    <div class="col col-md-2">
                        <label for="block_content_text_en" class="form-control-label">{{ __('form.cms_block_content_en') }}</label>
                    </div>
                    <div class="col col-md-8">
                        <textarea id="block_content_text_en" class="form-control" name="block_content_text_en" rows="6">{{ old('block_content_text_en') ? old('block_content_text_en') : $block->content_en }}</textarea>
                    </div>
                </div>

                <div class="row form-group" id="content_markdown_en">
                    <div class="col col-sm-6">
                        <label for="block_content_markdown_en" class="form-control-label">{{ __('form.cms_block_content_en') }}</label>
                    </div>
                    <div class="col col-sm-12">
                        <textarea id="block_content_markdown_en" class="form-control" name="block_content_markdown_en">{{ old('block_content_markdown_en') ? old('block_content_markdown_en') : $block->content_en }}</textarea>
                    </div>
                </div>

                <div class="row form-group" id="content_html_en">
                    <div class="col col-sm-6">
                        <label for="block_content_html_en" class="form-control-label">{{ __('form.cms_block_content_en') }}</label>
                    </div>
                    <div class="col col-sm-12">
                        <textarea id="block_content_html_en" class="form-control" name="block_content_html_en" hidden>{{ old('block_content_html_en') ? old('block_content_html_en') : $block->content_en }}</textarea>
                        <pre id="html_editor_en"></pre>
                    </div>
                </div>

                    <input type="hidden" id="stay" name="stay" value="0">

                </form>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success" form="content_ssgg_edit">{{ __('form.save') }}</button>
                <button type="reset" class="btn btn-danger" form="content_ssgg_edit">{{ __('form.reset') }}</button>
                <button type="button" id="saveAndStay" class="btn btn-primary">{{ __('form.saveAndStay') }}</button>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script src="{!! asset('backend/js/AceEditor/ace.js') !!}"></script>
    <script src="{!! asset('backend/vendors/bootstrap-markdown/js/bootstrap-markdown.js') !!}"></script>
    <script src="{!! asset('backend/vendors/bootstrap-markdown/js/markdown.js') !!}"></script>

    <script>

        $().ready(function () {

            $chosen_type = $('#block_type option:selected').val();

            $div_text = $('#content_text');
            $div_text_en = $('#content_text_en');
            $div_mark = $('#content_markdown');
            $div_mark_en = $('#content_markdown_en');
            $div_html = $('#content_html');
            $div_html_en = $('#content_html_en');
            $div_fixd = $('#content_fixed');

            $copy_btn = $('#copy_content_button');

            //Initialize Ace code editor
            $textbox = document.getElementById('block_content_html');
            $ace_editor = ace.edit("html_editor",{
                theme: "ace/theme/monokai",
                mode: "ace/mode/html",
                autoScrollEditorIntoView: true,
                maxLines: 40,
                minLines: 20
            });
            $ace_editor.session.setValue($textbox.value);
            $ace_editor.session.on('change', function () {
                $textbox.value = $ace_editor.session.getValue();
            });

            $textbox2 = document.getElementById('block_content_html_en');
            $ace_editor2 = ace.edit("html_editor_en",{
                theme: "ace/theme/monokai",
                mode: "ace/mode/html",
                autoScrollEditorIntoView: true,
                maxLines: 40,
                minLines: 20
            });
            $ace_editor2.session.setValue($textbox2.value);
            $ace_editor2.session.on('change', function () {
                $textbox2.value = $ace_editor2.session.getValue();
            });

            //Initialize Markdown editor
            $("#block_content_markdown").markdown({
                autofocus:false,
                fullscreen: true,
                iconlibrary: 'fa',
                savable:false,
                height: 300
            });
            $("#block_content_markdown_en").markdown({
                autofocus:false,
                fullscreen: true,
                iconlibrary: 'fa',
                savable:false,
                height: 300
            });

            typeChange($chosen_type);

            $('#block_type').change(function () {
                $new_type = $('#block_type option:selected').val();
                typeChange($new_type);
            });

            $copy_btn.click(function () {
                copySkToEn()
            });

            $('#saveAndStay').click(function () {
                $('#stay').val('1');
                $('#content_ssgg_edit').submit();
            })

        });

        function typeChange(type) {
            switch (type) {
                case '0':
                    $div_text.hide();
                    $div_text_en.hide();
                    $div_mark.hide();
                    $div_mark_en.hide();
                    $div_html.hide();
                    $div_html_en.hide();
                    $div_fixd.hide();
                    $copy_btn.hide();
                    break;
                case '1':
                    $div_text.show();
                    $div_text_en.show();
                    $div_mark.hide();
                    $div_mark_en.hide();
                    $div_html.hide();
                    $div_html_en.hide();
                    $div_fixd.hide();
                    $copy_btn.show();
                    break;
                case '2':
                    $div_text.hide();
                    $div_text_en.hide();
                    $div_mark.show();
                    $div_mark_en.show();
                    $div_html.hide();
                    $div_html_en.hide();
                    $div_fixd.hide();
                    $copy_btn.show();
                    break;
                case '3':
                    $div_text.hide();
                    $div_text_en.hide();
                    $div_mark.hide();
                    $div_mark_en.hide();
                    $div_html.show();
                    $div_html_en.show();
                    $div_fixd.hide();
                    $copy_btn.show();
                    break;
                case '4':
                    $div_text.hide();
                    $div_text_en.hide();
                    $div_mark.hide();
                    $div_mark_en.hide();
                    $div_html.hide();
                    $div_html_en.hide();
                    $div_fixd.show();
                    $copy_btn.hide();
                    break;
            }
        }

        function copySkToEn() {
            $('#block_content_text_en').text($('#block_content_text').text());
            $('#block_content_markdown_en').val($('#block_content_markdown').val());

            $ace_editor2.session.setValue($textbox.value);
            $textbox2.value = $textbox.value;
        }

    </script>
@stop
