@extends('backend.layouts.app')

@section('title', __('titles.user_contribution'))

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
                {{ __('titles.my_contribution') }}
            </div>
            @if(isset($no_conference))
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2>{{ __('messages.no_conference_in_progress') }}</h2>
                        </div>
                    </div>
                </div>
            @else
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h3>{{ __('contribution.contribution_requirements') }}</h3>
                            <div class="col-12 text-center text-danger" style="padding: 0.5em;">
                                <u><h2>{{ __('contribution.contribution_deadline', ['date' => $deadline]) }}</h2></u>
                            </div>
                            <div class="col-11 offset-1" style="padding-top: 1em">
                                <ul>
                                    <li>{!! __('contribution.contribution_requirement_1') !!}</li>
                                    <li>{!! __('contribution.contribution_requirement_2') !!}</li>
                                    <li>{!! __('contribution.contribution_requirement_3') !!}</li>
                                    <li>{!! __('contribution.contribution_requirement_4') !!}</li>
                                    <li>{!! __('contribution.contribution_requirement_5') !!}</li>
                                </ul>
                            </div>
                            <h4>{{ __('contribution.contribution_templates') }}</h4>
                            <hr>
                        </div>
                        <div class="col-sm-6 col-md-6 text-sm-center col-lg-2">
                            <a href="{{ route('user.myContribution.download_template', 1) }}"
                               class="btn btn-outline-primary animated fadeInDown">Slovensky - Word</a>
                        </div>
                        <div class="col-sm-6 col-md-6 text-md-center col-lg-2">
                            <a href="{{ route('user.myContribution.download_template', 2) }}"
                               class="btn btn-outline-primary animated fadeInDown">Slovensky - Tex</a>
                        </div>
                        <div class="col-sm-6 col-md-6 text-md-center col-lg-2">
                            <a href="{{ route('user.myContribution.download_template', 3) }}"
                               class="btn btn-outline-danger animated fadeInDown">Česky - Word</a>
                        </div>
                        <div class="col-sm-6 col-md-6 text-md-center col-lg-2">
                            <a href="{{ route('user.myContribution.download_template', 4) }}"
                               class="btn btn-outline-danger animated fadeInDown">Česky - Tex</a>
                        </div>
                        <div class="col-sm-6 col-md-6 text-md-center col-lg-2">
                            <a href="{{ route('user.myContribution.download_template', 5) }}"
                               class="btn btn-outline-success animated fadeInDown">English - Word</a>
                        </div>
                        <div class="col-sm-6 col-md-6 text-md-center col-lg-2">
                            <a href="{{ route('user.myContribution.download_template', 6) }}"
                               class="btn btn-outline-success animated fadeInDown">English - Tex</a>
                        </div>
                    </div>
                    <div class="space-30">
                        <hr>
                    </div>

                    @if(isset($no_contribution))
                        <div class="row">
                            <div class="col-6 offset-3">
                                <a href="{{ route('user.myContribution.create') }}"
                                   class="btn btn-lg btn-block btn-success"
                                   style="padding: 1em 0">{{ __('contribution.upload') }}</a>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-6">
                                <h2>My contribution details</h2>
                            </div>
                            <div class="col-6 text-right">
                                <a href="{{ route('user.myContribution.edit', $contribution->id) }}"
                                   class="btn btn-success"><i
                                        class="far fa-edit"></i> {{ __('titles.edit_contribution') }}</a>

                               {{--<a href="#!" data-item-id="{{ $contribution->id }}"
                                   class="btn btn-danger delete-alert"><i
                                        class="far fa-trash-alt"></i> {{ __('titles.delete_contribution') }}</a>

                                {{ Form::open(['method' => 'DELETE', 'route' => ['user.myContribution.destroy',$contribution->id ],
                                    'class' => 'class="btn btn-danger delete-alert hide',
                                    'id' => 'item-del-'. $contribution->id  ])
                                }}
                                {{ Form::hidden('contribution_id', $contribution->id) }}
                                {{ Form::close() }}--}}
                            </div>
                        </div>

                        <br>

                        @include('backend.contribution.components.contribution_detail')

                        <hr>

                        <div class="row">
                            <div class="col-2">
                                <strong>{{ __('contribution.review') }}:</strong>
                            </div>
                            <div class="col-10">
                                @include('backend.contribution.components.review')
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-2">
                                <strong>{{ __('main.comments') }}:</strong>
                            </div>
                            <div class="col-10">
                                @foreach($comments as $c)
                                    @include('backend.contribution.components.comment')
                                @endforeach
                            </div>
                        </div>

                    @endif
                </div>
            @endif
        </div>


    </div>

@endsection

@section('scripts')
    <script>
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
    </script>
@endsection
