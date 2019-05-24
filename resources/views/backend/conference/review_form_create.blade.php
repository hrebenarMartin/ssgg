@extends('backend.layouts.app')

@section('title', __('titles.conference_review_form_create'))

@section('content')

    <div class="col-sm-12">

        <div class="container">
            <div class="d-flex flex-row-reverse">
                <div class="p-1">
                    <div class="dropdown">
                        <a href="{{ route('admin.conferences.index') }}" class="btn btn-primary"><i
                                class="fa fa-fw fa-chevron-circle-left"></i> {{ __('form.action_back') }}</a>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="card">

            <div class="card-header">
                <strong class="card-title">{{ __('titles.conference_review_form_create') }}</strong>
            </div>

            <div class="card-body">
                <form id="conference_review_form_create" method="POST" action="{{ route('admin.conferences.review_form.store', $conference->id) }}">
                    @csrf

                    <div class="row form-group">
                        <div class="col-sm-4">
                            <label for="opened" class="col-form-label">{{__('form.review_form_opened')}}</label>
                        </div>
                        <div class="col-sm-1">
                            <input name="opened" type="checkbox" id="opened" class="checkbox" value="1">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-4">
                            <label for="fill_until" class="col-form-label">{{__('form.review_form_fill_until')}}</label>
                        </div>
                        <div class="col-sm-4">
                            <input name="fill_until" type="date" id="fill_until" class="form-control" value="" required>
                        </div>
                    </div>

                    @for ($i = 1; $i <= 10; $i++)
                        <div class="row form-group">
                            <div class="col-sm-12">
                                <h3>{{ __('form.review_form_question') }} {{$i}}:</h3>
                            </div>
                            <div class="col-sm-4">
                                <label for="q_{{$i}}_sk" class="col-form-label">{{__('form.review_form_question_sk')}}</label>
                            </div>
                            <div class="col-sm-7">
                                <input name="q_{{$i}}_sk" id="q_{{$i}}_sk" class="form-control" value="" @if($i==1) required @endif>
                            </div>
                            {{--<div class="col-sm-1">
                                <button class="btn btn-primary"><i class="fa fa-fw fa-copy"></i> > EN</button>
                            </div>--}}
                            <div class="col-sm-4">
                                <label for="q_{{$i}}_en" class="col-form-label">{{__('form.review_form_question_en')}}</label>
                            </div>
                            <div class="col-sm-7">
                                <input name="q_{{$i}}_en" id="q_{{$i}}_en" class="form-control" value="" @if($i==1) required @endif>
                            </div>
                            {{--<div class="col-sm-1">
                                <button class="btn btn-primary"><i class="fa fa-fw fa-copy"></i> > SK</button>
                            </div>--}}
                            <div class="col-sm-4">
                                <label for="q_{{$i}}_t" class="col-form-label">{{__('form.review_form_question_type')}}</label>
                            </div>
                            <div class="col-sm-3">
                                <select id="q_{{$i}}_t" name="q_{{$i}}_t" class="form-control" @if($i==1) required @endif>
                                    <option value="" selected disabled>...</option>
                                    <option value="1">{{ __('form.review_form_input_type_1') }}</option>
                                    <option value="2">{{ __('form.review_form_input_type_2') }}</option>
{{--
                                    <option value="3">{{ __('form.review_form_input_type_3') }}</option>
--}}
                                </select>
                            </div>
                        </div>
                    @endfor

                    <div class="row form-group">
                        <div class="col-sm-4">
                            <label for="q_conclusion_sk" class="col-form-label">{{__('form.review_form_conclusion_sk')}}</label>
                        </div>
                        <div class="col-sm-7">
                            <input name="q_conclusion_sk" id="q_conclusion_sk" class="form-control" value="" required>
                        </div>
                        <div class="col-sm-4">
                            <label for="q_conclusion_en" class="col-form-label">{{__('form.review_form_conclusion_en')}}</label>
                        </div>
                        <div class="col-sm-7">
                            <input name="q_conclusion_en" id="q_conclusion_en" class="form-control" value="" required>
                        </div>
                    </div>

                </form>

                <div class="card-footer">
                    <div class="row">
                        <button form="conference_review_form_create" type="submit" class="btn btn-success">{{__('form.save')}}</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

@stop
