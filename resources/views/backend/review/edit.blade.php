@extends('backend.layouts.app')

@section('title', __('titles.review_edit'))

@section('content')

    <div class="col-12">
        <div class="container">
            <div class="d-flex flex-row-reverse">
                <div class="p-1">
                    <a href="{{ route('review.myReview.show', $review->id) }}" class="btn btn-primary"><i
                            class="fa fa-fw fa-chevron-circle-left"></i> {{ __('form.action_back') }}</a>
                </div>
            </div>
        </div>

        <hr>

        <div class="card">
            <div class="card-header">
                <strong class="card-title">{{__('form.review_edit')}}</strong>
            </div>
            <div class="card-body">
                <form id="review_edit_form" method="POST" action="{{route('review.myReview.update', $review->id)}}">
                    @csrf
                    {{method_field('PUT')}}

                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="rating_val" class="col-form-label">{{ __('review.rating') }}:</label>
                        </div>
                        <div class="col-1">
                            <input type="text" id="rating_val" name="rating_val" class="form-control"
                                   @if($review->rating) value="{{ $review->rating }}" @endif
                                   readonly required>
                        </div>
                        <div class="col-7">
                            <button type="button" class="btn btn-danger rating_change" data-rating="1">
                                <span class="fa-layers fa-fw">
                                    <i class="fa fa-fw fa-star" data-fa-transform="grow-12"></i>
                                    <span class="fa-layers-text" style="color: #000;">1</span>
                                </span>
                            </button>
                            <button type="button" class="btn btn-warning rating_change" data-rating="2">
                                <span class="fa-layers fa-fw">
                                    <i class="fa fa-fw fa-star" data-fa-transform="grow-12"></i>
                                    <span class="fa-layers-text" style="color: #000;">2</span>
                                </span></button>
                            <button type="button" class="btn btn-info rating_change" data-rating="3">
                                <span class="fa-layers fa-fw">
                                    <i class="fa fa-fw fa-star" data-fa-transform="grow-12"></i>
                                    <span class="fa-layers-text" style="color: #000;">3</span>
                                </span>
                            </button>
                            <button type="button" class="btn btn-primary rating_change" data-rating="4">
                                <span class="fa-layers fa-fw">
                                    <i class="fa fa-fw fa-star" data-fa-transform="grow-12"></i>
                                    <span class="fa-layers-text" style="color: #000;">4</span>
                                </span>
                            </button>
                            <button type="button" class="btn btn-success rating_change" data-rating="5">
                                <span class="fa-layers fa-fw">
                                    <i class="fa fa-fw fa-star" data-fa-transform="grow-12"></i>
                                    <span class="fa-layers-text" style="color: #000;">5</span>
                                </span>
                            </button>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="approval" class="col-form-label">{{ __('review.approval') }}:</label>
                        </div>
                        <div class="col-3">
                            <select id="approval" name="approval" class="form-control" required>
                                <option value="" selected disabled>...</option>
                                <option value="1"
                                        @if($review->approved and $review->approved == 1) selected @endif>{{ __('review.approved') }}</option>
                                <option value="0"
                                        @if($review->approved and $review->approved == 0) selected @endif>{{ __('review.not_approved') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="comment" class="col-form-label">{{__('review.review')}}:</label>
                        </div>
                        <div class="col-7">
                            <textarea id="review" name="review" class="form-control" rows="6"
                                      required>{{$review->review}}</textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success pull-right"
                        form="review_edit_form">{{__('form.save')}}</button>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>

        $().ready(function () {

            $('.rating_change').click(function () {
                let value = $(this).attr('data-rating');
                $('#rating_val').val(value);
            });

            $('#review_edit_form').validate({
                rules: {
                   rating_val: "required",
                   approval: "required",
                   review: "required",
                }
            })


        })

    </script>
@stop
