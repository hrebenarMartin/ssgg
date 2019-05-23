@extends('backend.layouts.app')

@section('content')

    <div class="col-12">
        <div class="container">
            <div class="d-flex flex-row-reverse">
                <div class="p-1">
                    <a href="{{ route('admin.user.index') }}" class="btn btn-primary"><i class="fa fa-chevron-circle-left"></i> {{ __('form.action_back') }}</a>
                </div>
            </div>
        </div>

        <hr>

        <div class="card">
            <div class="card-header">
                <strong class="card-title">{{__('form.user_edit')}}</strong>
            </div>
            <div class="card-body">
                <form id="user_edit_form" method="POST" action="{{route('admin.user.store')}}">
                    @csrf

                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="email" class="col-form-label">{{__('form.email')}}:</label>
                        </div>
                        <div class="col-5">
                            <input type="email" id="email" name="email" class="form-control" value="" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="name" class="col-form-label">{{__('form.profile_first_name')}}:</label>
                        </div>
                        <div class="col-5">
                            <input type="text" id="name" name="name" class="form-control" value="" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="surname" class="col-form-label">{{__('form.profile_last_name')}}:</label>
                        </div>
                        <div class="col-5">
                            <input type="text" id="surname" name="surname" class="form-control" value="" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="access" class="col-form-label">{{__('form.roles')}}:</label>
                        </div>
                        <div class="col-3">
                            <select id="roles" class="form-control chosen-select" name="roles[]" multiple>
                                {{--                            <option value="2" @if(isset($roles[2])) selected @endif>{{__('main.reguser')}}</option>--}}
                                <option value="4">{{__('main.reviewer')}}</option>
                                <option value="3">{{__('main.admin')}}</option>
                                <option value="1">{{__('main.superadmin')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label class="col-form-label" for="pass_1">{{__('main.password')}}</label>
                        </div>
                        <div class="col-4">
                            <input type="password" id="pass_1" name="pass_1" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label class="col-form-label" for="pass_2">{{__('main.password_check')}}</label>
                        </div>
                        <div class="col-4">
                            <input type="password" id="pass_2" name="pass_2" class="form-control" required>
                        </div>
                    </div>

                </form>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success" form="user_edit_form">{{__('form.save')}}</button>
            </div>
        </div>
    </div>

@endsection

@section('page_css')
    <link href="{{asset('backend/css/chosen.min.css')}}" rel="stylesheet">
@stop

@section('scripts')
    <script src="{{asset('backend/js/chosen.jquery.min.js')}}"></script>

    <script>

        $().ready(function () {
            $(".chosen-select").chosen();
            $('#pass_1').keyup(function () {
                if($(this).val().length === 0){
                    $(this).prop('required', false);
                    $('#pass_2').prop('required', false);
                }
                else{
                    $(this).prop('required', true);
                    $('#pass_2').prop('required', true);
                }
            });

            $('#user_edit_form').validate({
                rules: {
                    email: "required",
                    pass_1:{
                        minlength: 6,
                        required: true
                    },
                    pass_2:{
                        equalTo: '#pass_1',
                        required: true,
                    }
                }
            })

        })

    </script>
@stop