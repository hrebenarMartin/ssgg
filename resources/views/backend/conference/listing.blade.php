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
                        <th scope="col">{{ __('form.conference_start') }}</th>
                        <th scope="col">{{ __('form.conference_end') }}</th>
                        <th scope="col">{{ __('form.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($conferences as $conference)
                        <tr class="text-center">
                            <th scope="row">{{ $conference->id }}</th>
                            <td>{{ $conference->year }}</td>
                            <td>
                                @if($conference->status == 1) <span class="badge badge-success"><i class="fa fa-check"></i></span>
                                @elseif($conference->status == 2) <span class="badge badge-warning"><i class="fa fa-minus-circle"></i></span>
                                @else <span class="badge badge-primary"><i class="fa fa-store"></i></span>
                                @endif
                            </td>
                            <td>{{ $conference->conference_start }}</td>
                            <td>{{ $conference->conference_end }}</td>
                            <td>
                                <a href="#!" class="btn btn-danger btn-sm listing_controls pull-right"><i class="fa fa-times"></i></a>
                                <a href="{{ route('admin.conferences.edit', $conference->id) }}" class="btn btn-warning btn-sm listing_controls pull-right"><i class="fa fa-edit"></i></a>
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
