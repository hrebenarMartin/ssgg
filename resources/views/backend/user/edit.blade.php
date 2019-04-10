@extends('backend.layouts.app')

@section('title', __('titles.user_edit'))

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
            <form id="user_edit_form" method="POST" action="{{route('admin.user.update',$user->id)}}">
                @csrf
                {{method_field('PUT')}}

                <div class="row form-group">
                    <div class="col-4 text-right">
                        <label for="email" class="col-form-label">{{__('form.email')}}:</label>
                    </div>
                    <div class="col-5">
                        <input type="email" id="email" name="email" class="form-control" value="{{$user->email}}" readonly>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-4 text-right">
                        <label for="access" class="col-form-label">{{__('form.access_level')}}:</label>
                    </div>
                    <div class="col-3">
                        <select id="access" class="form-control" name="access">
                            <option value="1" @if($user->access_level == 1) selected @endif>{{__('main.reguser')}}</option>
                            <option value="2" @if($user->access_level == 2) selected @endif>{{__('main.reviewer')}}</option>
                            <option value="3" @if($user->access_level == 3) selected @endif>{{__('main.admin')}}</option>
                            <option value="4" @if($user->access_level == 4) selected @endif>{{__('main.superadmin')}}</option>
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-4 text-right">
                        <label class="col-form-label" for="pass_1">{{__('main.password')}}</label>
                    </div>
                    <div class="col-4">
                        <input type="password" id="pass_1" name="pass_1" class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-4 text-right">
                        <label class="col-form-label" for="pass_2">{{__('main.password_check')}}</label>
                    </div>
                    <div class="col-4">
                        <input type="password" id="pass_2" name="pass_2" class="form-control">
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

@section('scripts')
    <script>

        $().ready(function () {

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
                    pass_1:{
                        minlength: 6
                    },
                    pass_2:{
                        equalTo: '#pass_1'
                    }
                }
            })

        })

    </script>
@stop
