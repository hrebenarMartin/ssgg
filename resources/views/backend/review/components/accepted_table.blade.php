<h3>Accepted reviews</h3>
<table class="table table-striped" id="accepted_table">
    <thead>
    <tr class="text-center">
        <th scope="col">#</th>
        <th scope="col">{{ __('review.contribution_title') }}</th>
        <th scope="col">{{ __('review.contribution_author') }}</th>
        <th scope="col">{{ __('review.my_rating') }}</th>
        <th scope="col">{{ __('review.approval') }}</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    @foreach($accepted as $i)
        <tr class="text-center">
            <th scope="row">{{ $i->id }}</th>
            <td>{{ substr($i->contribution->title, 0, 40)."..."}}</td>
            <td>{{ $i->contribution->author->profile->first_name }}
                {{ $i->contribution->author->profile->last_name }}</td>
            <td>{{ $i->rating }}</td>
            <td>@if($i->approved == 1)
                    <strong class="text-success">{{ __('review.approved') }}</strong>
                @elseif($i->approved == -1)
                    <strong class="text-danger">{{ __('review.rejected') }}</strong>
                @else
                    <strong class="text-muted">{{ __('review.in_progress') }}</strong>
                @endif
            </td>
            <td>
                <a href="{{ route('review.myReview.show', $i->id) }}"
                   class="btn btn-primary btn-sm listing_controls pull-right">
                    <i class="fa fa-search"></i>
                </a>
                <a href="{{ route('review.myReview.edit', $i->id) }}"
                   class="btn btn-success btn-sm listing_controls pull-right"><i class="fa fa-edit"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
