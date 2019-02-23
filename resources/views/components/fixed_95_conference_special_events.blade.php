<section class="section section-sm" id="lokácia">
    <div class="container shape-containe d-flex bg-">
        <div class="col px-0">
            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <h2 class="py-2">{{ __('form.conference_special') }}</h2>
                    <hr>
                </div>
                <div class="col-sm-10">
                    <ul>
                        @if($dynamic_data->conf_config->special_1 == 1)
                            @if(App::getLocale()=='en')
                                <li>{{$dynamic_data->conf_config->special_1_en}}</li>
                            @else
                                <li>{{$dynamic_data->conf_config->special_1_sk}}</li>
                            @endif
                        @endif
                        @if($dynamic_data->conf_config->special_2 == 1)
                            @if(App::getLocale()=='en')
                                <li>{{$dynamic_data->conf_config->special_2_en}}</li>
                            @else
                                <li>{{$dynamic_data->conf_config->special_2_sk}}</li>
                            @endif
                        @endif
                        @if($dynamic_data->conf_config->special_3 == 1)
                            @if(App::getLocale()=='en')
                                <li>{{$dynamic_data->conf_config->special_3_en}}</li>
                            @else
                                <li>{{$dynamic_data->conf_config->special_3_sk}}</li>
                            @endif
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
