@extends('backend.layouts.app')

@section('title', __('titles.user_listing'))

@section('content')

    <div class="col-md-12">
        <div class="container">
            <div class="d-flex flex-row-reverse">
                <div class="p-1">
                    <a href="{{ route('admin.user.create') }}"
                       class="btn btn-success">{{ __('form.action_user_create') }}</a>
                    <a href="{{ route('dashboard.index') }}" class="btn btn-primary"><i
                                class="fa fa-chevron-circle-left"></i> {{ __('form.action_dashboard') }}</a>
                </div>
            </div>
        </div>

        <hr>

        <div class="card">
            <div class="card-header">
                <strong class="card-title">{{ __('form.user_listing') }}</strong>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('form.profile_first_name') }}</th>
                        <th scope="col">{{ __('form.email') }}</th>
                        <th scope="col">{{ __('form.roles') }}</th>
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
                                <small>
                                    @foreach(App\User::find($user->id)->roles as $r)
                                        @if($r->id == 1)
                                            {{__('main.superadmin')}} |
                                        @elseif($r->id == 3)
                                            {{__('main.admin')}} |
                                        @elseif($r->id == 4)
                                            {{__('main.reviewer')}} |
                                        @endif
                                    @endforeach {{__('main.reguser')}}
                                </small>
                            </td>
                            <td>
                                @if(Auth::id() != $user->id and $user->id != 9999)
                                    <a href="#!" data-item-id="{{$user->id}}"
                                       class="btn btn-danger btn-sm listing_controls pull-right delete-alert"><i
                                                class="fa fa-times"></i></a>
                                    <div style="display: none">
                                        {{ Form::open(['method' => 'DELETE', 'route' => ['admin.user.destroy', $user->id ],
                                        'id' => 'item-del-'. $user->id  ])}}
                                        {{ Form::hidden('user_id', $user->id) }}
                                        {{ Form::close() }}
                                    </div>
                                @endif
                                <a href="{{route('admin.user.edit', $user->id)}}"
                                   class="btn btn-warning btn-sm listing_controls pull-right"><i
                                            class="fa fa-edit"></i></a>
                                <a href="{{route('user.profile.show', $user->id)}}"
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

@endsection

@section('scripts')
    <script>

        $(document).ready(function () {

            $('.delete-alert').click(function (e) {
                var id = $(e.currentTarget).attr("data-item-id");
                swal({
                    title: "Are you sure?",
                    text: "You are about to delete this user!",
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
