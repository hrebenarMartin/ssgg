@extends('backend.layouts.app')

@section('title', __('titles.conference_listing'))

@section('content')

    <div class="col-md-12">

        <div class="container">
            <div class="d-flex flex-row-reverse">
                <div class="p-1">
                    <a href="{{ route('admin.conferences.create') }}" class="btn btn-success">{{ __('form.action_create_conference') }}</a>
                    <a href="{{ route('dashboard.index') }}" class="btn btn-primary"><i class="fa fa-chevron-circle-left"></i> {{ __('form.action_dashboard') }}</a>
                </div>
            </div>
        </div>

        <hr>

        <div class="card">
            <div class="card-header">
                <strong class="card-title">{{ __('form.conference_listing') }}</strong>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">{{ __('form.conference_year') }}</th>
                        <th scope="col">{{ __('form.conference_status') }}</th>
                        <th scope="col">{{ __('form.conference_conference_dates') }}</th>
                        <th scope="col">{{ __('form.conference_status_change') }}</th>
                        <th scope="col" style="width:20%;">{{ __('form.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($conferences as $conference)
                        <tr class="text-center">
                            <th scope="row">{{ $conference->id }}</th>
                            <td>{{ $conference->year }}</td>
                            <td>
                                <span id="conf_stat_{{$conference->id}}" class="badge @if($conference->status == 1) badge-success @elseif($conference->status == 2) badge-danger @else badge-primary @endif">
                                    <i class="fa @if($conference->status == 1) fa-check-circle @elseif($conference->status == 2) fa-minus-circle @else fa-download @endif"></i>
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d',$conference->conference_start)->format('d M,Y')." - ".\Carbon\Carbon::createFromFormat('Y-m-d',$conference->conference_end)->format('d M,Y') }}</td>
                            <th>
                                <a href="#!" class="conf_stat_change" data-id="1" data-conf="{{$conference->id}}">
                                    <span class="badge badge-success"><i class="fa fa-check-circle"></i></span>
                                </a>
                                <a href="#!" class="conf_stat_change" data-id="2" data-conf="{{$conference->id}}">
                                    <span class="badge badge-danger"><i class="fa fa-minus-circle"></i></span>
                                </a>
                                <a href="#!" class="conf_stat_change" data-id="3" data-conf="{{$conference->id}}">
                                    <span class="badge badge-primary"><i class="fa fa-download"></i></span>
                                </a>
                            </th>
                            <td>
                                <a href="#!" data-item-id="{{ $conference->id }}" class="btn btn-danger btn-sm listing_controls pull-right delete-alert"><i class="fa fa-times"></i></a>
                                {{ Form::open(['method' => 'DELETE', 'route' => ['admin.conferences.destroy', $conference->id ],
                                        'id' => 'item-del-'. $conference->id  ])
                                    }}
                                {{ Form::hidden('conference_id', $conference->id) }}
                                {{ Form::close() }}

                                <a href="{{ route('admin.conferences.edit', $conference->id) }}" class="btn btn-success btn-sm listing_controls pull-right"><i class="fa fa-edit"></i></a>
                                <a href="{{ route('admin.conferences.show', $conference->id) }}" class="btn btn-primary btn-sm listing_controls pull-right"><i class="fa fa-search"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
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
                    title: "DANGER ZONE! Are you sure you want to proceed?",
                    text: "Once confirmed, everything connected to this conference will be permanently deleted! (pages, content, images, contributions, etc.)",
                    icon: "error",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if(willDelete){
                            document.getElementById('item-del-'+id).submit();
                        }
                    });
            });

            $('.conf_stat_change').click(function () {
                var stat = $(this).data('id');
                var conf = $(this).data('conf');
                $.ajax({
                    type:'POST',
                    url:'/ajax',
                    data: {
                        action: "conference_stat_change",
                        conf_id: conf,
                        conf_stat: stat,
                    },
                    dataType: 'json',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success:function(ajax_data){
                        console.log(ajax_data);
                        if(ajax_data['status'] === 'OK'){
                            let tmp = ajax_data['changed_to'];
                            let conf_stat_span = $('#conf_stat_'+conf);
                            if(tmp == 1){
                                conf_stat_span.attr('class', 'badge badge-success');
                                conf_stat_span.find('i').attr('class', 'fa fa-check-circle');
                                toastr.success("Status changed to OPEN")
                            }
                            else if(tmp == 2){
                                conf_stat_span.attr('class', 'badge badge-danger');
                                conf_stat_span.find('i').attr('class', 'fa fa-minus-circle');
                                toastr.success("Status changed to CLOSED")
                            }
                            else{
                                conf_stat_span.attr('class', 'badge badge-primary');
                                conf_stat_span.find('i').attr('class', 'fa fa-download');
                                toastr.success("Status changed to ARCHIVED")
                            }
                        }
                        else{
                            toastr.error(ajax_data['msg'])
                        }
                    },
                    error: function () {
                        toastr.error("Oops, something bad happened")
                    }
                })
            })

        })

    </script>
@stop