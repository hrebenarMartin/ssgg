@extends('backend.layouts.app')

@section('title', __('titles.conference_edit'))

@section('content')

    <div class="col-sm-12">

        <div class="container">
            <div class="d-flex flex-row-reverse">
                <div class="p-1">
                    <a href="{{ route('admin.conferences.show', $data->id) }}" class="btn btn-primary"><i
                                class="fa fa-fw fa-chevron-circle-left"></i> {{ __('form.action_back') }}</a>
                </div>
            </div>
        </div>

        <hr>

        <div class="card">
            <div class="card-header">
                <strong class="card-title">{{ __('form.conference_edit') }}</strong>
            </div>

            <div class="card-body">
                <form id="form_conference_edit" method="POST" enctype="multipart/form-data"
                      action="{{route('admin.conferences.update', $data->id)}}">
                    @csrf
                    {{ method_field('PUT') }}

                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="title_sk" class="col-form-label">{{ __('form.conference_title_sk') }}</label>
                        </div>
                        <div class="col-6">
                            <input type="text" id="title_sk" name="title_sk" class="form-control"
                                   value="{{ old('title_sk') ? old('title_sk') : $data->title_sk }}" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="title_en" class="col-form-label">{{ __('form.conference_title_en') }}</label>
                        </div>
                        <div class="col-6">
                            <input type="text" id="title_en" name="title_en" class="form-control"
                                   value="{{ old('title_en') ? old('title_en') : $data->title_en }}" required>
                        </div>
                    </div>

                    @if(!Auth::user()->roles()->where('role_id', 1)->first())
                        <input type="hidden" value="{{ $data->status }}" name="status">
                    @else
                        <div class="row form-group">
                            <div class="col-4 text-right">
                                <label for="status" class="col-form-label">{{ __('form.conference_status') }}</label>
                            </div>
                            <div class="col-2">
                                <select id="status" class="form-control" name="status" required>
                                    <option value="" disabled
                                            selected>{{ __('form.conference_choose_status') }}</option>
                                    <option value="1"
                                            @if(old('status') == 1 or $data->status == 1) selected @endif>{{ __('form.conference_open_opt') }}</option>
                                    <option value="2"
                                            @if(old('status') == 2 or $data->status == 2) selected @endif>{{ __('form.conference_closed_opt') }}</option>
                                    <option value="3"
                                            @if(old('status') == 3 or $data->status == 3) selected @endif>{{ __('form.conference_archived_opt') }}</option>
                                </select>
                            </div>
                        </div>
                    @endif

                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="year" class="col-form-label">{{ __('form.conference_year') }}</label>
                        </div>
                        <div class="col-2">
                            <input type="number" id="year" name="year" class="form-control"
                                   value="{{ old('year') ? old('year') : $data->year }}" required min="1980">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="volume" class="col-form-label">{{ __('form.conference_volume') }}</label>
                        </div>
                        <div class="col-2">
                            <input type="number" id="volume" name="volume" class="form-control"
                                   value="{{ old('volume') ? old('volume') : $data->volume }}" required min="1">
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
                            <input type="text" id="lat" name="lat" class="form-control"
                                   value="{{ old('lat') ? old('lat') : $data->lat }}" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="lng" class="col-form-label">{{ __('form.conference_lng') }}</label>
                        </div>
                        <div class="col-2">
                            <input type="text" id="lng" name="lng" class="form-control"
                                   value="{{ old('lng') ? old('lng') : $data->lng }}" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="addr_country"
                                   class="col-form-label">{{ __('form.conference_addr_country') }}</label>
                        </div>
                        <div class="col-3">
                            <select id="addr_country" class="form-control" name="addr_country" required>
                                <option value="" disabled selected>{{ __('form.conference_choose_country') }}</option>
                                @foreach($countries as $c)
                                    <option value="{{ $c->id }}"
                                            @if(old('addr_country') == $c->id or $data->address_country == $c->id) selected @endif>{{ $c->name_sk }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="addr_city" class="col-form-label">{{ __('form.conference_addr_city') }}</label>
                        </div>
                        <div class="col-3">
                            <input type="text" id="addr_city" name="addr_city" class="form-control"
                                   value="{{ old('addr_city') ? old('addr_city') : $data->address_city }}" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="addr_place"
                                   class="col-form-label">{{ __('form.conference_addr_place') }}</label>
                        </div>
                        <div class="col-5">
                            <input type="text" id="addr_place" name="addr_place" class="form-control"
                                   value="{{ old('addr_place') ? old('addr_place') : $data->address_place }}" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-sm-4 text-right">
                            <label class="col-form-label"
                                   for="reg_start">{{ __('form.conference_registration_dates') }}</label>
                        </div>
                        <div class="col-sm-3">
                            <input type="date" id="reg_start" name="reg_start" class="form-control"
                                   value="{{ old('reg_start') ? old('reg_start') : $data->registration_start }}"
                                   required>
                        </div>
                        <div class="col-sm-3">
                            <input type="date" id="reg_end" name="reg_end" class="form-control"
                                   value="{{ old('reg_end') ? old('reg_end') : $data->registration_end }}" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-sm-4 text-right">
                            <label class="col-form-label"
                                   for="conf_start">{{ __('form.conference_conference_dates') }}</label>
                        </div>
                        <div class="col-sm-3">
                            <input type="date" id="conf_start" name="conf_start" class="form-control"
                                   value="{{ old('conf_start') ? old('conf_start') : $data->conference_start }}"
                                   required>
                        </div>
                        <div class="col-sm-3">
                            <input type="date" id="conf_end" name="conf_end" class="form-control"
                                   value="{{ old('conf_end') ? old('conf_end') : $data->conference_end }}" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-sm-4 text-right">
                            <label class="col-form-label"
                                   for="file">{{ __('form.conference_proceedings_file') }}</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="file" class="form-control" id="file" name="pro_file" accept="application/pdf">
                        </div>
                    </div>

                    <div class="row form-group" id="content_markdown">
                        <div class="col-4 text-right">
                            <label for="schedule_sk"
                                   class="col-form-label">{{ __('form.conference_schedule_sk') }}</label>
                        </div>
                        <div class="col-7">
                            <textarea id="schedule_sk" class="form-control" name="schedule_sk" rows="8"
                                      required>{{ old('schedule_sk') ? old('schedule_sk') : $data->schedule_sk }}</textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col col-sm-12 text-center">
                            <button type="button" class="btn btn-primary" id="copy_schedule_button"><i
                                        class="fa fa-fw fa-copy"></i> Copy Slovak schedule
                            </button>
                        </div>
                    </div>

                    <div class="row form-group" id="content_markdown">
                        <div class="col-4 text-right">
                            <label for="schedule_en"
                                   class="col-form-label">{{ __('form.conference_schedule_en') }}</label>
                        </div>
                        <div class="col-7">
                            <textarea id="schedule_en" class="form-control" name="schedule_en"
                                      rows="8">{{ old('schedule_en') ? old('schedule_en') : $data->schedule_en }}</textarea>
                        </div>
                    </div>

                    <div class="row" style="padding-top: 1em">
                        <div class="col-sm-12">
                            <h2>{{ __('form.conference_config') }}</h2>
                            <hr>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <h2>{{ __('form.conference_food') }}</h2>
                            <hr>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-sm-4 text-right">
                            <label class="col-form-label">{{ __('form.conference_food_choose') }}</label>
                        </div>
                        <div class="col-sm-8">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6" style="padding-bottom: 1em" id="day_1">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label">{{ __('form.conference_day') }}
                                                        1:</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="form-check">
                                                        <div class="checkbox">
                                                            <label for="day_1_break" class="form-check-label ">
                                                                <input type="checkbox" id="day_1_break"
                                                                       name="day_1_break" value="1"
                                                                       @if(old('day_1_break') or $config->day1_breakfast == 1) checked
                                                                       @endif class="form-check-input">{{ __('form.conference_breakfast') }}
                                                            </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <label for="day_1_lunch" class="form-check-label ">
                                                                <input type="checkbox" id="day_1_lunch"
                                                                       name="day_1_lunch" value="1"
                                                                       @if(old('day_1_lunch') or $config->day1_lunch == 1) checked
                                                                       @endif class="form-check-input"> {{ __('form.conference_lunch') }}
                                                            </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <label for="day_1_dinner" class="form-check-label ">
                                                                <input type="checkbox" id="day_1_dinner"
                                                                       name="day_1_dinner" value="1"
                                                                       @if(old('day_1_dinner') or $config->day1_dinner == 1) checked
                                                                       @endif class="form-check-input"> {{ __('form.conference_dinner') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6" style="padding-bottom: 1em" id="day_2">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label">{{ __('form.conference_day') }}
                                                        2:</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="form-check">
                                                        <div class="checkbox">
                                                            <label for="day_2_break" class="form-check-label ">
                                                                <input type="checkbox" id="day_2_break"
                                                                       name="day_2_break" value="1"
                                                                       @if(old('day_2_break') or $config->day2_breakfast == 1) )
                                                                       checked
                                                                       @endif class="form-check-input">{{ __('form.conference_breakfast') }}
                                                            </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <label for="day_2_lunch" class="form-check-label ">
                                                                <input type="checkbox" id="day_2_lunch"
                                                                       name="day_2_lunch" value="1"
                                                                       @if(old('day_2_lunch') or $config->day2_lunch == 1) checked
                                                                       @endif class="form-check-input"> {{ __('form.conference_lunch') }}
                                                            </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <label for="day_2_dinner" class="form-check-label ">
                                                                <input type="checkbox" id="day_2_dinner"
                                                                       name="day_2_dinner" value="1"
                                                                       @if(old('day_2_dinner') or $config->day2_dinner == 1) checked
                                                                       @endif class="form-check-input"> {{ __('form.conference_dinner') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6" style="padding-bottom: 1em" id="day_3">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label">{{ __('form.conference_day') }}
                                                        3:</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="form-check">
                                                        <div class="checkbox">
                                                            <label for="day_3_break" class="form-check-label ">
                                                                <input type="checkbox" id="day_3_break"
                                                                       name="day_3_break" value="1"
                                                                       @if(old('day_3_break') or $config->day3_breakfast == 1) )
                                                                       checked
                                                                       @endif class="form-check-input">{{ __('form.conference_breakfast') }}
                                                            </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <label for="day_3_lunch" class="form-check-label ">
                                                                <input type="checkbox" id="day_3_lunch"
                                                                       name="day_3_lunch" value="1"
                                                                       @if(old('day_3_lunch') or $config->day3_lunch == 1) checked
                                                                       @endif class="form-check-input"> {{ __('form.conference_lunch') }}
                                                            </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <label for="day_3_dinner" class="form-check-label ">
                                                                <input type="checkbox" id="day_3_dinner"
                                                                       name="day_3_dinner" value="1"
                                                                       @if(old('day_3_dinner') or $config->day3_dinner == 1) checked
                                                                       @endif class="form-check-input"> {{ __('form.conference_dinner') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6" style="padding-bottom: 1em" id="day_4">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label">{{ __('form.conference_day') }}
                                                        4:</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="form-check">
                                                        <div class="checkbox">
                                                            <label for="day_4_break" class="form-check-label ">
                                                                <input type="checkbox" id="day_4_break"
                                                                       name="day_4_break" value="1"
                                                                       @if(old('day_4_break') or $config->day4_breakfast == 1) )
                                                                       checked
                                                                       @endif class="form-check-input">{{ __('form.conference_breakfast') }}
                                                            </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <label for="day_4_lunch" class="form-check-label ">
                                                                <input type="checkbox" id="day_4_lunch"
                                                                       name="day_4_lunch" value="1"
                                                                       @if(old('day_4_lunch') or $config->day4_lunch == 1) checked
                                                                       @endif class="form-check-input"> {{ __('form.conference_lunch') }}
                                                            </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <label for="day_4_dinner" class="form-check-label ">
                                                                <input type="checkbox" id="day_4_dinner"
                                                                       name="day_4_dinner" value="1"
                                                                       @if(old('day_4_dinner') or $config->day4_dinner == 1) checked
                                                                       @endif class="form-check-input"> {{ __('form.conference_dinner') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6" style="padding-bottom: 1em" id="day_5">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label">{{ __('form.conference_day') }}
                                                        5:</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="form-check">
                                                        <div class="checkbox">
                                                            <label for="day_5_break" class="form-check-label ">
                                                                <input type="checkbox" id="day_5_break"
                                                                       name="day_5_break" value="1"
                                                                       @if(old('day_5_break') or $config->day5_breakfast == 1) )
                                                                       checked
                                                                       @endif class="form-check-input">{{ __('form.conference_breakfast') }}
                                                            </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <label for="day_5_lunch" class="form-check-label ">
                                                                <input type="checkbox" id="day_5_lunch"
                                                                       name="day_5_lunch" value="1"
                                                                       @if(old('day_5_lunch') or $config->day5_lunch == 1) checked
                                                                       @endif class="form-check-input"> {{ __('form.conference_lunch') }}
                                                            </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <label for="day_5_dinner" class="form-check-label ">
                                                                <input type="checkbox" id="day_5_dinner"
                                                                       name="day_5_dinner" value="1"
                                                                       @if(old('day_5_dinner') or $config->day5_dinner == 1) checked
                                                                       @endif class="form-check-input"> {{ __('form.conference_dinner') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-8">
                            <h2>{{ __('form.conference_special') }}</h2>
                            <hr>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-sm-4 text-right">
                            <label>{{ __('form.conference_special_event') }} 1:</label>
                        </div>
                        <div class="col-sm-1 text-center">
                            <input type="checkbox" id="special_1" name="special_1" value="1"
                                   @if(old('special_1') or $config->special_1 == 1) checked
                                   @endif class="form-check-input event_check" data-id="1">
                        </div>
                        <div class="col-sm-7">
                            <textarea class="form-control" id="special_1_sk" name="special_1_sk"
                                      placeholder="{{ __('form.conference_special_event_desc_sk') }}" rows="3"
                                      style="margin-bottom: 1em"
                                      @if(old('special_1') or $config->special_1 == 1) required
                                      @else disabled @endif>{{old('special_1_sk') ? old('special_1_sk') : $config->special_1_sk}}</textarea>
                            <textarea class="form-control" id="special_1_en" name="special_1_en"
                                      placeholder="{{ __('form.conference_special_event_desc_en') }}" rows="3"
                                      @if(old('special_1') or $config->special_1 == 1) required
                                      @else disabled @endif>{{old('special_1_en') ? old('special_1_en') : $config->special_1_en}}</textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-4 text-right">
                            <label>{{ __('form.conference_special_event') }} 2:</label>
                        </div>
                        <div class="col-sm-1 text-center">
                            <input type="checkbox" id="special_2" name="special_2" value="1"
                                   @if(old('special_2') or $config->special_2 == 1) checked
                                   @endif class="form-check-input event_check" data-id="2">
                        </div>
                        <div class="col-sm-7">
                            <textarea class="form-control" id="special_2_sk" name="special_2_sk"
                                      placeholder="{{ __('form.conference_special_event_desc_sk') }}" rows="3"
                                      style="margin-bottom: 1em"
                                      @if(old('special_2') or $config->special_2 == 1) required
                                      @else disabled @endif>{{old('special_2_sk') ? old('special_2_sk') : $config->special_2_sk}}</textarea>
                            <textarea class="form-control" id="special_2_en" name="special_2_en"
                                      placeholder="{{ __('form.conference_special_event_desc_en') }}" rows="3"
                                      @if(old('special_2') or $config->special_2 == 1) required
                                      @else disabled @endif>{{old('special_2_en') ? old('special_2_en') : $config->special_2_en}}</textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-4 text-right">
                            <label>{{ __('form.conference_special_event') }} 3:</label>
                        </div>
                        <div class="col-sm-1 text-center">
                            <input type="checkbox" id="special_3" name="special_3" value="1"
                                   @if(old('special_3') or $config->special_3 == 1) checked
                                   @endif class="form-check-input event_check" data-id="3">
                        </div>
                        <div class="col-sm-7">
                            <textarea class="form-control" id="special_3_sk" name="special_3_sk"
                                      placeholder="{{ __('form.conference_special_event_desc_sk') }}" rows="3"
                                      style="margin-bottom: 1em"
                                      @if(old('special_3') or $config->special_3 == 1) required
                                      @else disabled @endif>{{old('special_3_sk') ? old('special_3_sk') : $config->special_3_sk}}</textarea>
                            <textarea class="form-control" id="special_3_en" name="special_3_en"
                                      placeholder="{{ __('form.conference_special_event_desc_en') }}" rows="3"
                                      @if(old('special_3') or $config->special_3 == 1) required
                                      @else disabled @endif>{{old('special_3_en') ? old('special_3_en') : $config->special_3_en}}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <h2>{{ __('form.conference_rooms') }}</h2>
                            <hr>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-sm-4 text-right">
                            <label for="room_1">{{ __('form.conference_room1') }}:</label>
                        </div>
                        <div class="col-sm-1 text-center">
                            <input type="checkbox" id="room_1" name="room_1" value="1"
                                   @if(old('room_1') or $config->accom_1 == 1) checked
                                   @endif class="form-check-input room_check" data-id="1">
                        </div>
                        <div class="col-sm-3">
                            <input type="number" id="room_1_price" name="room_1_price"
                                   value="{{ old('room_1_price') ? old('room_1_price') : $config->accom_1_price }}"
                                   class="form-control" @if(old('room_1') or $config->accom_1 == 1) required
                                   @else disabled @endif>
                        </div>
                        <div class="col-sm-4">
                            <label for="room_1_price" class="col-form-label">{{ __('form.conference_room_price') }}
                                €</label>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-4 text-right">
                            <label for="room_2">{{ __('form.conference_room2') }}:</label>
                        </div>
                        <div class="col-sm-1 text-center">
                            <input type="checkbox" id="room_2" name="room_2" value="1"
                                   @if(old('room_2') or $config->accom_2 == 1) checked
                                   @endif class="form-check-input room_check" data-id="2">
                        </div>
                        <div class="col-sm-3">
                            <input type="number" id="room_2_price" name="room_2_price"
                                   value="{{ old('room_2_price') ? old('room_2_price') : $config->accom_2_price }}"
                                   class="form-control" @if(old('room_2') or $config->accom_2 == 1) required
                                   @else disabled @endif>
                        </div>
                        <div class="col-sm-4">
                            <label for="room_2_price" class="col-form-label">{{ __('form.conference_room_price') }}
                                €</label>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-4 text-right">
                            <label for="room_3">{{ __('form.conference_room3') }}:</label>
                        </div>
                        <div class="col-sm-1 text-center">
                            <input type="checkbox" id="room_3" name="room_3" value="1"
                                   @if(old('room_3') or $config->accom_3 == 1) checked
                                   @endif class="form-check-input room_check" data-id="3">
                        </div>
                        <div class="col-sm-3">
                            <input type="number" id="room_3_price" name="room_3_price"
                                   value="{{ old('room_3_price') ? old('room_3_price') : $config->accom_3_price }}"
                                   class="form-control" @if(old('room_3') or $config->accom_3 == 1) required
                                   @else disabled @endif>
                        </div>
                        <div class="col-sm-4">
                            <label for="room_3_price" class="col-form-label">{{ __('form.conference_room_price') }}
                                €</label>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-4 text-right">
                            <label for="room_4">{{ __('form.conference_room4') }}:</label>
                        </div>
                        <div class="col-sm-1 text-center">
                            <input type="checkbox" id="room_4" name="room_4" value="1"
                                   @if(old('room_4') or $config->accom_4 == 1) checked
                                   @endif class="form-check-input room_check" data-id="4">
                        </div>
                        <div class="col-sm-3">
                            <input type="number" id="room_4_price" name="room_4_price"
                                   value="{{ old('room_4_price') ? old('room_4_price') : $config->accom_4_price }}"
                                   class="form-control" @if(old('room_4') or $config->accom_4 == 1) required
                                   @else disabled @endif>
                        </div>
                        <div class="col-sm-4">
                            <label for="room_4_price" class="col-form-label">{{ __('form.conference_room_price') }}
                                €</label>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-4 text-right">
                            <label for="room_5">{{ __('form.conference_room5') }}:</label>
                        </div>
                        <div class="col-sm-1 text-center">
                            <input type="checkbox" id="room_5" name="room_5" value="1"
                                   @if(old('room_5') or $config->accom_5 == 1) checked
                                   @endif class="form-check-input room_check" data-id="5">
                        </div>
                        <div class="col-sm-3">
                            <input type="number" id="room_5_price" name="room_5_price"
                                   value="{{ old('room_5_price') ? old('room_5_price') : $config->accom_5_price }}"
                                   class="form-control" @if(old('room_5') or $config->accom_5 == 1) required
                                   @else disabled @endif>
                        </div>
                        <div class="col-sm-4">
                            <label for="room_5_price" class="col-form-label">{{ __('form.conference_room_price') }}
                                €</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <h2>{{ __('form.conference_extra') }}</h2>
                            <hr>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-sm-4 text-right">
                            <label for="extra_sk" class="col-form-label">{{ __('form.conference_extra_sk') }}</label>
                        </div>
                        <div class="col-sm-8">
                            <textarea id="extra_sk" name="extra_sk"
                                      class="form-control">{{ old('extra_sk') ? old('extra_sk') : $config->extra_info_sk }}</textarea>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-sm-4 text-right">
                            <label for="extra_en" class="col-form-label">{{ __('form.conference_extra_en') }}</label>
                        </div>
                        <div class="col-sm-8">
                            <textarea id="extra_en" name="extra_en"
                                      class="form-control">{{ old('extra_en') ? old('extra_en') : $config->extra_info_en }}</textarea>
                        </div>
                    </div>

                </form>
            </div>

            <div class="card-footer">
                <button type="submit" form="form_conference_edit"
                        class="btn btn-lg btn-success">{{ __('form.save') }}</button>
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
                    $('#reg_start').datepicker({
                        dateFormat: "yy-mm-dd"
                    });
                    $('#conf_start').datepicker({
                        dateFormat: "yy-mm-dd"
                    });
                    $('#reg_end').datepicker({
                        dateFormat: "yy-mm-dd"
                    });
                    $('#conf_end').datepicker({
                        dateFormat: "yy-mm-dd"
                    });
                });
            }
        });

    </script>

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
            map.addListener('click', function (e) {
                placeMarker(e.latLng);
            });
            marker = new google.maps.Marker({
                position: new google.maps.LatLng({{$data->lat}}, {{$data->lng}}),
                map: map,
                draggable: true,
            });
        };

        function placeMarker(latLng) {
            marker.setPosition(latLng);
            $('#lat').val(marker.position.lat);
            $('#lng').val(marker.position.lng);
        }

        //Initialize Markdown editor
        $("#schedule_sk").markdown({
            autofocus: false,
            fullscreen: true,
            iconlibrary: 'fa',
            savable: false,
            height: 300
        });
        $("#schedule_en").markdown({
            autofocus: false,
            fullscreen: true,
            iconlibrary: 'fa',
            savable: false,
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

            adjustDates();

            $('#form_conference_edit').validate({
                rules: {
                    'title_sk': 'required',
                    'title_en': 'required',
                    'status': 'required',
                    'year': 'required',
                    'volume': 'required',
                    'lat': 'required',
                    'lng': 'required',
                    'addr_country': 'required',
                    'addr_city': 'required',
                    'addr_place': 'required',
                    'reg_start': {
                        required: true,
                        date: true,
                    },
                    'reg_end': {
                        required: true,
                        date: true,
                    },
                    'conf_start': {
                        required: true,
                        date: true,
                    },
                    'conf_end': {
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

            $('.room_check').change(function () {
                if ($(this).prop('checked')) {
                    $('#room_' + $(this).data('id') + "_price").prop('disabled', false).prop('required', true);
                } else {
                    $('#room_' + $(this).data('id') + "_price").prop('disabled', true).prop('required', false);
                }
            });

            $('.event_check').change(function () {
                if ($(this).prop('checked')) {
                    $('#special_' + $(this).data('id') + "_sk").prop('disabled', false).prop('required', true);
                    $('#special_' + $(this).data('id') + "_en").prop('disabled', false).prop('required', true);
                } else {
                    $('#special_' + $(this).data('id') + "_sk").prop('disabled', true).prop('required', false);
                    $('#special_' + $(this).data('id') + "_en").prop('disabled', true).prop('required', false);
                }
            });

            $('#reg_start').change(function () {
                adjustDates();
            });

            $('#reg_end').change(function () {
                adjustDates();
            });

            $('#conf_start').change(function () {
                adjustDates();
            });

            $('#conf_end').change(function () {
                adjustDates();
            })
        });

        function adjustDates() {
            let r_end = new Date();
            let tmp = new Date($('#reg_start').val());
            r_end.setFullYear(tmp.getFullYear());
            r_end.setMonth(tmp.getMonth());
            r_end.setDate(tmp.getDate() + 1);

            $('#reg_end').attr({
                "min": r_end.toISOString().split('T')[0]
            });

            let c_start = new Date();
            tmp = new Date($('#reg_end').val());
            c_start.setFullYear(tmp.getFullYear());
            c_start.setMonth(tmp.getMonth());
            c_start.setDate(tmp.getDate() + 1);

            $('#conf_start').attr({
                "min": c_start.toISOString().split('T')[0]
            });

            let c_end_min = new Date();
            tmp = new Date($('#conf_start').val());
            c_end_min.setFullYear(tmp.getFullYear());
            c_end_min.setMonth(tmp.getMonth());
            c_end_min.setDate(tmp.getDate() + 1);
            let c_end_max = new Date();
            c_end_max.setFullYear(tmp.getFullYear());
            c_end_max.setMonth(tmp.getMonth());
            c_end_max.setDate(tmp.getDate() + 4);

            $('#conf_end').attr({
                "min": c_end_min.toISOString().split('T')[0],
                "max": c_end_max.toISOString().split('T')[0]
            });

            if ($('#conf_end').val() && $('#conf_start').val()) {
                let days = new Date(new Date($('#conf_end').val()) - new Date($('#conf_start').val())).getDate();
                console.log("diff = " + days);
                for (let i = 1; i <= days; i++) {
                    $('#day_' + i).show(function () {
                        $(this).animate(500);
                    })
                }
                for (let i = days + 1; i <= 5; i++) {
                    $('#day_' + i).hide(function () {
                        $(this).animate(500);
                    })
                }
            }
        }

    </script>

@stop
