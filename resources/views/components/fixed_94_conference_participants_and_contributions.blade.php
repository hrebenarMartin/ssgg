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
                                    <button type="button" class="btn btn-outline-success contribution_modal_open"
                                            data-contribution-id="{{$p->contribution->id}}" data-toggle="modal"
                                            data-target="#contribution_modal">Príspevok
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="modal fadeInDown" tabindex="-1" role="dialog" id="contribution_modal">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 id="contribution_title"></h3>
                            </div>
                            <div class="modal-body">
                                <p id="contribution_abstract"></p>
                                <hr>
                                <h4>{{__('main.comments')}}</h4>
                                <div class="container" id="contribution_comments">

                                    <div class="row bg-secondary p-3" id="comment_wrap">
                                        <div class="col-4 col-sm-2">
                                            @if($p->profile->image)
                                                <img
                                                    src="{{asset('public/images/profiles/'.$p->profile->user_id."/".$p->profile->image)}}"
                                                    class="rounded-circle" width="100%" style="max-width: 50px;">
                                            @endif
                                        </div>
                                        <div class="col-8 col-sm-10">
                                            <p><strong>{{$p->profile->first_name." ".$p->profile->last_name}}</strong>
                                                <br>xx.xx.2019</p>
                                        </div>
                                        <div class="col-12">
                                            Candy powder carrot cake marshmallow cheesecake cotton candy oat cake
                                            pudding. Bonbon jelly-o tart jelly-o jelly beans carrot cake chocolate.
                                            Tootsie roll lemon drops sweet roll jelly cake pudding lollipop marzipan
                                            gummi bears. Chocolate cake cupcake tootsie roll chocolate bar cheesecake
                                            tart tiramisu.
                                        </div>
                                    </div>
                                </div>
                                <br>
                                @if(Auth::check())
                                    <form id="comment_form" action="#!" method="POST">
                                        @csrf

                                        <input type="hidden" id="contribution_id" name="contribution_id" required>

                                        <div class="form-group">
                                            <label for="comment_text"
                                                   class="control-label"><strong>{{__('main.comment')}}</strong></label>
                                            <textarea id="comment_text" name="comment_text" class="form-control"
                                                      placeholder="Type something nice..." required></textarea>
                                        </div>
                                        <small id="comment_text_hint"
                                               style="display: none;">{{__('main.comment_not_empty')}}<br></small>
                                        <button type="button" id="save_comment_btn"
                                                class="btn btn-success btn-sm">{{__('main.comment_submit')}}</button>
                                    </form>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger"
                                        data-dismiss="modal">{{__('main.cancel')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
