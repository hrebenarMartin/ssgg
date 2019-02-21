<div class="col-lg-6 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">{{ __('form.cms_menu_ssgg') }}</strong>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('form.cms_menu_title_sk') }}</th>
                    <th scope="col">{{ __('form.cms_menu_route') }}</th>
                    <th scope="col" style="width:20%;" class="text-right">{{ __('form.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @if (isset($menu_ssgg))

                    @foreach($menu_ssgg as $menu)
                        <tr>
                            <th scope="row">{{ $menu->id }}</th>
                            <td>{{ $menu->name_sk }}</td>
                            <td>{{ $menu->route }}</td>
                            <td>
                                <a href="#!" data-item-id="{{ $menu->id }}" class="btn btn-danger btn-sm listing_controls pull-right delete-alert"><i class="fa fa-trash-o"></i></a>
                                {{ Form::open(['method' => 'DELETE', 'route' => ['admin.front_menu.destroy', $menu->id ],
                                    'id' => 'item-del-'. $menu->id  ])
                                }}
                                {{ Form::hidden('page_id', $menu->id) }}
                                {{ Form::close() }}

                                <a href="{{ route('admin.front_menu.edit', $menu->id) }}" class="btn btn-primary btn-sm listing_controls pull-right"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
