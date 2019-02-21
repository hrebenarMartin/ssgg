<section class="section section-sm" id="lokácia">
    <div class="container shape-containe d-flex bg-">
        <div class="col px-0">
            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <h2 class="py-2">{{ __('titles.conference_accom_food') }}</h2>
                    <hr>
                </div>
                <div class="col-sm-10 col-lg-6">
                    <h3>{{__('form.conference_rooms')}}</h3>

                    @if($dynamic_data->conf_config->accom_1 == 1)
                        <p><strong>{{__('form.conference_room1')}}:</strong> {{__('main.cost')}} <strong><u>{{$dynamic_data->conf_config->accom_1_price}} €</u></strong></p>
                    @endif
                    @if($dynamic_data->conf_config->accom_2 == 1)
                        <p><strong>{{__('form.conference_room2')}}:</strong> {{__('main.cost')}} <strong><u>{{$dynamic_data->conf_config->accom_2_price}} €</u></strong></p>
                    @endif
                    @if($dynamic_data->conf_config->accom_3 == 1)
                        <p><strong>{{__('form.conference_room3')}}:</strong> {{__('main.cost')}} <strong><u>{{$dynamic_data->conf_config->accom_3_price}} €</u></strong></p>
                    @endif
                    @if($dynamic_data->conf_config->accom_4 == 1)
                        <p><strong>{{__('form.conference_room4')}}:</strong> {{__('main.cost')}} <strong><u>{{$dynamic_data->conf_config->accom_4_price}} €</u></strong></p>
                    @endif
                    @if($dynamic_data->conf_config->accom_5 == 1)
                        <p><strong>{{__('form.conference_room5')}}:</strong> {{__('main.cost')}} <strong><u>{{$dynamic_data->conf_config->accom_5_price}} €</u></strong></p>
                    @endif

                </div>
                <div class="col-sm-10 col-lg-6">
                    <h3>{{__('form.conference_food')}}</h3>
                    @for ($i = 0; $i < ; $i++)
                       
                    @endfor
                    <p><strong>{{__('form.conference_day')}}1:</strong>
                        @if($dynamic_data->conf_config->day1_breakfast == 1)
                            <br>&nbsp; &nbsp; &nbsp;<strong><i class="fa fa-coffee"></i> {{__('form.conference_breakfast')}}</strong>
                        @endif
                        @if($dynamic_data->conf_config["day".intval(1)."_dinner"] == 1)
                            <br>&nbsp; &nbsp; &nbsp;<strong><i class="fa fa-utensils"></i> {{__('form.conference_lunch')}}</strong>
                        @endif
                        @if($dynamic_data->conf_config->day1_dinner == 1)
                            <br>&nbsp; &nbsp; &nbsp;<strong><i class="fa fa-wine-glass-alt"></i> {{__('form.conference_dinner')}}</strong>
                        @endif
                    </p>

                </div>
            </div>
        </div>
    </div>
</section>
