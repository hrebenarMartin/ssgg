<h3>{{ __('review.new_reviews') }}</h3>
<table class="table table-striped" id="new_table">
    <thead>
    <tr class="text-center">
        <th scope="col">#</th>
        <th scope="col">{{ __('form.contribution_title') }}</th>
        <th scope="col">{{ __('contribution.author') }}</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    @foreach($new as $i)
        <tr class="text-center">
            <th scope="row">{{ $i->id }}</th>
            <td>{{ substr($i->contribution->title, 0, 40)."..."}}</td>
            <td>{{ $i->contribution->author->profile->first_name }}
                {{ $i->contribution->author->profile->last_name }}</td>
            <td>
                <a href="{{ route('review.myReview.show', $i->id) }}"
                   class="btn btn-primary btn-sm listing_controls pull-right">
                    <i class="fa fa-fw fa-search"></i>
                </a>
                <a href="{{ route('review.accept', $i->id) }}" class="btn btn-success btn-sm listing_controls pull-right">
                    <i class="fa fa-fw fa-check"></i> {{ __('review.accept') }}
                </a>
                <a href="{{ route('review.reject', $i->id) }}" class="btn btn-danger btn-sm listing_controls pull-right">
                    <i class="fa fa-fw fa-times"></i> {{ __('review.reject') }}
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
