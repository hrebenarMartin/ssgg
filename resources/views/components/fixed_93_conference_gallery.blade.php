<!-- The Gallery as lightbox dialog, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls text-white">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>

<section>
    <div class="container shape-container d-flex bg-">
        <div class="col px-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="justify-content-center">
                        <div class="row image_galery" style="width: 100%">
                            @foreach($dynamic_data->gallery as $p)
                                <div class="col-xs-6 col-sm-3">
                                    <a href="{{asset('/images/conference/') . '/'.$dynamic_data->conference->id .'/large/' . $p->image}}"
                                       data-gallery>
                                        <img class="img-responsive py-1 px-1"
                                             src="{!! asset('/images/conference/') . '/'.$dynamic_data->conference->id .'/sq/' . $p->image !!}"
                                             width="100%">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
