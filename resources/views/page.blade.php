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
            @elseif($block->fixed_id == 94)
                @include('components.fixed_94_conference_participants_and_contributions')
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

        <script>
            $().ready(function () {
                $('.contribution_modal_open').click(function () {
                    var contr_id = $(this).data('contribution-id');
                    console.log(contr_id);
                    $.ajax({
                        type: 'POST',
                        url: '/ajax-ext',
                        data: {
                            action: 'get_contribution_and_comments',
                            contr_id: contr_id
                        },
                        dataType: 'json',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        success: function (data) {
                            console.log(data);
                            if (data.status == 'OK') {
                                $('#contribution_id').val(contr_id);
                                $('#contribution_title').html(data.contribution["title"]);
                                $('#contribution_abstract').html(data.contribution["abstract"])
                                data.comments.forEach(function (e) {
                                    console.log(e);
                                })
                            }
                        }
                    })
                });

                $('#save_comment_btn').click(function () {
                    var contr_id = $('#contribution_id').val();
                    var comment_text = $('#comment_text').val();

                    if ($('#comment_text').val().length < 1){
                        $('#comment_text_hint').show();
                        return
                    }
                    $('#comment_text_hint').hide();
                    $.ajax({
                        type: 'POST',
                        url: '/ajax',
                        data: {
                            action: 'save_contribution_comment',
                            contr_id: contr_id,
                            comment: comment_text
                        },
                        dataType: 'json',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        success: function (data) {
                            console.log(data);
                            if (data.status == 'OK') {
                                $('#comment_text').val("");
                            }
                        }
                    })
                });
            })
        </script>
    @endif
@endsection
