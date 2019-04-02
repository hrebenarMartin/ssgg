@extends('backend.layouts.app')

@section('title', __('review.detail'))

@section('content')

    <div class="col-md-12">

        <div class="container">
            <div class="d-flex flex-row-reverse">
                <div class="p-1">
                    <a href="{{ route('review.myReview.index') }}" class="btn btn-primary"><i
                            class="fa fa-chevron-circle-left"></i> {{ __('form.action_back') }}</a>
                    @if(!$review->accepted)
                        <a href="{{ route('review.accept', $review->id) }}" class="btn btn-success">
                            <i class="fa fa-check"></i>
                        </a>
                        <a href="{{ route('review.reject', $review->id) }}" class="btn btn-danger">
                            <i class="fa fa-times"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <hr>

        <div class="card">

            <div class="card-header">
                <strong class="card-title"></strong>
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
                            <div class="col-12" style="padding-bottom: 1em">
                                @if($review->approved == 1)
                                    <h3 class="text-success">
                                <span class="fa-layers fa-fw">
                                    <i class="fa fa-certificate" data-fa-transform="grow-16"></i>
                                    <i class="fa fa-check" style="color: #fff;"></i>
                                </span>
                                        &nbsp; <b>{{$review->rating}}</b>/5 &nbsp;Approved
                                        <a href="{{ route('review.myReview.edit', $review->id) }}"
                                           class="btn btn-success pull-right"><i
                                                class="fa fa-edit"></i> {{ __('main.edit') }}
                                        </a>
                                    </h3>
                                @elseif($review->approved == -1)
                                    <h3 class="text-danger">
                                <span class="fa-layers fa-fw">
                                    <i class="fa fa-certificate" data-fa-transform="grow-16"></i>
                                    <i class="fa fa-times" style="color: #fff;"></i>
                                </span>
                                        &nbsp;Not Approved
                                        <a href="{{ route('review.myReview.edit', $review->id) }}"
                                           class="btn btn-success pull-right"><i
                                                class="fa fa-edit"></i> {{ __('main.edit') }}
                                        </a>
                                    </h3>
                                @else
                                    <h3 class="text-muted">
                                <span class="fa-layers fa-fw">
                                    <i class="fa fa-certificate" data-fa-transform="grow-16"></i>
                                    <i class="fa fa-minus" style="color: #fff;"></i>
                                </span>
                                        &nbsp;Not Rated
                                        <a href="{{ route('review.myReview.edit', $review->id) }}"
                                           class="btn btn-success pull-right"><i
                                                class="fa fa-edit"></i> {{ __('main.edit') }}
                                        </a>
                                    </h3>
                                @endif
                            </div>
                            <div class="col-1">
                                @if($review->reviewer->profile->image)
                                    <img
                                        src="{{asset('public/images/profiles/'.$review->reviewer->profile->id."/".$review->reviewer->profile->image)}}"
                                        class="rounded-circle" width="100%" style="max-width: 50px;">
                                @endif
                            </div>
                            <div class="col-8 col-sm-10">
                                <p>
                                    <strong>{{$review->reviewer->profile->first_name." ".$review->reviewer->profile->last_name}}</strong>
                                    <br>{{\Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $review->reviewer->profile->updated_at)->format('d M, Y')}}
                                </p>
                            </div>
                            <div class="col-12">
                                {{$review->review}}
                            </div>
                        </div>
                    </div>

                </div>

                <hr>
            </div>

        </div>

    </div>

@stop
