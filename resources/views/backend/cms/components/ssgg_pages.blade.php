<div class="col-lg-6 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">{{ __('form.cms_pages_ssgg') }}</strong>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('form.cms_page_title') }}</th>
                    <th scope="col">{{ __('form.cms_page_alias') }}</th>
                    <th scope="col" class="text-right">{{ __('form.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @if (isset($pages_ssgg))

                    @foreach($pages_ssgg as $page)
                        <tr>
                            <th scope="row">{{ $page->id }}</th>
                            <td>{{ $page->title }}</td>
                            <td>{{ $page->alias }}</td>
                            <td>
                                <a href="#!" data-item-id="{{ $page->id }}" class="btn btn-danger btn-sm listing_controls pull-right delete-alert"><i class="fa fa-trash-o"></i></a>
                                {{ Form::open(['method' => 'DELETE', 'route' => ['admin.cms.destroy', $page->id ],
                                    'id' => 'item-del-'. $page->id  ])
                                }}
                                {{ Form::hidden('page_id', $page->id) }}
                                {{ Form::close() }}

                                <a href="{{ route('admin.content.show', $page->id) }}" class="btn btn-success btn-sm listing_controls pull-right"><i class="fa fa-list"></i></a>
                                <a href="{{ route('admin.cms.edit', $page->id) }}" class="btn btn-primary btn-sm listing_controls pull-right"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
