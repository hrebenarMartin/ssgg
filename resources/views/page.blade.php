@extends('layouts.app')


@if(App::isLocale('en'))
    @section('title', "SSGG | ".$page->title_second)
@else
    @section('title', "SSGG | ".$page->title)
@endif

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
            @elseif($block->fixed_id == 93)
                @include('components.fixed_93_conference_gallery')
            @elseif($block->fixed_id == 59)
                @include('components.fixed_59_scg_archive_list')
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

@section('page_css')
    @if(isset($dynamic_data) and isset($dynamic_data->conference))
        <!-- blueimp Gallery styles -->
        <link rel="stylesheet" href="https://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
        <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
        <link rel="stylesheet" href="{!! asset('js/jQuery-File-Upload/css/jquery.fileupload.css') !!}">
        <link rel="stylesheet" href="{!! asset('js/jQuery-File-Upload/css/jquery.fileupload-ui.css') !!}">

        <!-- CSS adjustments for browsers with JavaScript disabled -->
        <noscript>
            <link rel="stylesheet" href="{!! asset('js/jQuery-File-Upload/css/jquery.fileupload-noscript.css') !!}">
        </noscript>
        <noscript>
            <link rel="stylesheet" href="{!! asset('js/jQuery-File-Upload/css/jquery.fileupload-ui-noscript.css') !!}">
        </noscript>
    @endif
@stop


@section('page_scripts')

    @if(isset($dynamic_data) and isset($dynamic_data->conference))
        <script src="https://maps.googleapis.com/maps/api/js?key={{env('GMAPS_API')}}&callback=initMap"
                async defer></script>

        <!-- blueimp Gallery script -->
        <script src="https://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>

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
                    $.ajax({
                        type: 'POST',
                        url: '{{ route("ajax_ext") }}',
                        //url: '/Projects/ssgg/ajax-ext',
                        data: {
                            action: 'get_contribution_and_comments',
                            contr_id: contr_id
                        },
                        dataType: 'json',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        success: function (data) {
                            if (data.status == 'OK') {
                                $('#contribution_id').val(contr_id);
                                $('#contribution_title').html(data.contribution["title"]);
                                $('#contribution_abstract').html(data.contribution["abstract"]);
                                $('#co_authors').html(data.contribution["co_authors"]);

                                //$('#contribution_comments').innerHTML = '';
                                var myNode = document.getElementById("contribution_comments");
                                while (myNode.firstChild) {
                                    myNode.removeChild(myNode.firstChild);
                                }

                                data.comments.forEach(function (e) {
                                    let comm = $("#comment_wrap_template").clone();

                                    comm.attr('id', "");
                                    if (e.prof_img != "") {
                                        comm.find('#author_picture').attr('src', "{{asset("public/images/profiles/")}}/" + e.user_id + "/" + e.prof_img)
                                    } else {
                                        comm.find('#author_picture').attr('src', "{{asset("public/images/placeholders/user_o.png")}}");
                                    }
                                    comm.find(".author_name").text(e.first_name + " " + e.last_name);
                                    comm.find(".date_added").text(e.date);
                                    comm.find(".comment_text").text(e.comment);

                                    $("#contribution_comments").append(comm);
                                    comm.show(function () {
                                        $(this).animate(500)
                                    });
                                })
                            }
                        }
                    })
                });

                $('#save_comment_btn').click(function () {
                    var contr_id = $('#contribution_id').val();
                    var comment_text = $('#comment_text').val();

                    if ($('#comment_text').val().length < 1) {
                        $('#comment_text_hint').show();
                        return
                    }
                    $('#comment_text_hint').hide();
                    $.ajax({
                        type: 'POST',
                        url: '{{ route("ajax") }}',
                        //url: '/Projects/ssgg/ajax',
                        data: {
                            action: 'save_contribution_comment',
                            contr_id: contr_id,
                            comment: comment_text
                        },
                        dataType: 'json',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        success: function (data) {
                            if (data.status == 'OK') {
                                let comm = $("#comment_wrap_template").clone();

                                comm.attr('id', "");
                                if (data.author.image != "") {
                                    comm.find('#author_picture').attr('src', "{{asset("public/images/profiles/")}}/" + data.author.user_id + "/" + data.author.image)
                                } else {
                                    comm.find('#author_picture').attr('src', "{{asset("public/images/placeholders/user_o.png")}}");
                                }
                                comm.find(".author_name").text(data.author.first_name + " " + data.author.last_name);
                                comm.find(".date_added").text("xx.yy.2019");
                                comm.find(".comment_text").text(data.comment.comment);

                                $("#contribution_comments").append(comm);
                                comm.show(function () {
                                    $(this).animate(500)
                                });

                                $('#comment_text').val("");
                            }
                        }
                    })
                });
            })
        </script>
    @endif
@endsection
