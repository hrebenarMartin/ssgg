@extends('layouts.app')

@section('title', 'Archiv '.$data->year." | SSGG")

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

    <section class="section section-lg section-shaped pb-100">
        <div class="shape shape-style-3 shape-default">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="container py-lg-md d-flex text-center">
            <div class="col px-0">
                <div class="row">
                    <div class="col-12">
                        <h1 class="display-1 text-white">
                            @if(App::getLocale() == 'en')SCG Archive
                            @else Archív SCG
                            @endif
                        </h1>
                        <hr>
                    </div>
                    <div class="col-lg-12">
                        <h1 class="display-3 text-white">
                            @if(App::getLocale() == 'en'){{ $data->title_en }}
                            @else {{ $data->title_sk }}
                            @endif
                        </h1>
                    </div>
                    <div class="col-12">
                        <h1 class="display-3 text-white">
                            {{ $data->year }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- SVG separator -->
        <div class="separator separator-bottom separator-skew">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
                 xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </section>
    <!-- 1st Hero Variation -->

    <section>

        <div class="container shape-container d-flex bg-">
            <div class="col px-0">
                <div class="row justify-content-center">
                    <div class="col-12 text-center pt-4">
                        <h1>
                            {{ \Carbon\Carbon::createFromFormat("Y-m-d",$data->conference_start)->format('d M') }}
                            -
                            {{ \Carbon\Carbon::createFromFormat("Y-m-d",$data->conference_end)->format('d M, Y') }}
                        </h1>
                        <h1>
                            {{ $data->address_place.", ".$data->address_city.", ".$data->country->abbr }}
                        </h1>
                    </div>
                    <div class="col-12 py-3"></div>
                    @if($data->proceedings_file)
                        <div class="col-xs-12 col-sm-6 text-center">
                            <a href="#!" class="btn btn-lg btn-outline-primary">
                                {{ __('form.conference_proceedings_file') }}
                            </a>
                        </div>
                        <div class="col-12 py-3"></div>
                    @endif
                    <div class="col-12 text-center">
                        <h1>{{ __('form.conference_gallery') }}</h1>
                    </div>
                    <div class="col-12">
                        <div class="row justify-content-center">
                            <div class="row image_galery">
                                @foreach($data->gallery as $p)
                                    <div class="col-xs-6 col-sm-3">
                                        <a href="{{asset('/images/conference/') . '/'.$data->id .'/large/' . $p->image}}"
                                           data-gallery>
                                            <img class="img-responsive py-1 px-1"
                                                 src="{!! asset('/images/conference/') . '/'.$data->id .'/sq/' . $p->image !!}" width="100%">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

@section('page_css')
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
@stop

@section('page_scripts')
    <!-- blueimp Gallery script -->
    <script src="https://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
@stop
