<section class="section section-sm" id="ucastnici">
    <div class="container shape-containe d-flex bg-">
        <div class="col px-0">
            <div class="row justify-content-center">
                @if($dynamic_data->conference->proceedings_file)
                    <div class="col-sm-12">
                        <div class="jumbotron text-center">
                            <h2>{{ __('form.conference_proceedings_file') }}</h2>
                            <a href="{{route('conference.proceedings_download', $dynamic_data->conference->id)}}">
                                <h2>{{ __('main.download') }}</h2></a>
                        </div>
                    </div>
                @endif

                @foreach ($dynamic_data->participants as $p)
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-12 col-sm-3 align-center text-center pb-4">
                                @if($p->profile->image)
                                    <img
                                        src="{{asset('public/images/profiles/'.$p->profile->user_id."/".$p->profile->image)}}"
                                        class="rounded-circle" width="100%" style="max-width: 100px;">
                                @endif
                            </div>
                            <div class="col-12 col-sm-9 text-center text-sm-left">
                                <h4>{{$p->profile->first_name." ".$p->profile->last_name}}</h4>
                                <p>{{$p->profile->workplace}}</p>
                                @if($p->contribution)
                                    <button type="button" class="btn btn-outline-success">Príspevok</button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
