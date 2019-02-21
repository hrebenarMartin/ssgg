@extends('backend.layouts.app')

@section('title', __('titles.conference_detail'))

@section('content')

    <div class="col-sm-12">

        <div class="container">
            <div class="d-flex flex-row-reverse">
                <div class="p-1">
                    <a href="{{ route('admin.conferences.edit', $data->id) }}" class="btn btn-success">{{ __('form.action_edit_conference') }}</a>
                    <a href="{{ route('admin.conferences.index') }}" class="btn btn-primary"><i class="fa fa-chevron-circle-left"></i> {{ __('form.action_back') }}</a>
                </div>
            </div>
        </div>

        <hr>

        <div class="card
        @if($data->status == 1) bg-success text-light
        @elseif($data->status == 2) bg-warning text-dark
        @else bg-primary text-light
        @endif">
            <div class="card-header">
                <strong class="card-title">@if($data->status == 1)
                        {{ __('form.conference_open') }}
                    @elseif($data->status == 2)
                        {{ __('form.conference_closed') }}
                    @else
                        {{ __('form.conference_archived') }}
                    @endif</strong>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <strong class="card-title">{{ __('titles.conference_detail') }}</strong>
            </div>
            <div class="card-body">
                <div class="row pb-4">
                    <div class="col-12 text-center">
                        @if(App::getLocale() == 'en') <h1>{{ $data->title_en }}</h1>
                        @else <h1>{{ $data->title_sk }}</h1>
                        @endif
                    </div>
                </div>
                <div class="row pb-2">
                    <div class="col-12 text-center">
                        <h2 class="display-4">{{ $data->year }}</h2>
                    </div>
                </div>
                <div class="row pb-5">
                    <div class="col-12 text-center">
                        <h2>{{ $data->address_place.", ".$data->address_city.", ".$data->address_country }}</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">{{ __('form.conference_dates') }}</strong>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <strong>{{ __('form.conference_registration_dates') }}</strong>
                                </div>
                                <div class="col-12 text-right pb-3">
                                    {{ $data->registration_start." - ".$data->registration_end }}
                                </div>
                                <div class="col-12">
                                    <strong>{{ __('form.conference_conference_dates') }}</strong>
                                </div>
                                <div class="col-12 text-right">
                                    {{ $data->conference_start." - ".$data->conference_end }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">{{ __('form.conference_statistics') }}</strong>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <strong>{{ __('form.conference_attendees') }}</strong>
                                </div>
                                <div class="col-12 text-right pb-3">
                                    {{ $stats->attendees }}
                                </div>
                                <div class="col-12">
                                    <strong>{{ __('form.conference_contributions_uploaded') }}</strong>
                                </div>
                                <div class="col-12 text-right">
                                    {{ $stats->contributions }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        @if($data->proceedings_file)
                            <a href="#!" class="btn btn-outline-primary"></a>
                        @else
                            <p>{{ __('form.conference_proceedings_file_not_available') }}</p>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div id="map" style="height: 100%; min-height: 500px"></div>
                    </div>
                </div>

                <div class="row mt-5 mb-5">
                    <div class="col-10 offset-1">
                        @if(App::getLocale() == 'en') {!! \Illuminate\Mail\Markdown::parse($data->schedule_en) !!}
                        @else {!! \Illuminate\Mail\Markdown::parse($data->schedule_sk) !!}
                        @endif
                    </div>
                </div>

                <div class="row pt-5 pd-3">
                    <div class="col-12">
                        <strong><h2>{{ __('form.conference_gallery') }}</h2></strong>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key={{env('GMAPS_API')}}&callback=initMap"
            async defer></script>
    <script>
        var map;
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: {{$data->lat}}, lng: {{$data->lng}}},
                zoom: 16,
                panControl: false,
                zoomControl: true,
                scaleControl: true,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
            });
            marker = new google.maps.Marker({
                position: new google.maps.LatLng({{$data->lat}}, {{$data->lng}}),
                map: map,
            });
            marker.setAnimation(google.maps.Animation.BOUNCE)
        }


    </script>
@stop
