@if($contribution->review)
    <div class="col-12" style="padding-bottom: 1em">
        @if($contribution->review->approved == 1)
            <h3 class="text-success">
                                <span class="fa-layers fa-fw">
                                    <i class="fa fa-certificate" data-fa-transform="grow-16"></i>
                                    <i class="fa fa-check" style="color: #fff;"></i>
                                </span>
                &nbsp; <b>{{$contribution->review->rating}}</b>/5 &nbsp;Approved

                @elseif($contribution->review->approved == -1)
                    <h3 class="text-danger">
                                <span class="fa-layers fa-fw">
                                    <i class="fa fa-certificate" data-fa-transform="grow-16"></i>
                                    <i class="fa fa-times" style="color: #fff;"></i>
                                </span>
                        &nbsp;Not Approved

                        @else
                            <h3 class="text-muted">
                                <span class="fa-layers fa-fw">
                                    <i class="fa fa-certificate" data-fa-transform="grow-16"></i>
                                    <i class="fa fa-minus" style="color: #fff;"></i>
                                </span>
                                &nbsp;Not Rated

                                @endif
                                @if($contribution->review->reviewer->id == Auth::id() or Auth::user()->roles()->where('role_id', 1)->first())
                                    <a href="{{ route('review.myReview.edit', $contribution->review->id) }}"
                                       class="btn btn-success pull-right"><i
                                            class="fa fa-edit"></i> {{ __('main.edit') }}
                                    </a>
                                @endif
                            </h3>
    </div>
    <div class="col-1">
        @if($contribution->review->reviewer->profile->image)
            <img
                src="{{asset('public/images/profiles/'.$contribution->review->reviewer->profile->id."/".$contribution->review->reviewer->profile->image)}}"
                class="rounded-circle" width="100%" style="max-width: 50px;">
        @endif
    </div>
    <div class="col-8 col-sm-10">
        <p>
            <strong>{{$contribution->review->reviewer->profile->first_name." ".$contribution->review->reviewer->profile->last_name}}</strong>
            <br>{{\Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $contribution->review->reviewer->profile->updated_at)->format('d M, Y')}}
        </p>
    </div>
    <div class="col-12">
        {{$contribution->review->review}}
    </div>
@endif
