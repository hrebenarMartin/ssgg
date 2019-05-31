@extends('backend.layouts.app')

@section('title', __('titles.profile_edit'))

@section('content')

    <div class="col-md-12">
        <div class="container">
            <div class="d-flex flex-row-reverse">
                <div class="p-1">
                    <a href="{{ route('user.profile.show', $data->user_id) }}" class="btn btn-primary"><i
                                class="fa fa-chevron-circle-left"></i> {{ __('form.action_back') }}</a>
                </div>
            </div>
        </div>

        <hr>
        @if(Auth::id() == $data->user_id || Auth::user()->access_level == 4)

            <div class="card bg-primary">
                <form id="profile_edit_form" method="POST" enctype="multipart/form-data"
                      action="{{ route('user.profile.update', $data->id) }}">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="card-header">
                        <strong class="card-title text-white">{{ __('form.profile_edit') }}</strong>
                    </div>
                    <div class="card-body">

                        <div class="row animated fadeIn">
                            <div class="col-sm-4">

                                <div class="card">
                                    <div class="card-header">
                                        <i class="fa fa-user"></i> {{ __('form.profile') }}
                                    </div>
                                    <div class="card-body">
                                        <div class="mx-auto d-block">
                                            @if(file_exists('public/images/profiles/'.$data->user_id.'/'.$data->image))
                                                <img data-src="holder.js/100%X100%" alt="..."
                                                     src="{!! asset('public/images/profiles/'.$data->user_id.'/'.$data->image) !!}"
                                                     class="rounded-circle mx-auto d-block" width="200">
                                            @else
                                                <img alt="..." src="{!! asset('images/placeholders/user_m.png') !!}"
                                                     width="200" class="mx-auto d-block">
                                            @endif
                                            <div>
                                            <span class="btn btn-default btn-file">
                                                <input type="file" name="file" accept="image/jpeg, image/png">
                                            </span>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col-sm-4 text-right">
                                                    <label class="col-form-label form-control-label col-form-label-sm"
                                                           for="title_before">{{ __('form.profile_title_before') }}</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control form-control-sm"
                                                           id="title_before" name="title_before"
                                                           value="{{ old('title_before') ? old('title_before') : $data->title_before }}"
                                                           placeholder="Example: Ing.">
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col-sm-4 text-right">
                                                    <label class="col-form-label form-control-label col-form-label-sm"
                                                           for="first_name">{{ __('form.profile_first_name') }}
                                                        *</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control form-control-sm"
                                                           id="first_name" name="first_name"
                                                           value="{{ old('first_name') ? old('first_name') : $data->first_name }}"
                                                           placeholder="First Name" required>
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col-sm-4 text-right">
                                                    <label class="col-form-label form-control-label col-form-label-sm"
                                                           for="middle_name">{{ __('form.profile_middle_name') }}</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control form-control-sm"
                                                           id="middle_name" name="middle_name"
                                                           value="{{ old('middle_name') ? old('middle_name') : $data->middle_name }}"
                                                           placeholder="Middle Name">
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col-sm-4 text-right">
                                                    <label class="col-form-label form-control-label col-form-label-sm"
                                                           for="last_name">{{ __('form.profile_last_name') }} *</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control form-control-sm"
                                                           id="last_name" name="last_name"
                                                           value="{{ old('last_name') ? old('last_name') : $data->last_name }}"
                                                           placeholder="Last Name" required>
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col-sm-4 text-right">
                                                    <label class="col-form-label form-control-label col-form-label-sm"
                                                           for="title_after">{{ __('form.profile_title_after') }}</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control form-control-sm"
                                                           id="title_after" name="title_after"
                                                           value="{{ old('title_after') ? old('title_after') : $data->title_after }}"
                                                           placeholder="Example: PhD.">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-8">
                                <div class="card">
                                    <div class="card-header">
                                        {{ __('form.profile_basic_information') }}
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-12 form-group my-0">
                                                <div class="col-sm-4 text-right">
                                                    <strong><label for="email"
                                                                   class="form-control-label col-form-label-sm">{{ __('form.email') }}</label></strong>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="email" id="email" name="email"
                                                           class="form-control form-control-sm"
                                                           value="{{ $data->email }}" readonly>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 form-group my-0">
                                                <div class="col-sm-4 text-right">
                                                    <strong><label class="col-form-label-sm form-control-label"
                                                                   for="gender">{{ __('form.profile_gender') }}
                                                            *</label></strong>
                                                </div>
                                                <div class="col-sm-3">
                                                    <select id="gender" name="gender"
                                                            class="form-control form-control-sm" required>
                                                        <option value="" selected
                                                                disabled>{{ __('form.profile_select_gender') }}</option>
                                                        <option value="M"
                                                                @if($data->gender == 'M') selected @endif >{{ __('form.profile_gender_m') }}</option>
                                                        <option value="F"
                                                                @if($data->gender == 'F') selected @endif >{{ __('form.profile_gender_f') }}</option>
                                                        <option value="O"
                                                                @if($data->gender == 'O') selected @endif >{{ __('form.profile_gender_o') }}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            {{--<div class="col-sm-12 form-group my-0">
                                                <div class="col-sm-4 text-right">
                                                    <strong><label class="form-control-label col-form-label-sm"
                                                                   for="birthday">{{ __('form.profile_birthday') }}</label></strong>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="date" class="form-control form-control-sm"
                                                           id="birthday"
                                                           value="{{ old('birthday') ? old('birthday') : $data->birthday }}"
                                                           name="birthday">
                                                </div>
                                            </div>--}}

                                            {{--<div class="col-sm-12 form-group my-0">
                                                <div class="col-sm-4 text-right">
                                                    <strong><label class="form-control-label col-form-label-sm"
                                                                   for="age">{{ __('form.profile_age') }}</label></strong>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="number" id="age" name="age" value="" min="1" max="99"
                                                           class="form-control-sm form-control" readonly>
                                                </div>
                                            </div>--}}

                                            <div class="col-sm-12 form-group my-0">
                                                <div class="col-sm-4 text-right">
                                                    <strong><label class="form-control-label col-form-label-sm"
                                                                   for="phone">{{ __('form.profile_phone') }}</label></strong>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="text" id="phone" name="phone"
                                                           value="{{ old('phone') ? old('phone') : $data->phone }}"
                                                           class="form-control-sm form-control">
                                                </div>
                                            </div>

                                            <div class="col-sm-12 form-group my-0">
                                                <div class="col-sm-4 text-right">
                                                    <strong><label class="form-control-label col-form-label-sm"
                                                                   for="ico">{{ __('form.profile_ico') }}</label></strong>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="text" id="ico" name="ico"
                                                           value="{{ old('ico') ? old('ico') : $data->ico }}"
                                                           class="form-control-sm form-control">
                                                </div>
                                            </div>

                                            <div class="col-sm-12 form-group my-0">
                                                <div class="col-sm-4 text-right">
                                                    <strong><label class="form-control-label col-form-label-sm"
                                                                   for="dic">{{ __('form.profile_dic') }}</label></strong>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="text" id="dic" name="dic"
                                                           value="{{ old('dic') ? old('dic') : $data->dic }}"
                                                           class="form-control-sm form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="row">

                                            <div class="col-sm-12 form-group my-2">
                                                <div class="col-sm-4 text-right">
                                                    <strong><label class="form-control-label col-form-label-sm"
                                                                   for="workplace">{{ __('form.profile_workplace') }}
                                                            *</label></strong>
                                                </div>
                                                <div class="col-sm-6">
                                                    <textarea type="text" id="workplace" name="workplace"
                                                              class="form-control-sm form-control" rows="3"
                                                              required>{{ old('workplace') ? old('workplace') : $data->workplace }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 form-group my-0">
                                                <div class="col-sm-4 text-right">
                                                    <strong><label class="col-form-label-sm form-control-label"
                                                                   for="country">{{ __('form.profile_country') }}
                                                            *</label></strong>
                                                </div>
                                                <div class="col-sm-3">
                                                    <select id="country" name="country"
                                                            class="form-control form-control-sm" required>
                                                        <option value="" selected
                                                                disabled>{{ __('form.profile_select_country') }}</option>
                                                        @foreach($countries as $c)
                                                            <option value="{{ $c->id }}"
                                                                    @if($data->address_country == $c->id) selected @endif >{{ $c->name_sk }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 form-group my-0">
                                                <div class="col-sm-4 text-right">
                                                    <strong><label class="form-control-label col-form-label-sm"
                                                                   for="city">{{ __('form.profile_city') }}
                                                            *</label></strong>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="text" id="city" name="city"
                                                           value="{{ old('city') ? old('city') : $data->address_city }}"
                                                           class="form-control-sm form-control" required>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 form-group my-0">
                                                <div class="col-sm-4 text-right">
                                                    <strong><label class="form-control-label col-form-label-sm"
                                                                   for="street">{{ __('form.profile_street') }}
                                                            *</label></strong>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="text" id="street" name="street"
                                                           value="{{ old('street') ? old('street') : $data->address_street }}"
                                                           class="form-control-sm form-control" required>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 form-group my-0">
                                                <div class="col-sm-4 text-right">
                                                    <strong><label class="form-control-label col-form-label-sm"
                                                                   for="psc">{{ __('form.profile_psc') }}
                                                            *</label></strong>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" id="psc" name="psc"
                                                           value="{{ old('psc') ? old('psc') : $data->address_psc }}"
                                                           class="form-control-sm form-control" required>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success btn-lg"><i
                                    class="fa fa-check-circle"></i> {{ __('form.save') }}</button>
                    </div>
                </form>
            </div>
        @else
            @include('backend.components.permission_denied')
        @endif
    </div>

@endsection


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
        });


    </script>
@stop
