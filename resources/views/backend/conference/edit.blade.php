@extends('backend.layouts.app')

@section('title', __('titles.conference_edit'))

@section('content')

    <div class="col-sm-12">

        <div class="container">
            <div class="d-flex flex-row-reverse">
                <div class="p-1">
                    <a href="{{ route('admin.conferences.show', $data->id) }}" class="btn btn-primary"><i class="fa fa-chevron-circle-left"></i> {{ __('form.action_back') }}</a>
                </div>
            </div>
        </div>

        <hr>

        <div class="card">
            <div class="card-header">
                <strong class="card-title">{{ __('form.conference_edit') }}</strong>
            </div>

            <div class="card-body">
                <form id="form_conference_edit" method="POST" action="{{route('admin.conferences.update', $data->id)}}">
                    @csrf
                    {{ method_field('PUT') }}

                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="title_sk" class="col-form-label">{{ __('form.conference_title_sk') }}</label>
                        </div>
                        <div class="col-6">
                            <input type="text" id="title_sk" name="title_sk" class="form-control" value="{{ old('title_sk') ? old('title_sk') : $data->title_sk }}" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="title_en" class="col-form-label">{{ __('form.conference_title_en') }}</label>
                        </div>
                        <div class="col-6">
                            <input type="text" id="title_en" name="title_en" class="form-control" value="{{ old('title_en') ? old('title_en') : $data->title_en }}" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="status" class="col-form-label">{{ __('form.conference_status') }}</label>
                        </div>
                        <div class="col-2">
                            <select id="status" class="form-control" name="status" required>
                                <option value="" disabled selected>{{ __('form.conference_choose_status') }}</option>
                                <option value="1" @if(old('status') == 1 or $data->status == 1) selected @endif>{{ __('form.conference_open_opt') }}</option>
                                <option value="2" @if(old('status') == 2 or $data->status == 2) selected @endif>{{ __('form.conference_closed_opt') }}</option>
                                <option value="3" @if(old('status') == 3 or $data->status == 3) selected @endif>{{ __('form.conference_archived_opt') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="year" class="col-form-label">{{ __('form.conference_year') }}</label>
                        </div>
                        <div class="col-2">
                            <input type="number" id="year" name="year" class="form-control" value="{{ old('year') ? old('year') : $data->year }}" required min="1980">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="volume" class="col-form-label">{{ __('form.conference_volume') }}</label>
                        </div>
                        <div class="col-2">
                            <input type="number" id="volume" name="volume" class="form-control" value="{{ old('volume') ? old('volume') : $data->volume }}" required min="1">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="map" class="col-form-label">{{ __('form.conference_map') }}</label>
                        </div>
                        <div class="col-6">
                            <div id="map" style="min-height: 250px;"></div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="lat" class="col-form-label">{{ __('form.conference_lat') }}</label>
                        </div>
                        <div class="col-2">
                            <input type="text" id="lat" name="lat" class="form-control" value="{{ old('lat') ? old('lat') : $data->lat }}" required >
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="lng" class="col-form-label">{{ __('form.conference_lng') }}</label>
                        </div>
                        <div class="col-2">
                            <input type="text" id="lng" name="lng" class="form-control" value="{{ old('lng') ? old('lng') : $data->lng }}" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="addr_country" class="col-form-label">{{ __('form.conference_addr_country') }}</label>
                        </div>
                        <div class="col-3">
                            <select id="addr_country" class="form-control" name="addr_country" required>
                                <option value="" disabled selected>{{ __('form.conference_choose_country') }}</option>
                                @foreach($countries as $c)
                                    <option value="{{ $c->id }}" @if(old('addr_country') == $c->id or $data->address_country == $c->id) selected @endif>{{ $c->name_sk }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="addr_city" class="col-form-label">{{ __('form.conference_addr_city') }}</label>
                        </div>
                        <div class="col-3">
                            <input type="text" id="addr_city" name="addr_city" class="form-control" value="{{ old('addr_city') ? old('addr_city') : $data->address_city }}" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="addr_place" class="col-form-label">{{ __('form.conference_addr_place') }}</label>
                        </div>
                        <div class="col-5">
                            <input type="text" id="addr_place" name="addr_place" class="form-control" value="{{ old('addr_place') ? old('addr_place') : $data->address_place }}" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-sm-4 text-right">
                            <label class="col-form-label" for="reg_start">{{ __('form.conference_registration_dates') }}</label>
                        </div>
                        <div class="col-sm-3">
                            <input type="date" id="reg_start" name="reg_start" class="form-control" value="{{ old('reg_start') ? old('reg_start') : $data->registration_start }}" required>
                        </div>
                        <div class="col-sm-3">
                            <input type="date" id="reg_end" name="reg_end" class="form-control" value="{{ old('reg_end') ? old('reg_end') : $data->registration_end }}" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-sm-4 text-right">
                            <label class="col-form-label" for="conf_start">{{ __('form.conference_conference_dates') }}</label>
                        </div>
                        <div class="col-sm-3">
                            <input type="date" id="conf_start" name="conf_start" class="form-control" value="{{ old('conf_start') ? old('conf_start') : $data->conference_start }}" required>
                        </div>
                        <div class="col-sm-3">
                            <input type="date" id="conf_end" name="conf_end" class="form-control" value="{{ old('conf_end') ? old('conf_end') : $data->conference_end }}" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-sm-4 text-right">
                            <label class="col-form-label" for="file">{{ __('form.conference_proceedings_file') }}</label>
                        </div>
                        <div class="col-sm-3">
                            <input type="file" id="file" name="file">
                        </div>
                    </div>

                    <div class="row form-group" id="content_markdown">
                        <div class="col-4 text-right">
                            <label for="schedule_sk" class="col-form-label">{{ __('form.conference_schedule_sk') }}</label>
                        </div>
                        <div class="col-7">
                            <textarea id="schedule_sk" class="form-control" name="schedule_sk" rows="8" required>{{ old('schedule_sk') ? old('schedule_sk') : $data->schedule_sk }}</textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col col-sm-12 text-center">
                            <button type="button" class="btn btn-primary" id="copy_schedule_button"><i class="fa fa-copy"></i> Copy Slovak schedule</button>
                        </div>
                    </div>

                    <div class="row form-group" id="content_markdown">
                        <div class="col-4 text-right">
                            <label for="schedule_en" class="col-form-label">{{ __('form.conference_schedule_en') }}</label>
                        </div>
                        <div class="col-7">
                            <textarea id="schedule_en" class="form-control" name="schedule_en" rows="8">{{ old('schedule_en') ? old('schedule_en') : $data->schedule_en }}</textarea>
                        </div>
                    </div>

                </form>
            </div>

            <div class="card-footer">
                <button type="submit" form="form_conference_edit" class="btn btn-lg btn-success">{{ __('form.save') }}</button>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script src="https://maps.googleapis.com/maps/api/js?key={{env('GMAPS_API')}}&callback=initMap"
            async defer></script>

    <script src="{!! asset('backend/vendors/bootstrap-markdown/js/bootstrap-markdown.js') !!}"></script>
    <script src="{!! asset('backend/vendors/bootstrap-markdown/js/markdown.js') !!}"></script>

    <script>
        var map;
        var marker;
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: {{$data->lat}}, lng: {{$data->lng}}},
                zoom: 16,
                panControl: false,
                zoomControl: true,
                scaleControl: true,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
            });
            map.addListener('click', function(e) {
                placeMarker(e.latLng);
            });
            marker = new google.maps.Marker({
                position: new google.maps.LatLng({{$data->lat}}, {{$data->lng}}),
                map: map,
                draggable: true,
            });
        }
        function placeMarker(latLng) {
            marker.setPosition(latLng);
            $('#lat').val(marker.position.lat);
            $('#lng').val(marker.position.lng);
        }

        //If input type date is not supported initialize jqueryui datepicker
        var datefield = document.createElement("input");

        datefield.setAttribute("type", "date");

        if (datefield.type != "date"){ //if browser doesn't support input type="date", load files for jQuery UI Date Picker
            document.write('<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />\n')
            document.write('<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"><\/script>\n')
        }
        if (datefield.type != "date"){ //if browser doesn't support input type="date", initialize date picker widget:
            $(document).ready(function() {
                $('#reg_start').datepicker();
                $('#conf_start').datepicker();
                $('#reg_end').datepicker();
                $('#conf_end').datepicker();
            });
        }

        //Initialize Markdown editor
        $("#schedule_sk").markdown({
            autofocus:false,
            fullscreen: true,
            iconlibrary: 'fa',
            savable:false,
            height: 300
        });
        $("#schedule_en").markdown({
            autofocus:false,
            fullscreen: true,
            iconlibrary: 'fa',
            savable:false,
            height: 300
        });
        $copy_btn = $('#copy_schedule_button');
        $copy_btn.click(function () {
            copySkToEn()
        });

        function copySkToEn() {
            $('#schedule_en').val($('#schedule_sk').val());

            $ace_editor2.session.setValue($textbox.value);
            $textbox2.value = $textbox.value;
        }

        $().ready(function () {
            $('#form_conference_edit').validate({
                rules : {
                   'title_sk' : 'required',
                   'title_en' : 'required',
                   'status' : 'required',
                   'year' : 'required',
                   'volume' : 'required',
                   'lat' : 'required',
                   'lng' : 'required',
                   'addr_country' : 'required',
                   'addr_city' : 'required',
                   'addr_place' : 'required',
                   'reg_start' : {
                       required: true,
                       date: true,
                   },
                   'reg_end' : {
                       required: true,
                       date: true,
                   },
                   'conf_start' : {
                       required: true,
                       date: true,
                   },
                   'conf_end' : {
                       required: true,
                       date: true,
                   },
                },
                highlight: function (element, errorClass, validClass) {
                    // Only validation controls
                    if (!$(element).hasClass('novalidation')) {
                        $(element).closest('.form-control').removeClass('is-valid').addClass('is-invalid');
                    }
                },
                unhighlight: function (element, errorClass, validClass) {
                    // Only validation controls
                    if (!$(element).hasClass('novalidation')) {
                        $(element).closest('.form-control').removeClass('is-invalid').addClass('is-valid');
                    }
                }
            });
            
            $('#reg_start').change(function () {
                $('#reg_end').attr({
                    "min" : this.value
                })
            });

            $('#reg_end').change(function () {
                $('#conf_start').attr({
                    "min" : this.value
                })
            });

            $('#conf_start').change(function () {
                $('#conf_end').attr({
                    "min" : this.value
                })
            })
        })

    </script>

@stop
