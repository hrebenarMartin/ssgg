@extends('backend.layouts.app')

@section('title', __('titles.conference_detail'))

@section('content')
    <!-- The Gallery as lightbox dialog, should be a child element of the document body -->
    <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls text-white">
        <div class="slides"></div>
        <h3 class="title"></h3>
        <a class="prev">‹</a>
        <a class="next">›</a>
        <a class="close">×</a>
        <a class="play-pause"></a>
        <ol class="indicator"></ol>
    </div>
    <div class="col-sm-12">

        <div class="container">
            <div class="d-flex flex-row-reverse">
                <div class="p-1">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Admin tools
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item"
                               href="{{route('admin.conferences.review_form.index', $data->id)}}">{{__('conference.review_form')}}</a>
                        </div>
                        <a href="{{ route('admin.conferences.edit', $data->id) }}"
                           class="btn btn-success">{{ __('form.action_edit_conference') }}</a>
                        <a href="{{ route('admin.conferences.index') }}" class="btn btn-primary"><i
                                    class="fa fa-fw fa-chevron-circle-left"></i> {{ __('form.action_back') }}</a>
                    </div>
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

        <div class="col-12">
            <div class="alert alert-info fade show" role="alert">
                <div class="row">
                    <div class="col-sm-12">
                        <i class="fa fa-lightbulb fa-fw"></i> Detail konferencie
                    </div>
                </div>
                <div class="row py-1">
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-sm btn-secondary pull-right">Admin tools</i>
                        </button>
                    </div>
                    <div class="col-sm-10">
                        - Dropdown menu s odkazom na editáciu recenzného formulára konferencie
                    </div>
                </div>
                <hr>
                <div class="row py-1">
                    <div class="col-sm-12">
                        Pre pridanie obrázkov do galérie, kliknite na tlačidlo
                        <button type="button" class="btn btn-success btn-sm">
                            <i class="glyphicon glyphicon-plus"></i>
                            <span>{{ __('form.files_add') }}...</span>
                        </button>
                        a vyberte 1 alebo viac obrázkov a potom kliknite na tlačidlo
                        <button type="button" class="btn btn-primary btn-sm">
                            <i class="glyphicon glyphicon-upload"></i>
                            <span>{{ __('form.files_upload') }}</span>
                        </button>
                        pre začatie uploadu obrázkov na server. Pre zrušenie výberu alebo uploadu kliknite natlačidlo
                        <button type="button" class="btn btn-warning btn-sm">
                            <i class="glyphicon glyphicon-ban-circle"></i>
                            <span>{{ __('form.files_upload_cancel') }}</span>
                        </button>
                    </div>
                </div>
                <hr>
                <div class="row py-1">
                    <div class="col-sm-12">
                        Pre zmazanie nahratého obrázku, kliknite na tlačidlo
                        <button type="button"
                                class="btn btn-md btn-danger btn-sm"><i
                                    class="fa fa-fw fa-trash"></i></button>
                        v pravom horno rohu daného obrázku.

                    </div>
                </div>
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
                                    {{ \Carbon\Carbon::createFromFormat("Y-m-d",$data->registration_start)->format('d M,Y')
                                    ." - ".
                                    \Carbon\Carbon::createFromFormat("Y-m-d",$data->registration_end)->format('d M,Y') }}
                                </div>
                                <div class="col-12">
                                    <strong>{{ __('form.conference_conference_dates') }}</strong>
                                </div>
                                <div class="col-12 text-right">
                                    {{ \Carbon\Carbon::createFromFormat("Y-m-d",$data->conference_start)->format('d M,Y')
                                    ." - ".
                                    \Carbon\Carbon::createFromFormat("Y-m-d",$data->conference_end)->format('d M,Y') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">{{ __('form.conference_statistics') }}
                                    <a href="{{ route('admin.conferences.conference_statistics', $data->id) }}"
                                            class="pull-right btn btn-success btn-sm">
                                        {{ __('form.conference_statistics') }}
                                    </a>
                                </strong>
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
                                    <a href="{{route('conference.proceedings_download', $data->year)}}"
                                       class="btn btn-outline-primary">{{__('contribution.download_document')}}</a>
                                    <a href="#!" id="del_proc_file" class="text-danger"><i
                                                class="fa fa-fw fa-times"></i></a>
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
                                <strong class="card-title">{{ __('titles.conference_schedule') }}</strong>
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
                                <strong class="card-title">{{ __('form.conference_config') }}</strong>
                            </div>
                            <div class="card-body">
                                <h3>{{__('form.conference_food')}}</h3>
                                <div class="row pt-2">
                                    @php
                                        $days = \Carbon\Carbon::createFromFormat('Y-m-d', $data->conference_end)->diffInDays(\Carbon\Carbon::createFromFormat('Y-m-d', $data->conference_start));
                                    @endphp
                                    @for ($i = 1; $i <= $days+1; $i++)
                                        <div class="col-6">
                                            <p><strong>{{__('form.conference_day')}} {{$i}}.
                                                    ( {{\Carbon\Carbon::createFromFormat('Y-m-d', $data->conference_start)->addDays(($i-1))->format('d M,Y')}}
                                                    ):</strong>
                                                <br>&nbsp; &nbsp; &nbsp;<strong><i
                                                            class="fa fa-fw @if($config["day".intval($i)."_breakfast"] == 1) fa-check text-success @else fa-times text-danger @endif"></i> {{__('form.conference_breakfast')}}
                                                </strong>
                                                <br>&nbsp; &nbsp; &nbsp;<strong><i
                                                            class="fa fa-fw @if($config["day".intval($i)."_lunch"] == 1) fa-check text-success @else fa-times text-danger @endif"></i> {{__('form.conference_lunch')}}
                                                </strong>
                                                <br>&nbsp; &nbsp; &nbsp;<strong><i
                                                            class="fa fa-fw @if($config["day".intval($i)."_dinner"] == 1) fa-check text-success @else fa-times text-danger @endif"></i> {{__('form.conference_dinner')}}
                                                </strong>
                                            </p>
                                        </div>
                                    @endfor
                                </div>
                                <h3>{{__('form.conference_rooms')}}</h3>
                                <div class="row pt-2">
                                    <ul class="col-11 ml-5">
                                        @if($config->accom_1 == 1)
                                            <li><p><strong>{{__('form.conference_room1')}}
                                                        :</strong> {{__('main.cost')}}
                                                    <strong><u>{{$config->accom_1_price}} €</u></strong></p></li>
                                        @endif
                                        @if($config->accom_2 == 1)
                                            <li><p><strong>{{__('form.conference_room2')}}
                                                        :</strong> {{__('main.cost')}}
                                                    <strong><u>{{$config->accom_2_price}} €</u></strong></p></li>
                                        @endif
                                        @if($config->accom_3 == 1)
                                            <li><p><strong>{{__('form.conference_room3')}}
                                                        :</strong> {{__('main.cost')}}
                                                    <strong><u>{{$config->accom_3_price}} €</u></strong></p></li>
                                        @endif
                                        @if($config->accom_4 == 1)
                                            <li><p><strong>{{__('form.conference_room4')}}
                                                        :</strong> {{__('main.cost')}}
                                                    <strong><u>{{$config->accom_4_price}} €</u></strong></p></li>
                                        @endif
                                        @if($config->accom_5 == 1)
                                            <li><p><strong>{{__('form.conference_room5')}}
                                                        :</strong> {{__('main.cost')}}
                                                    <strong><u>{{$config->accom_5_price}} €</u></strong></p></li>
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
                        <strong><h2 class="mb-4">{{ __('form.conference_gallery') }}</h2></strong>
                        <form id="fileupload" action="{{ route('admin.conferences.upload_images') }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="conference_id" value="{{$data->id}}">

                            <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                            <div class="row fileupload-buttonbar">
                                <div class="col-lg-7">
                                    <!-- The fileinput-button span is used to style the file input field as button -->
                                    <button type="button" class="btn btn-success fileinput-button">
                                        <i class="glyphicon glyphicon-plus"></i>
                                        <span>{{ __('form.files_add') }}...</span>
                                        <input type="file" name="files[]" accept="image/*" multiple>
                                    </button>
                                    <button type="submit" class="btn btn-primary start">
                                        <i class="glyphicon glyphicon-upload"></i>
                                        <span>{{ __('form.files_upload') }}</span>
                                    </button>
                                    <button type="reset" class="btn btn-warning cancel">
                                        <i class="glyphicon glyphicon-ban-circle"></i>
                                        <span>{{ __('form.files_upload_cancel') }}</span>
                                    </button>

                                    <!-- The global file processing state -->
                                    <span class="fileupload-process"></span>
                                </div>
                                <!-- The global progress state -->
                                <div class="col-lg-5 fileupload-progress">
                                    <!-- The global progress bar -->
                                    <div class="progress progress-striped active" role="progressbar"
                                         aria-valuemin="0"
                                         aria-valuemax="100">
                                        <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                    </div>
                                    <!-- The extended global progress state -->
                                    <div class="progress-extended">&nbsp;</div>
                                </div>
                            </div>
                            <!-- The table listing the files available for upload/download -->
                            <table role="presentation" class="table table-striped">
                                <tbody class="files"></tbody>
                            </table>
                        </form>

                        <div class="row image_galery">
                            @if(isset($gallery))
                                @foreach($gallery as $img)
                                    <div class="col-xs-12 col-sm-6 col-md-3 " id="list">
                                        <a href="{{asset('/images/conference/') . '/'.$data->id .'/large/' . $img->image}}"
                                           data-gallery>
                                            <img class="img-responsive m-b-sm" style="margin-bottom: 1em"
                                                 src="{!! asset('/images/conference/') . '/'.$data->id .'/sq/' . $img->image !!}">
                                        </a>
                                        <div class="img-overlay">
                                            <button data-img-button-id="{{$img->id}}"
                                                    class="btn btn-md btn-danger delete_image_btn"><i
                                                        class="fa fa-fw fa-trash"></i></button>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('page_css')
    <style>
        .fileinput-button {
            background-color: #38c172 !important;
        }

        .img-overlay {
            position: absolute;
            top: 0;
            bottom: 100%;
            left: Calc(100% - 59px);
            right: 0;
            max-width: 10%;
            text-align: left;
        }

        .img-overlay:before {
            content: ' ';
            display: block;
            /* adjust 'height' to position overlay content vertically */
            height: 80%;
        }

        .image-code {
            height: 350px;
        }

        .image-code pre {
            font-size: 10px;
            margin: 0;
            padding: 0.25em;
        }

        .hide {
            display: none;
        }

    </style>
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
        <link rel="stylesheet"
              href="{!! asset('js/jQuery-File-Upload/css/jquery.fileupload-ui-noscript.css') !!}">
    </noscript>
@stop

@section('scripts')

    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
    <script src="{!! asset('js/jQuery-File-Upload/js/vendor/jquery.ui.widget.js') !!}"></script>

    {{--<script src="{!! asset('js/jquery-ui-1.12.1/jquery-ui.js') !!}"></script>--}}

    <!-- The Templates plugin is included to render the upload/download listings -->
    <script src="https://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
    <script src="https://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
    <script src="https://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>

    <!-- blueimp Gallery script -->
    <script src="https://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="{!! asset('js/jQuery-File-Upload/js/jquery.iframe-transport.js' ) !!}"></script>

    <!-- The basic File Upload plugin -->
    <script src="{!! asset('js/jQuery-File-Upload/js/jquery.fileupload.js' ) !!}"></script>

    <!-- The File Upload processing plugin -->
    <script src="{!! asset('js/jQuery-File-Upload/js/jquery.fileupload-process.js' ) !!}"></script>

    <!-- The File Upload image preview & resize plugin -->
    <script src="{!! asset('js/jQuery-File-Upload/js/jquery.fileupload-image.js' ) !!}"></script>

    <!-- The File Upload validation plugin -->
    <script src="{!! asset('js/jQuery-File-Upload/js/jquery.fileupload-validate.js' ) !!}"></script>

    <!-- The File Upload user interface plugin -->
    <script src="{!! asset('js/jQuery-File-Upload/js/jquery.fileupload-ui.js' ) !!}"></script>

    <!-- The main application script -->
    <script src="{!! asset('js/jQuery-File-Upload/js/main.js' ) !!}"></script>

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
                        if (willDelete) {
                            $.ajax({
                                type: 'POST',
                                url: '{{ route("ajax") }}',
                                data: {
                                    action: "delete_proceedings_file",
                                    conf_id: {{$data->id}},
                                },
                                dataType: 'json',
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                success: function (ajax_data) {
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

            $('.delete_image_btn').click(function (e) {
                var id = $(e.currentTarget).attr("data-img-button-id");
                console.log(id);
                swal({
                    title: "Zmazať obrázok?",
                    text: "Táto operácia je nevratná!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                type: 'POST',
                                url: '{{ route("ajax") }}',
                                data: {
                                    action: 'delete_conference_image',
                                    image_id: id,
                                    conf_id: {!! $data->id !!}
                                },
                                dataType: 'json',
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                success: function (data) {
                                    console.log(data);
                                    if (data.status == 'OK') {
                                        toastr.success('Obrázok bol zmazaný.');
                                        window.location.reload(true);
                                    }
                                }
                            })
                        }
                    });
            });

        });

    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key={{env('GMAPS_API')}}&callback=initMap"
            async defer></script>

    <!-- The template to display files available for upload -->
    <script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}






    </script>

    <!-- The template to display files available for download -->
    <script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}





    </script>

@stop
