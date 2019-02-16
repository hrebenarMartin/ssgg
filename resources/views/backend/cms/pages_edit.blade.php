@extends('backend.layouts.app')

@section('title', __('titles.cms_page_edit'))

@section('content')


    <div class="col-md-12">
        <div class="animated fadeIn">
            <div class="container">
                <div class="d-flex flex-row-reverse">
                    <div class="p-1">
                        <a href="{{ route('admin.cms.index') }}" class="btn btn-primary"><i class="fa fa-chevron-circle-left"></i> {{ __('form.action_back') }}</a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="card">
                <div class="card-header">
                    {{ __('form.cms_page_edit_form') }}
                </div>
                <div class="card-body card-block">
                    <form id="cms_ssgg_page_edit_form" method="POST" action="{{ route('admin.cms.update', $page->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="row form-group">
                            <div class="col col-md-2">
                                <label for="page_title" class="col-form-label">{{ __('form.cms_page_title') }}</label>
                            </div>
                            <div class="col col-md-4">
                                <input type="text" class="form-control" id="page_title" name="page_title" value="{{ old('page_title') ? old('page_title') : $page->title }}" required>
                            </div>
                            <div class="col col-md-2">
                                <label for="page_title_second" class="col-form-label">{{ __('form.cms_page_title_second') }}</label>
                            </div>
                            <div class="col col-md-4">
                                <input type="text" class="form-control" id="page_title_second" name="page_title_second" value="{{ old('page_title_second') ?  old('page_title_second') : $page->title_second  }}" required>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-2">
                                <label for="page_alias" class="col-form-label">{{ __('form.cms_page_alias') }}</label>
                            </div>
                            <div class="col col-md-4">
                                <input type="text" class="form-control" id="page_alias" name="page_alias" value="{{ old('page_alias') ?  old('page_alias') : $page->alias }}" required>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-2">
                                <label for="page_module" class="col-form-label">{{ __('form.cms_page_module') }}</label>
                            </div>
                            <div class="col col-md-3">
                                <select class="form-control" id="page_module" name="page_module" required>
                                    <option value="" disabled selected>{{ __('form.cms_page_module_choose') }}</option>
                                    <option value="1" @if(old('page_module') == 1 || $page->module == 1) selected @endif >SSGG</option>
                                    <option value="2" @if(old('page_module') == 2 || $page->module == 2) selected @endif >{{ __('form.cms_page_module_conference') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-2">
                                <label for="page_description" class="form-check-label">{{ __('form.cms_page_description') }}</label>
                            </div>
                            <div class="col col-md-6">
                                <textarea class="form-control" id="page_description" name="page_description" rows="4" required>{{ old('page_description') ? old('page_description') : $page->description }}</textarea>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success" form="cms_ssgg_page_edit_form">{{ __('form.save') }}</button>
                    <button type="reset" class="btn btn-danger" form="cms_ssgg_page_edit_form">{{ __('form.reset') }}</button>
                </div>
            </div>
        </div>
    </div>


@endsection
