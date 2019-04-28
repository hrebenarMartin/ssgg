@if($contribution->review)
    <div class="col-12" style="padding-bottom: 1em">
        @if($contribution->review->approved == 1)
            <h3 class="text-success">
                                <span class="fa-layers fa-fw">
                                    <i class="fa fa-fw fa-certificate" data-fa-transform="grow-16"></i>
                                    <i class="fa fa-fw fa-check" style="color: #fff;"></i>
                                </span>
                &nbsp; <b>{{$contribution->review->rating}}</b>/5 &nbsp;{{__('review.approved')}}

                @elseif($contribution->review->approved == -1)
                    <h3 class="text-danger">
                                <span class="fa-layers fa-fw">
                                    <i class="fa fa-fw fa-certificate" data-fa-transform="grow-16"></i>
                                    <i class="fa fa-fw fa-times" style="color: #fff;"></i>
                                </span>
                        &nbsp;{{ __('review.not_approved') }}

                        @else
                            <h3 class="text-muted">
                                <span class="fa-layers fa-fw">
                                    <i class="fa fa-fw fa-certificate" data-fa-transform="grow-16"></i>
                                    <i class="fa fa-fw fa-minus" style="color: #fff;"></i>
                                </span>
                                &nbsp;{{ __('review.in_progress') }}

                                @endif
                                @if(($contribution->review->reviewer->id == Auth::id() or Auth::user()->roles()->where('role_id', 1)->first()) and $contribution->review->form_fill)
                                    <a href="{{ route('review.myReview.edit', $contribution->review->id) }}"
                                       class="btn btn-success pull-right"><i
                                            class="fa fa-fw fa-edit"></i> {{ __('main.edit') }}
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
    <div class="col-8 col-sm-11">
        <p>
            <strong>{{$contribution->review->reviewer->profile->first_name." ".$contribution->review->reviewer->profile->last_name}}</strong>
            <br>{{\Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $contribution->review->reviewer->profile->updated_at)->format('d M, Y')}}
        </p>
    </div>
    <div class="col-12">
        @for ($i = 1; $i < 11; $i++)
            @if($contribution->review->form_fill and $contribution->review->form_fill->form["question_".$i."_sk"])
                <div class="row p-1">
                    <div class="col-2">
                        <small>{{ App::getLocale() == 'en' ? $contribution->review->form_fill->form["question_".$i."_en"] : $contribution->review->form_fill->form["question_".$i."_sk"] }}</small>
                    </div>
                    <div class="col-10">
                        @if($contribution->review->form_fill->form["question_".$i."_type"] == 2)
                            @if($contribution->review->form_fill["answer_".$i] == "1")
                                {{__('main.yes')}}
                            @else
                                {{__('main.no')}}
                            @endif
                        @else
                            {{ $contribution->review->form_fill["answer_".$i] }}
                        @endif
                    </div>
                </div>
            @endif
        @endfor

        @if($contribution->review->form_fill)
            <div class="row p-1">
                <div class="col-2">
                    <small>{{ App::getLocale() == 'en' ? $contribution->review->form_fill->form["question_conclusion_en"] : $contribution->review->form_fill->form["question_conclusion_sk"] }}</small>
                </div>
                <div class="col-10">
                    {{ $contribution->review->form_fill["conclusion"] }}
                </div>
            </div>
        @endif
    </div>
@endif
