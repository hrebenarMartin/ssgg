@extends('backend.layouts.app')

@section('content')

    <div class="row pt-3 pd-3">
        <div class="col-12">
            <strong><h2 class="mb-4">{{ __('form.conference_gallery') }}</h2></strong>
            <form id="fileupload" action="{{ route('index') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}

            <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                <div class="row fileupload-buttonbar">
                    <div class="col-lg-7">
                        <!-- The fileinput-button span is used to style the file input field as button -->
                        <button type="button" class="btn btn-success fileinput-button">
                            <i class="glyphicon glyphicon-plus"></i>
                            <span>{{ __('form.files_add') }}...</span>
                            <input type="file" name="files[]" multiple>
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
                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
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
        </div>
    </div>
@stop

@section('page_css')
    <style>
        .fileinput-button {
            background-color: #38c172 !important;
        }

        .img-overlay {
            position: absolute;
            top: 0;
            bottom: -25px;
            left: 25px;
            right: 0;
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
        <link rel="stylesheet" href="{!! asset('js/jQuery-File-Upload/css/jquery.fileupload-ui-noscript.css') !!}">
    </noscript>
@stop

@section('scripts')

    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
    {{--<script src="{!! asset('js/jQuery-File-Upload/js/vendor/jquery.ui.widget.js') !!}"></script>--}}

    <script src="{!! asset('js/jquery-ui-1.12.1/jquery-ui.js') !!}"></script>

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

    <!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
    <!--[if (gte IE 8)&(lt IE 10)]>
    <script src="{!! asset('js/jQuery-File-Upload/js/cors/jquery.xdr-transport.js' ) !!}"></script>
    <![endif]-->


    {{--<script>
        // callback ak su vsetky obrazky uploadovane
        $('#fileupload').bind('fileuploadstop', function (e, data) {
            toastr.success('success upload');
            //$('.image_galery').empty();
            //vymazeme zabulku a zobrazime galeriu fotografii
            $('[role="presentation"]').remove();
            $.ajax({
                type: 'POST',
                url: '/ajax/function',
                data: {
                    action: 'get_block_images',
                    block: 6
                },
                dataType: 'json',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    //console.log(data);
                    //vyprazdnime galeriu
                    if (data.status == 'OK') {
                        toastr.success('');
                    }
                    window.location.reload(true);
                }
            });
        });
    </script>--}}

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
