@extends('backend.layouts.app')

@section('title', "Príspevky")

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
                <strong class="card-title">{{ __('form.contribution_listing') }}</strong>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="item_table">
                    <thead>
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">{{ __('contribution.author') }}</th>
                        <th scope="col">{{ __('form.contribution_type') }}</th>
                        <th scope="col">{{ __('form.conference_year') }}</th>
                        <th scope="col">{{ __('review.rating') }}</th>
                        <th scope="col">{{ __('form.contribution_reviewer') }}</th>
                        <th scope="col">{{ __('form.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contributions as $c)
                        <tr class="text-center">
                            <th scope="row">{{ substr($c->abstract,0,150) }}...</th>
                            <td>{{ $c->author_first_name." ".$c->author_last_name }}</td>
                            <td>{{__('form.contribution_type'.$c->type)}}</td>
{{--                            <td>{{ $c->type == 1 ? __('form.contribution_type1') : __('form.contribution_type2')  }}</td>--}}
                            <td>{{ $c->conference_year }}</td>
                            <td>{{ $c->review ? $c->review->rating : "-" }}</td>
                            <td>
                                @if($c->review)
                                    @if($c->review->accepted == 0)
                                        <span class="badge badge-dark"><i class="fa fa-minus"></i></span>
                                    @elseif($c->review->accepted == -1)
                                        <span class="badge badge-danger"><i class="fa fa-times"></i></span>
                                    @else
                                        <span class="badge badge-success"><i class="fa fa-check"></i></span>
                                    @endif
                                    {{ substr($c->review->reviewer->profile->first_name,0,1)}}.
                                    {{ $c->review->reviewer->profile->last_name }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <a href="#!" data-item-id="{{ $c->id }}"
                                   class="btn btn-danger btn-sm listing_controls pull-right delete-alert"><i
                                        class="fa fa-times"></i></a>
                                {{ Form::open(['method' => 'DELETE', 'route' => ['admin.contributions.destroy', $c->id ],
                                        'id' => 'item-del-'. $c->id  ])
                                    }}
                                {{ Form::hidden('contribution_id', $c->id) }}
                                {{ Form::close() }}

                               {{-- <a href="{{ route('admin.contributions.edit', $c->id) }}"
                                   class="btn btn-success btn-sm listing_controls pull-right"><i class="fa fa-edit"></i></a>--}}
                                <a href="{{ route('admin.contributions.show', $c->id) }}"
                                   class="btn btn-primary btn-sm listing_controls pull-right"><i
                                        class="fa fa-search"></i></a>
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
        $('#item_table').DataTable({
            "pageLength": 25,
            "dom": 'lrfrtip',
            columnDefs : [
                { targets: 0, type: 'locale-compare' }
            ],
            "order": [0, 'asc']
        });

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
