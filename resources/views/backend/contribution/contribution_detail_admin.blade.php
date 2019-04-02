@extends('backend.layouts.app')

@section('title', "Príspevky")

@section('content')

    <div class="col-md-12">

        <div class="container">
            <div class="d-flex flex-row-reverse">
                <div class="p-1">
                    <a href="{{ route('admin.contributions.index') }}" class="btn btn-primary"><i
                            class="fa fa-chevron-circle-left"></i> {{ __('form.action_back') }}</a>
                </div>
            </div>
        </div>

        <hr>

        <div class="card">

            <div class="card-header">
                <strong
                    class="card-title">{{__('contribution.detail_admin')}} {{ "(#".$contribution->id.") ".$contribution_author->first_name." ".$contribution_author->last_name }}</strong>
            </div>

            <div class="card-body">
                @include('backend.contribution.components.contribution_detail')

                <hr>

                <div class="row">
                    <div class="col-2">
                        <strong>{{ __('contribution.review') }}:</strong>
                    </div>
                    <div class="col-10">
                        <div class="row gray-bg p-3">
                            @if(!$contribution->review)
                                <div class="col-12">
                                    {{ __('contribution.reviewer_not_assigned') }}
                                    @if(Auth::user()->roles()->where('role_id', 3)->first()) –––
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#assign_reviewer">{{ __('contribution.assign_now') }}</button>
                                    @endif
                                </div>
                            @elseif($contribution->review->accepted == null)
                                <div class="col-12">
                                    {{ __('contribution.reviewer_no_response') }}
                                </div>
                                @include('backend.contribution.components.review')
                            @elseif($contribution->review->accepted == -1)
                                <div class="col-12">
                                    {{ __('contribution.reviewer_not_accepted') }}
                                    @if(Auth::user()->roles()->where('role_id', 3)->first())
                                        ––– <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#assign_reviewer">{{ __('contribution.assign_now') }}</button>
                                    @endif
                                </div>
                            @elseif($contribution->review->accepted == 1)
                                @include('backend.contribution.components.review')
                            @else
                            @endif
                        </div>
                    </div>

                    @if(!$contribution->review or $contribution->review->accepted == -1)
                        @include('backend.contribution.components.reviewer_assign_modal')
                    @endif

                </div>

                <hr>

                <div class="row">
                    <div class="col-2">
                        <strong>{{ __('main.comments') }}:</strong>
                    </div>
                    <div class="col-10">
                        @foreach($contribution_comments as $c)
                            @include('backend.contribution.components.comment')
                        @endforeach
                    </div>
                </div>
            </div>

        </div>

    </div>

@stop
