@extends('backend.layouts.app')

@section('title', __('titles.conference_review_form_edit'))

@section('content')

    <div class="col-sm-12">

        <div class="container">
            <div class="d-flex flex-row-reverse">
                <div class="p-1">
                    <div class="dropdown">
                        <a href="{{ route('admin.conferences.show', $conference->id) }}" class="btn btn-primary"><i
                                class="fa fa-fw fa-chevron-circle-left"></i> {{ __('form.action_back') }}</a>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="card">

            <div class="card-header">
                <strong class="card-title">{{ __('titles.conference_review_form_edit') }}</strong>
            </div>

            <div class="card-body">
                <form id="conference_review_form_edit" method="POST" action="{{ route('admin.conferences.review_form.update', $data->conference_id) }}">
                    @csrf
                    {{method_field('PUT')}}

                    <div class="row form-group">
                        <div class="col-sm-4">
                            <label for="opened" class="col-form-label">{{__('form.review_form_opened')}}</label>
                        </div>
                        <div class="col-sm-1">
                            <input name="opened" type="checkbox" id="opened" class="checkbox" value="1" @if($data->opened == 1) checked @endif>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-4">
                            <label for="fill_until" class="col-form-label">{{__('form.review_form_fill_until')}}</label>
                        </div>
                        <div class="col-sm-4">
                            <input name="fill_until" type="date" id="fill_until" class="form-control" value="{{\Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $data->fill_until)->format("Y-m-d")}}" required>
                        </div>
                    </div>

                    @for ($i = 1; $i <= 10; $i++)
                        <div class="row form-group" {{--@if($i>2) style="display: none;" @endif--}}>
                            <div class="col-sm-12">
                                <h3>{{ __('form.review_form_question') }} {{$i}}:</h3>
                            </div>
                            <div class="col-sm-4">
                                <label for="q_{{$i}}_sk" class="col-form-label">{{__('form.review_form_question_sk')}}</label>
                            </div>
                            <div class="col-sm-7">
                                <input name="q_{{$i}}_sk" id="q_{{$i}}_sk" class="form-control" value="{{$data["question_".$i."_sk"]}}" @if($i==1) required @endif>
                            </div>
                           {{-- <div class="col-sm-1">
                                <button class="btn btn-primary"><i class="fa fa-fw fa-copy"></i> > EN</button>
                            </div>--}}
                            <div class="col-sm-4">
                                <label for="q_{{$i}}_en" class="col-form-label">{{__('form.review_form_question_en')}}</label>
                            </div>
                            <div class="col-sm-7">
                                <input name="q_{{$i}}_en" id="q_{{$i}}_en" class="form-control" value="{{$data["question_".$i."_en"]}}" @if($i==1) required @endif>
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
                                    <option value="1" @if($data["question_".$i."_type"] == 1) selected @endif>{{ __('form.review_form_input_type_1') }}</option>
                                    <option value="2" @if($data["question_".$i."_type"] == 2) selected @endif>{{ __('form.review_form_input_type_2') }}</option>
{{--
                                    <option value="3" @if($data["question_".$i."_type"] == 3) selected @endif>{{ __('form.review_form_input_type_3') }}</option>
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
                            <input name="q_conclusion_sk" id="q_conclusion_sk" class="form-control" value="{{ $data->question_conclusion_sk }}" required>
                        </div>
                        <div class="col-sm-4">
                            <label for="q_conclusion_en" class="col-form-label">{{__('form.review_form_conclusion_en')}}</label>
                        </div>
                        <div class="col-sm-7">
                            <input name="q_conclusion_en" id="q_conclusion_en" class="form-control" value="{{ $data->question_conclusion_en }}" required>
                        </div>
                    </div>

                </form>
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <button form="conference_review_form_edit" type="submit" class="btn btn-success pull-right">{{__('form.save')}}</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

@stop
 @section('scripts')

     <script>
         $(document).ready(function () {
             //If input type date is not supported initialize jqueryui datepicker
             var datefield = document.createElement("input");

             datefield.setAttribute("type", "date");

             if (datefield.type != "date") { //if browser doesn't support input type="date", initialize date picker widget:
                 $('#birthday').datepicker({
                     dateFormat: "yy-mm-dd"
                 });
             }
             if (datefield.type != "date") { //if browser doesn't support input type="date", initialize date picker widget:
                 $(document).ready(function () {
                     $('#fill_until').datepicker({
                         dateFormat: "yy-mm-dd"
                     });

                 });
             }
         });

     </script>

 @stop