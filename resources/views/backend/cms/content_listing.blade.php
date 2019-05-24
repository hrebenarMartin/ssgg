@extends('backend.layouts.app')

@section('title', __('titles.cms_ssgg_page_content'))

@section('content')

    <div class="col-md-12">
        <div class="container">
            <div class="d-flex flex-row-reverse">
                <div class="p-1">
                    <a href="{{ route('admin.content.createForPage', $page_id) }}"
                       class="btn btn-success">{{ __('form.action_create_content') }}</a>
                    <a href="{{ route('admin.cms.index') }}" class="btn btn-primary"><i
                                class="fa fa-chevron-circle-left"></i> {{ __('form.action_back') }}</a>
                </div>
            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-header">
                <strong class="card-title">{{ __('form.cms_page_blocks') }}</strong>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('form.cms_block_title') }}</th>
                        <th scope="col">{{ __('form.cms_block_type') }}</th>
                        <th scope="col">{{ __('form.cms_block_content') }}</th>
                        <th scope="col" style="width:20%;" class="text-right">{{ __('form.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($blocks))

                        @foreach($blocks as $block)
                            <tr>
                                <th scope="row">{{ $block->id }}</th>
                                <td>{{ $block->title }}</td>
                                <td>{{ $block->type }}</td>
                                <td>{{ substr($block->content,0, 250) }}...</td>
                                <td>
                                    <a href="#!" data-item-id="{{ $block->id }}"
                                       class="btn btn-danger btn-sm listing_controls pull-right delete-alert"><i
                                                class="fa fa-trash"></i></a>
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['admin.content.destroy', $block->id ],
                                        'id' => 'item-del-'. $block->id  ])
                                    }}
                                    {{ Form::hidden('page_id', $block->id) }}
                                    {{ Form::close() }}

                                    <a href="{{ route('admin.content.edit', $block->id) }}"
                                       class="btn btn-primary btn-sm listing_controls pull-right"><i
                                                class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
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
