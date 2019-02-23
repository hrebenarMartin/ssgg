@extends('layouts.app')


@if(App::isLocale('en'))
    @section('title', "SSGG | ".$page->title_second)
@else
    @section('title', "SSGG | ".$page->title)
@endif

@section('page_css')

@endsection


@section('content')

    @foreach($data as $block)
        @if($block->type == 4)
            @if($block->fixed_id == 99)
                @include('components.fixed_99_conference_head')
            @elseif($block->fixed_id == 98)
                @include('components.fixed_98_conference_schedule')
            @elseif($block->fixed_id == 97)
                @include('components.fixed_97_conference_address_map')
            @elseif($block->fixed_id == 96)
                @include('components.fixed_96_conference_accomm_and_food')
            @elseif($block->fixed_id == 95)
                @include('components.fixed_95_conference_special_events')
            @endif
        @elseif($block->type == 3)
            @if(App::isLocale('en'))
                {!! $block->content_en !!}
            @else
                {!! $block->content !!}
            @endif
        @elseif($block->type == 2)
            @if(App::isLocale('en'))
                {!! \Illuminate\Mail\Markdown::parse($block->content_en) !!}
            @else
                {!! \Illuminate\Mail\Markdown::parse($block->content) !!}
            @endif
        @elseif($block->type == 1)
            @if(App::isLocale('en'))
                {!! $block->content_en !!}
            @else
                {!! $block->content !!}
            @endif
        @else
        @endif
    @endforeach


@endsection


@section('page_scripts')
    @if(isset($dynamic_data))
    <script src="https://maps.googleapis.com/maps/api/js?key={{env('GMAPS_API')}}&callback=initMap"
            async defer></script>

    <script>
        var map;
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: {{$dynamic_data->conference->lat}}, lng: {{$dynamic_data->conference->lng}}},
                zoom: 16,
                panControl: false,
                zoomControl: true,
                scaleControl: true,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
            });
            marker = new google.maps.Marker({
                position: new google.maps.LatLng({{$dynamic_data->conference->lat}}, {{$dynamic_data->conference->lng}}),
                map: map,
            });
            marker.setAnimation(google.maps.Animation.BOUNCE)
        }

    </script>
    @endif
@endsection
