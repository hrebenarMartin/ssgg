@extends('backend.layouts.app')

@section('title', __('titles.user_listing'))

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">{{ __('form.user_listing') }}</strong>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('form.user_name') }}</th>
                        <th scope="col">{{ __('form.user_email') }}</th>
                        <th scope="col" class="text-right">{{ __('form.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="#" class="btn btn-danger btn-sm listing_controls pull-right"><i class="fa fa-times"></i></a>
                            <a href="#" class="btn btn-warning btn-sm listing_controls pull-right"><i class="fa fa-edit"></i></a>
                            <a href="#" class="btn btn-primary btn-sm listing_controls pull-right"><i class="fa fa-search"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
