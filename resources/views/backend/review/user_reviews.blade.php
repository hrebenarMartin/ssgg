@extends('backend.layouts.app')

@section('title', __('titles.my_reviews'))

@section('content')

    <div class="col-md-12">

        <div class="container">
            <div class="d-flex flex-row-reverse">
                <div class="p-1">
                    <a href="{{ route('dashboard.index') }}" class="btn btn-primary"><i
                            class="fa fa-fw fa-chevron-circle-left"></i> {{ __('form.action_dashboard') }}</a>
                </div>
            </div>
        </div>

        <hr>

        <div class="card">
            <div class="card-header">
                <strong class="card-title">{{ __('form.conference_listing') }}</strong>
            </div>
            <div class="card-body">
                @include('backend.review.components.new_table')
                <hr>
                @include('backend.review.components.accepted_table')
            </div>
        </div>
    </div>

@stop

@section('scripts')
    <script>

        $(document).ready(function () {

            $('.delete-alert').click(function (e) {
                var id = $(e.currentTarget).attr("data-item-id");
                swal({
                    title: "DANGER ZONE! Are you sure you want to proceed?",
                    text: "Once confirmed, this contribution will be erased from the existence.",
                    icon: "error",
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
