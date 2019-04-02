<div class="modal fade" id="assign_reviewer" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{ __('contribution.assign_reviewer') }}</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-md-4 text-xs-left text-right">
                        <label class="col-form-label">{{ __('contribution.reviewer') }}:</label>
                    </div>
                    <div class="col-xs-12 col-md-8">
                        <form id="reviewer_assign_form" method="POST"
                              action="{{ route('admin.contributions.assignReviewer', $contribution->id) }}">
                            @csrf
                            <select id="rev" name="rev" class="form-control" required>
                                <option value="_" selected
                                        disabled>{{ __('main.choose_option') }}</option>
                                @foreach($reviewers as $r)
                                    <option value="{{ $r->id }}">
                                        {{ "(#".$r->id.") "}}
                                        {{$r->profile->first_name." ".$r->profile->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" form="reviewer_assign_form"
                        class="btn btn-success">{{ __('contribution.review_invite') }}</button>
                <button class="btn btn-danger pull-right"
                        data-dismiss="modal">{{ __('main.close') }}</button>
            </div>
        </div>
    </div>
</div>
