@extends('backend.layouts.app')

@section('title', "CMS")

@section('content')

    <div class="col col-sm-12">
        <div class="container">
            <div class="d-flex flex-row-reverse">
                <div class="p-1">
                    <a href="{{ route('dashboard.index') }}"
                       class="btn btn-primary">{{ __('form.action_dashboard') }}</a>
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
                        <a href="{{ route('admin.front_menu.create') }}"
                           class="btn btn-success">{{ __('form.action_create_menu') }}</a>
                    </div>
                </div>
            </div>
            @include('backend.cms.components.ssgg_menu')

            @include('backend.cms.components.conference_menu')

            <div class="col-12">
                <div class="alert alert-info fade show" role="alert">
                    <div class="row">
                        <div class="col-sm-12">
                            <i class="fa fa-lightbulb fa-fw"></i> CMS správa menu položiek (odkazy na vrchnej navigačnej lište)
                        </div>
                    </div>
                    <div class="row py-1">
                        <div class="col-sm-1">
                            <button type="button" class="btn btn-sm btn-primary pull-right"><i class="fa fa-fw fa-edit"></i>
                            </button>
                        </div>
                        <div class="col-sm-11">
                            - Editácia menu položky
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1">
                            <button type="button" class="btn btn-sm btn-danger pull-right"><i class="fa fa-fw fa-trash"></i>
                            </button>
                        </div>
                        <div class="col-sm-11">
                            - Zmazanie menu položky
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col col-sm-12">
        <hr>
        <div class="row">
            <div class="col col-6">
                <h3>{{ __('titles.pages') }}</h3>
            </div>
            <div class="col col-6">
                <div class="d-flex flex-row-reverse">
                    <div class="p-1">
                        <a href="{{ route('admin.cms.create') }}"
                           class="btn btn-success">{{ __('form.action_create_page') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <p></p>
            </div>
            @include('backend.cms.components.ssgg_pages')

            @include('backend.cms.components.conference_pages')
            <div class="col-12">
                <div class="alert alert-info fade show" role="alert">
                    <div class="row">
                        <div class="col-sm-12">
                            <i class="fa fa-lightbulb fa-fw"></i> CMS správa stránok
                        </div>
                    </div>
                    <div class="row py-1">
                        <div class="col-sm-1">
                            <button type="button" class="btn btn-sm btn-primary pull-right"><i class="fa fa-fw fa-edit"></i>
                            </button>
                        </div>
                        <div class="col-sm-11">
                            - Editácia názvu a základného info stránky
                        </div>
                    </div>
                    <div class="row py-1">
                        <div class="col-sm-1">
                            <button type="button" class="btn btn-sm btn-success pull-right"><i class="fa fa-fw fa-list"></i>
                            </button>
                        </div>
                        <div class="col-sm-11">
                            - Zoznam obsahových blokov stránky
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1">
                            <button type="button" class="btn btn-sm btn-danger pull-right"><i class="fa fa-fw fa-trash"></i>
                            </button>
                        </div>
                        <div class="col-sm-11">
                            - Zmazanie stránky (a jej obsahu)
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                        if (willDelete) {
                            document.getElementById('item-del-' + id).submit();
                        }
                    });
            });

        })

    </script>
@stop
