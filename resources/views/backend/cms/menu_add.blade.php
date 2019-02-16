@extends('backend.layouts.app')

@section('title', __('titles.cms_menu_add'))

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
                    {{ __('form.cms_menu_add_form') }}
                </div>
                <div class="card-body card-block">
                    <form id="cms_ssgg_page_add_form" method="POST" action="{{ route('admin.front_menu.store') }}">
                        {{ csrf_field() }}

                        <div class="row form-group">
                            <div class="col col-md-2">
                                <label for="menu_title_sk" class="col-form-label">{{ __('form.cms_menu_title_sk') }}</label>
                            </div>
                            <div class="col col-md-4">
                                <input type="text" class="form-control" id="menu_title_sk" name="menu_title_sk" value="{{ old('menu_title_sk') }}" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-2">
                                <label for="menu_title_en" class="col-form-label">{{ __('form.cms_menu_title_en') }}</label>
                            </div>
                            <div class="col col-md-4">
                                <input type="text" class="form-control" id="menu_title_en" name="menu_title_en" value="{{ old('menu_title_en') }}" required>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-2">
                                <label for="menu_route" class="col-form-label">{{ __('form.cms_menu_route') }}</label>
                            </div>
                            <div class="col col-md-4">
                                <input type="text" class="form-control" id="menu_route" name="menu_route" value="{{ old('menu_route') }}" placeholder="Example: /route or /#anchor" required>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-2">
                                <label for="menu_module" class="col-form-label">{{ __('form.cms_menu_module') }}</label>
                            </div>
                            <div class="col col-md-3">
                                <select class="form-control" id="menu_module" name="menu_module" required>
                                    <option value="" disabled selected>Choose module...</option>
                                    <option value="1" @if(old('page_module') == 1) selected @endif >SSGG</option>
                                    <option value="2" @if(old('page_module') == 2) selected @endif >Conference</option>
                                </select>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-2">
                                <label for="menu_rank" class="col-form-label">{{ __('form.cms_menu_rank') }}</label>
                            </div>
                            <div class="col col-md-2">
                                <input type="number" class="form-control" id="menu_rank" name="menu_rank" min="1" max="99" value="{{ old('menu_rank') }}" required>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success" form="cms_ssgg_page_add_form">{{ __('form.save') }}</button>
                    <button type="reset" class="btn btn-danger" form="cms_ssgg_page_add_form">{{ __('form.reset') }}</button>
                </div>
            </div>
        </div>
    </div>


@endsection
