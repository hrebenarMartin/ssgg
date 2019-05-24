<div class="row">
    <div class="col-2">
        <strong>{{ __('form.contribution_title') }}:</strong>
    </div>
    <div class="col-10">
        {{ $contribution->title }}
    </div>
</div>

<div class="row" style="padding-top: 1em">
    <div class="col-2">
        <strong>{{ __('form.contribution_co_authors') }}:</strong>
    </div>
    <div class="col-10">
        {{ $contribution->co_authors }}
    </div>
</div>

<div class="row" style="padding-top: 1em">
    <div class="col-2">
        <strong>{{ __('form.contribution_type') }}:</strong>
    </div>
    <div class="col-10">
        @if($contribution->type == 1){{ __('form.contribution_type1') }}
        @else{{ __('form.contribution_type2') }}
        @endif
    </div>
</div>

<div class="row" style="padding-top: 1em">
    <div class="col-2">
        <strong>{{ __('form.contribution_abstract') }}:</strong>
    </div>
    <div class="col-10">
        {{ $contribution->abstract }}
    </div>
</div>

<div class="row" style="padding-top: 1em">
    <div class="col-2">
        <strong>{{ __('contribution.contribution_file') }}:</strong>
    </div>
    <div class="col-10">
        <a href="{{ route('user.myContribution.download', $contribution->id) }}"
           class="btn btn-outline-primary">{{ __('contribution.download_document') }}</a>
    </div>
</div>
