@extends('backend.layouts.app')

@section('title', __('titles.cms_pages'))

@section('content')

    <div class="col col-sm-12">
        <div class="container">
            <div class="d-flex flex-row-reverse">
                <div class="p-1">
                    <a href="{{ route('dashboard.index') }}" class="btn btn-primary">{{ __('form.action_dashboard') }}</a>
                </div>
            </div>
        </div>
        <hr>
    </div>
    <div class="col col-sm-12">
        <div class="row">
            <div class="col col-6">
                <h3>Frontend menu</h3>
            </div>
            <div class="col col-6">
                <div class="d-flex flex-row-reverse">
                    <div class="p-1">
                        <a href="{{ route('admin.front_menu.create') }}" class="btn btn-success">{{ __('form.action_create_menu') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <p></p>
            </div>
            @include('backend.cms.components.ssgg_menu')

            @include('backend.cms.components.conference_menu')
        </div>
    </div>
    <div class="col col-sm-12">
        <hr>
        <div class="row">
            <div class="col col-6">
                <h3>Pages</h3>
            </div>
            <div class="col col-6">
                <div class="d-flex flex-row-reverse">
                    <div class="p-1">
                        <a href="{{ route('admin.cms.create') }}" class="btn btn-success">{{ __('form.action_create_page') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <p></p>
            </div>
            @include('backend.cms.components.ssgg_pages')

            @include('backend.cms.components.conference_pages')
        </div>
    </div>


@endsection

@section('scripts')
    <script>

        $(document).ready(function () {

            $('.delete-alert').click(function (e) {
                var id = $(e.currentTarget).attr("data-item-id");
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this Page!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if(willDelete){
                            document.getElementById('item-del-'+id).submit();
                        }
                    });
            });

        })

    </script>
@stop
