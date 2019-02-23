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
                <div class="row pb-4">
                    <div class="col-12 text-center">
                        <h2 class="display-4">{{ $data->year }}</h2>
                    </div>
                </div>
                <div class="row pb-5">
                    <div class="col-12 text-center">
                        <h2>{{ $data->address_place.", ".$data->address_city.", ".strtoupper($data->address_country) }}</h2>
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

                <div class="row" style="padding-bottom: 1em">
                    <div class="col-12">
                        @if($data->proceedings_file)
                            <p>{{__('form.conference_proceedings_file')}}:
                                <span id="proc_file_span">
                                    <a href="{{route('conference.proceedings_download', $data->year)}}" class="btn btn-outline-primary">{{__('contribution.download_document')}}</a>
                                    <a href="#!" id="del_proc_file" class="text-danger"><i class="fa fa-times"></i></a>
                                </span>
                            </p>
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
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Program</strong>
                            </div>
                            <div class="card-body ml-3">
                                @if(App::getLocale() == 'en') {!! \Illuminate\Mail\Markdown::parse($data->schedule_en) !!}
                                @else {!! \Illuminate\Mail\Markdown::parse($data->schedule_sk) !!}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Kofigurácia</strong>
                            </div>
                            <div class="card-body">
                                <h3>{{__('form.conference_food')}}</h3>
                                <div class="row pt-2">
                                @php
                                    $days = \Carbon\Carbon::createFromFormat('Y-m-d', $data->conference_end)->diffInDays(\Carbon\Carbon::createFromFormat('Y-m-d', $data->conference_start));
                                @endphp
                                @for ($i = 1; $i <= $days+1; $i++)
                                    <div class="col-6">
                                        <p><strong>{{__('form.conference_day')}} {{$i}}. ( {{\Carbon\Carbon::createFromFormat('Y-m-d', $data->conference_start)->addDays(($i-1))->format('d M,Y')}} ):</strong>
                                            <br>&nbsp; &nbsp; &nbsp;<strong><i class="fa @if($config["day".intval($i)."_breakfast"] == 1) fa-check text-success @else fa-times text-danger @endif"></i> {{__('form.conference_breakfast')}}</strong>
                                            <br>&nbsp; &nbsp; &nbsp;<strong><i class="fa @if($config["day".intval($i)."_lunch"] == 1) fa-check text-success @else fa-times text-danger @endif"></i> {{__('form.conference_lunch')}}</strong>
                                            <br>&nbsp; &nbsp; &nbsp;<strong><i class="fa @if($config["day".intval($i)."_dinner"] == 1) fa-check text-success @else fa-times text-danger @endif"></i> {{__('form.conference_dinner')}}</strong>
                                        </p>
                                    </div>
                                @endfor
                                </div>
                                <h3>{{__('form.conference_rooms')}}</h3>
                                <div class="row pt-2">
                                    <ul class="col-11 ml-5">
                                        @if($config->accom_1 == 1)
                                            <li><p><strong>{{__('form.conference_room1')}}:</strong> {{__('main.cost')}} <strong><u>{{$config->accom_1_price}} €</u></strong></p></li>
                                        @endif
                                        @if($config->accom_2 == 1)
                                            <li><p><strong>{{__('form.conference_room2')}}:</strong> {{__('main.cost')}} <strong><u>{{$config->accom_2_price}} €</u></strong></p></li>
                                        @endif
                                        @if($config->accom_3 == 1)
                                            <li><p><strong>{{__('form.conference_room3')}}:</strong> {{__('main.cost')}} <strong><u>{{$config->accom_3_price}} €</u></strong></p></li>
                                        @endif
                                        @if($config->accom_4 == 1)
                                            <li><p><strong>{{__('form.conference_room4')}}:</strong> {{__('main.cost')}} <strong><u>{{$config->accom_4_price}} €</u></strong></p></li>
                                        @endif
                                        @if($config->accom_5 == 1)
                                            <li><p><strong>{{__('form.conference_room5')}}:</strong> {{__('main.cost')}} <strong><u>{{$config->accom_5_price}} €</u></strong></p></li>
                                        @endif
                                    </ul>
                                </div>
                                <h3>{{ __('form.conference_special') }}</h3>
                                <div class="row pt-2">
                                    <ul class="col-11 ml-5">
                                    @if($config->special_1 == 1)
                                        @if(App::getLocale()=='en')
                                            <li><p>{{$config->special_1_en}}</p></li>
                                        @else
                                            <li><p>{{$config->special_1_sk}}</p></li>
                                        @endif
                                    @endif
                                    @if($config->special_2 == 1)
                                        @if(App::getLocale()=='en')
                                            <li><p>{{$config->special_2_en}}</p></li>
                                        @else
                                            <li><p>{{$config->special_2_sk}}</p></li>
                                        @endif
                                    @endif
                                    @if($config->special_3 == 1)
                                        @if(App::getLocale()=='en')
                                            <li><p>{{$config->special_3_en}}</p></li>
                                        @else
                                            <li><p>{{$config->special_3_sk}}</p></li>
                                        @endif
                                    @endif
                                    </ul>
                                </div>
                                <h3>{{__('form.conference_extra')}}</h3>
                                <div class="row pt-2">
                                    <div class="col-12">
                                        @if(App::getLocale() == 'en' )
                                            <p>{{$config->extra_info_en}}</p>
                                        @else
                                            <p>{{$config->extra_info_sk}}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row pt-3 pd-3">
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

        $().ready(function () {

            $('#del_proc_file').click(function () {
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if(willDelete){
                            $.ajax({
                                type:'POST',
                                url:'/ajax',
                                data: {
                                    action: "delete_proceedings_file",
                                    conf_id: {{$data->id}},
                                },
                                dataType: 'json',
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                success:function(ajax_data){
                                    $('#proc_file_span').hide(function () {
                                        $(this).animate();
                                    });
                                    toastr.success(ajax_data.status)
                                },
                                error: function () {
                                    toastr.error("Oops, something bad happened")
                                }
                            })
                        }
                    });
            });

        });

    </script>
@stop
