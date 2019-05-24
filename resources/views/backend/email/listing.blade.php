@extends('backend.layouts.app')

@section('content')
    <div class="col-md-12">

        <div class="container">
            <div class="d-flex flex-row-reverse">
                <div class="p-1">
                    <a href="{{ route('dashboard.index') }}" class="btn btn-primary"><i
                                class="fa fa-chevron-circle-left"></i> {{ __('form.action_dashboard') }}</a>
                </div>
            </div>
        </div>

        <hr>

        <div class="card">
            <div class="card-header">
                <strong class="card-title">{{ __('form.email') }}</strong>
            </div>
            <div class="card-body">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">{{ __('email.recipients') }}</th>
                        <th scope="col">{{ __('email.module') }}</th>
                        <th scope="col">{{ __('email.send_time') }}</th>
                        <th scope="col">{{ __('form.conference_status') }}</th>
                        <th scope="col">{{ __('form.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($emails as $em)
                        <tr class="text-center">
                            <th scope="row">
                                <small>(#{{ $em->id }})</small>
                            </th>
                            <th scope="row">
                                <small>{{ $em->recipients }}</small>
                            </th>
                            <th scope="row">
                                <small>{{ $em->module }}</small>
                            </th>
                            <th scope="row">
                                <small>{{ $em->send_time }}</small>
                            </th>
                            <td>
                                @if($em->status == 0)
                                    <span class="badge badge-danger"><i class="fa fa-minus fa-fw"></i></span>
                                @else
                                    <span class="badge badge-success"><i class="fa fa-check fa-fw"></i></span>
                                @endif
                            </td>
                            <td>
                                <a href="#!" data-item-id="{{ $em->id }}"
                                   class="btn btn-danger btn-sm listing_controls pull-right delete-alert"><i
                                            class="fa fa-times fa-fw"></i></a>
                                {{ Form::open(['method' => 'DELETE', 'route' => ['admin.email-queue.destroy', $em->id ],
                                        'id' => 'item-del-'. $em->id  ])
                                    }}
                                {{ Form::hidden('email_id', $em->id) }}
                                {{ Form::close() }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
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
                    text: "Email will be deleted from queue.",
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