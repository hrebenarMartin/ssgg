@extends('backend.layouts.app')

@section('title', __('titles.conference_edit'))

@section('content')

    <div class="col-sm-12">

        <div class="container">
            <div class="d-flex flex-row-reverse">
                <div class="p-1">
                    <a href="{{ route('admin.conferences.index') }}" class="btn btn-primary"><i class="fa fa-chevron-circle-left"></i> {{ __('form.action_back') }}</a>
                </div>
            </div>
        </div>

        <hr>

        <div class="card">
            <div class="card-header">
                <strong class="card-title">{{ __('form.conference_edit') }}</strong>
            </div>

            <div class="card-body">
                <form id="form_conference_add" method="POST" action="{{route('admin.conferences.store')}}">
                    @csrf

                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="title_sk" class="col-form-label">{{ __('form.conference_title_sk') }}</label>
                        </div>
                        <div class="col-6">
                            <input type="text" id="title_sk" name="title_sk" class="form-control" value="{{ old('title_sk')  }}" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="title_en" class="col-form-label">{{ __('form.conference_title_en') }}</label>
                        </div>
                        <div class="col-6">
                            <input type="text" id="title_en" name="title_en" class="form-control" value="{{ old('title_en')  }}" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="status" class="col-form-label">{{ __('form.conference_status') }}</label>
                        </div>
                        <div class="col-2">
                            <select id="status" class="form-control" name="status" required>
                                <option value="" disabled selected>{{ __('form.conference_choose_status') }}</option>
                                <option value="1" @if(old('status') == 1 ) selected @endif>{{ __('form.conference_open_opt') }}</option>
                                <option value="2" @if(old('status') == 2 ) selected @endif>{{ __('form.conference_closed_opt') }}</option>
                                <option value="3" @if(old('status') == 3 ) selected @endif>{{ __('form.conference_archived_opt') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="year" class="col-form-label">{{ __('form.conference_year') }}</label>
                        </div>
                        <div class="col-2">
                            <input type="number" id="year" name="year" class="form-control" value="{{ old('year') }}" required min="1980">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="volume" class="col-form-label">{{ __('form.conference_volume') }}</label>
                        </div>
                        <div class="col-2">
                            <input type="number" id="volume" name="volume" class="form-control" value="{{ old('volume') }}" required min="1">
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
                            <input type="text" id="lat" name="lat" class="form-control" value="{{ old('lat') }}" required >
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="lng" class="col-form-label">{{ __('form.conference_lng') }}</label>
                        </div>
                        <div class="col-2">
                            <input type="text" id="lng" name="lng" class="form-control" value="{{ old('lng') }}" required>
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
                                    <option value="{{ $c->id }}" @if(old('addr_country') == $c->id ) selected @endif>{{ $c->name_sk }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="addr_city" class="col-form-label">{{ __('form.conference_addr_city') }}</label>
                        </div>
                        <div class="col-3">
                            <input type="text" id="addr_city" name="addr_city" class="form-control" value="{{ old('addr_city') }}" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="addr_place" class="col-form-label">{{ __('form.conference_addr_place') }}</label>
                        </div>
                        <div class="col-5">
                            <input type="text" id="addr_place" name="addr_place" class="form-control" value="{{ old('addr_place') }}" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-sm-4 text-right">
                            <label class="col-form-label" for="reg_start">{{ __('form.conference_registration_dates') }}</label>
                        </div>
                        <div class="col-sm-3">
                            <input type="date" id="reg_start" name="reg_start" class="form-control" value="{{ old('reg_start') }}" required>
                        </div>
                        <div class="col-sm-3">
                            <input type="date" id="reg_end" name="reg_end" class="form-control" value="{{ old('reg_end') }}" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-sm-4 text-right">
                            <label class="col-form-label" for="conf_start">{{ __('form.conference_conference_dates') }}</label>
                        </div>
                        <div class="col-sm-3">
                            <input type="date" id="conf_start" name="conf_start" class="form-control" value="{{ old('conf_start') }}" required>
                        </div>
                        <div class="col-sm-3">
                            <input type="date" id="conf_end" name="conf_end" class="form-control" value="{{ old('conf_end') }}" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-sm-4" style="padding-bottom: 1em">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label">{{ __('form.conference_day') }} 1:</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="form-check">
                                            <div class="checkbox">
                                                <label for="day_1_break" class="form-check-label ">
                                                    <input type="checkbox" id="day_1_break" name="day_1_break" value="1" @if(old('day_1_break')) checked @endif class="form-check-input">{{ __('form.conference_breakfast') }}
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label for="day_1_lunch" class="form-check-label ">
                                                    <input type="checkbox" id="day_1_lunch" name="day_1_lunch" value="1" @if(old('day_1_lunch')) checked @endif class="form-check-input"> {{ __('form.conference_lunch') }}
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label for="day_1_dinner" class="form-check-label ">
                                                    <input type="checkbox" id="day_1_dinner" name="day_1_dinner" value="1" @if(old('day_1_dinner')) checked @endif class="form-check-input"> {{ __('form.conference_dinner') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4" style="padding-bottom: 1em" id="day_2">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label">{{ __('form.conference_day') }} 2:</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="form-check">
                                            <div class="checkbox">
                                                <label for="day_2_break" class="form-check-label ">
                                                    <input type="checkbox" id="day_2_break" name="day_2_break" value="1" @if(old('day_2_break')) checked @endif class="form-check-input">{{ __('form.conference_breakfast') }}
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label for="day_2_lunch" class="form-check-label ">
                                                    <input type="checkbox" id="day_2_lunch" name="day_2_lunch" value="1" @if(old('day_2_lunch')) checked @endif class="form-check-input"> {{ __('form.conference_lunch') }}
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label for="day_2_dinner" class="form-check-label ">
                                                    <input type="checkbox" id="day_2_dinner" name="day_2_dinner" value="1" @if(old('day_2_dinner')) checked @endif class="form-check-input"> {{ __('form.conference_dinner') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4" style="padding-bottom: 1em" id="day_3">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label">{{ __('form.conference_day') }} 3:</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="form-check">
                                            <div class="checkbox">
                                                <label for="day_3_break" class="form-check-label ">
                                                    <input type="checkbox" id="day_3_break" name="day_3_break" value="1" @if(old('day_3_break')) checked @endif class="form-check-input">{{ __('form.conference_breakfast') }}
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label for="day_3_lunch" class="form-check-label ">
                                                    <input type="checkbox" id="day_3_lunch" name="day_3_lunch" value="1" @if(old('day_3_lunch')) checked @endif class="form-check-input"> {{ __('form.conference_lunch') }}
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label for="day_3_dinner" class="form-check-label ">
                                                    <input type="checkbox" id="day_3_dinner" name="day_3_dinner" value="1" @if(old('day_3_dinner')) checked @endif class="form-check-input"> {{ __('form.conference_dinner') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4" style="padding-bottom: 1em" id="day_4">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label">{{ __('form.conference_day') }} 4:</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="form-check">
                                            <div class="checkbox">
                                                <label for="day_4_break" class="form-check-label ">
                                                    <input type="checkbox" id="day_4_break" name="day_4_break" value="1" @if(old('day_4_break')) checked @endif class="form-check-input">{{ __('form.conference_breakfast') }}
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label for="day_4_lunch" class="form-check-label ">
                                                    <input type="checkbox" id="day_4_lunch" name="day_4_lunch" value="1" @if(old('day_4_lunch')) checked @endif class="form-check-input"> {{ __('form.conference_lunch') }}
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label for="day_4_dinner" class="form-check-label ">
                                                    <input type="checkbox" id="day_4_dinner" name="day_4_dinner" value="1" @if(old('day_4_dinner')) checked @endif class="form-check-input"> {{ __('form.conference_dinner') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4" style="padding-bottom: 1em" id="day_5">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label">{{ __('form.conference_day') }} 5:</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="form-check">
                                            <div class="checkbox">
                                                <label for="day_5_break" class="form-check-label ">
                                                    <input type="checkbox" id="day_5_break" name="day_5_break" value="1" @if(old('day_5_break')) checked @endif class="form-check-input">{{ __('form.conference_breakfast') }}
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label for="day_5_lunch" class="form-check-label ">
                                                    <input type="checkbox" id="day_5_lunch" name="day_5_lunch" value="1" @if(old('day_5_lunch')) checked @endif class="form-check-input"> {{ __('form.conference_lunch') }}
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label for="day_5_dinner" class="form-check-label ">
                                                    <input type="checkbox" id="day_5_dinner" name="day_5_dinner" value="1" @if(old('day_5_dinner')) checked @endif class="form-check-input"> {{ __('form.conference_dinner') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-sm-4 text-right">
                            <label>{{ __('form.conference_special_event') }} 1:</label>
                        </div>
                        <div class="col-sm-1 text-center">
                            <input type="checkbox" id="special_1" name="special_1" value="1" @if(old('special_1')) checked @endif class="form-check-input">
                        </div>
                        <div class="col-sm-7">
                            <textarea class="form-control" name="special_1_sk" placeholder="Event description(Slovak)" rows="3" style="margin-bottom: 1em">{{old('special_1_sk')}}</textarea>
                            <textarea class="form-control" name="special_1_en" placeholder="Event description(English)" rows="3">{{old('special_1_en')}}</textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-4 text-right">
                            <label>{{ __('form.conference_special_event') }} 2:</label>
                        </div>
                        <div class="col-sm-1 text-center">
                            <input type="checkbox" id="special_2" name="special_2" value="1" @if(old('special_2')) checked @endif class="form-check-input">
                        </div>
                        <div class="col-sm-7">
                            <textarea class="form-control" name="special_2_sk" placeholder="Event description(Slovak)" rows="3" style="margin-bottom: 1em">{{old('special_2_sk')}}</textarea>
                            <textarea class="form-control" name="special_2_en" placeholder="Event description(English)" rows="3">{{old('special_2_en')}}</textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-4 text-right">
                            <label>{{ __('form.conference_special_event') }} 3:</label>
                        </div>
                        <div class="col-sm-1 text-center">
                            <input type="checkbox" id="special_3" name="special_3" value="1" @if(old('special_3')) checked @endif class="form-check-input">
                        </div>
                        <div class="col-sm-7">
                            <textarea class="form-control" name="special_3_sk" placeholder="Event description(Slovak)" rows="3" style="margin-bottom: 1em">{{old('special_3_sk')}}</textarea>
                            <textarea class="form-control" name="special_3_en" placeholder="Event description(English)" rows="3">{{old('special_3_en')}}</textarea>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-sm-4 text-right">
                            <label for="room_1">{{ __('form.conference_room1') }}:</label>
                        </div>
                        <div class="col-sm-1 text-center">
                            <input type="checkbox" id="room_1" name="room_1" value="1" @if(old('room_1')) checked @endif class="form-check-input">
                        </div>
                        <div class="col-sm-3">
                            <input type="number" id="room_1_price" name="room_1_price" value="{{ old('room_1_price') }}" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="room_1_price" class="col-form-label">{{ __('form.conference_room_price') }} €</label>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-4 text-right">
                            <label for="room_2">{{ __('form.conference_room2') }}:</label>
                        </div>
                        <div class="col-sm-1 text-center">
                            <input type="checkbox" id="room_2" name="room_2" value="1" @if(old('room_2')) checked @endif class="form-check-input">
                        </div>
                        <div class="col-sm-3">
                            <input type="number" id="room_2_price" name="room_2_price" value="{{ old('room_2_price') }}" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="room_2_price" class="col-form-label">{{ __('form.conference_room_price') }} €</label>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-4 text-right">
                            <label for="room_3">{{ __('form.conference_room3') }}:</label>
                        </div>
                        <div class="col-sm-1 text-center">
                            <input type="checkbox" id="room_3" name="room_3" value="1" @if(old('room_3')) checked @endif class="form-check-input">
                        </div>
                        <div class="col-sm-3">
                            <input type="number" id="room_3_price" name="room_3_price" value="{{ old('room_3_price') }}" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="room_3_price" class="col-form-label">{{ __('form.conference_room_price') }} €</label>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-4 text-right">
                            <label for="room_4">{{ __('form.conference_room5') }}:</label>
                        </div>
                        <div class="col-sm-1 text-center">
                            <input type="checkbox" id="room_4" name="room_4" value="1" @if(old('room_4')) checked @endif class="form-check-input">
                        </div>
                        <div class="col-sm-3">
                            <input type="number" id="room_4_price" name="room_4_price" value="{{ old('room_4_price') }}" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="room_4_price" class="col-form-label">{{ __('form.conference_room_price') }} €</label>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-4 text-right">
                            <label for="room_5">{{ __('form.conference_room5') }}:</label>
                        </div>
                        <div class="col-sm-1 text-center">
                            <input type="checkbox" id="room_5" name="room_5" value="1" @if(old('room_5')) checked @endif class="form-check-input">
                        </div>
                        <div class="col-sm-3">
                            <input type="number" id="room_5_price" name="room_5_price" value="{{ old('room_5_price') }}" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="room_5_price" class="col-form-label">{{ __('form.conference_room_price') }} €</label>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-sm-4 text-right">
                            <label for="extra_sk" class="col-form-label">{{ __('form.conference_extra_sk') }}</label>
                        </div>
                        <div class="col-sm-8">
                            <textarea id="extra_sk" name="extra_sk" class="form-control">{{ old('extra_sk') }}</textarea>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-sm-4 text-right">
                            <label for="extra_en" class="col-form-label">{{ __('form.conference_extra_en') }}</label>
                        </div>
                        <div class="col-sm-8">
                            <textarea id="extra_en" name="extra_en" class="form-control">{{ old('extra_en') }}</textarea>
                        </div>
                    </div>

                </form>
            </div>

            <div class="card-footer">
                <button type="submit" form="form_conference_edit" class="btn btn-success">{{ __('form.save') }}</button>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script src="https://maps.googleapis.com/maps/api/js?key={{env('GMAPS_API')}}&callback=initMap"
            async defer></script>
    <script>
        var map;
        var marker;
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 49.22742024916337, lng: 17.8408769546038},
                zoom: 6,
                panControl: false,
                zoomControl: true,
                scaleControl: true,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
            });
            map.addListener('click', function(e) {
                placeMarker(e.latLng);
            });
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(49.22742024916337, 17.8408769546038),
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

        $().ready(function () {
            $('#form_conference_add').validate({
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
