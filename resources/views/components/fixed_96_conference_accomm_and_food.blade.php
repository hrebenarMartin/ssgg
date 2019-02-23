<section class="section section-sm" id="lokácia">
    <div class="container shape-containe d-flex bg-">
        <div class="col px-0">
            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <h2 class="py-2">{{ __('titles.conference_accom_food') }}</h2>
                    <hr>
                </div>
                <div class="col-sm-10 col-lg-8">
                    <h3><i class="fa fa-bed"></i> {{__('form.conference_rooms')}}</h3>
                    <ul>
                        @if($dynamic_data->conf_config->accom_1 == 1)
                            <li><p><strong>{{__('form.conference_room1')}}:</strong> {{__('main.cost')}} <strong><u>{{$dynamic_data->conf_config->accom_1_price}} €</u></strong></p></li>
                        @endif
                        @if($dynamic_data->conf_config->accom_2 == 1)
                            <li><p><strong>{{__('form.conference_room2')}}:</strong> {{__('main.cost')}} <strong><u>{{$dynamic_data->conf_config->accom_2_price}} €</u></strong></p></li>
                        @endif
                        @if($dynamic_data->conf_config->accom_3 == 1)
                            <li><p><strong>{{__('form.conference_room3')}}:</strong> {{__('main.cost')}} <strong><u>{{$dynamic_data->conf_config->accom_3_price}} €</u></strong></p></li>
                        @endif
                        @if($dynamic_data->conf_config->accom_4 == 1)
                            <li><p><strong>{{__('form.conference_room4')}}:</strong> {{__('main.cost')}} <strong><u>{{$dynamic_data->conf_config->accom_4_price}} €</u></strong></p></li>
                        @endif
                        @if($dynamic_data->conf_config->accom_5 == 1)
                            <li><p><strong>{{__('form.conference_room5')}}:</strong> {{__('main.cost')}} <strong><u>{{$dynamic_data->conf_config->accom_5_price}} €</u></strong></p></li>
                        @endif
                    </ul>
                    <br>
                    <h3>{{__('form.conference_extra')}}</h3>
                    @if(App::getLocale() == 'en' )
                        <p>{{$dynamic_data->conf_config->extra_info_en}}</p>
                    @else
                        <p>{{$dynamic_data->conf_config->extra_info_sk}}</p>
                    @endif

                </div>
                <div class="col-sm-10 col-lg-4">
                    <h3><i class="fa fa-utensils"></i> {{__('form.conference_food')}}</h3>
                    @php
                        $days = \Carbon\Carbon::createFromFormat('Y-m-d', $dynamic_data->conference->conference_end)->diffInDays(\Carbon\Carbon::createFromFormat('Y-m-d', $dynamic_data->conference->conference_start));
                    @endphp
                    @for ($i = 1; $i <= $days+1; $i++)
                        <p><strong>{{__('form.conference_day')}} {{$i}}. ( {{\Carbon\Carbon::createFromFormat('Y-m-d', $dynamic_data->conference->conference_start)->addDays(($i-1))->format('d M,Y')}} ):</strong>
                            <br>&nbsp; &nbsp; &nbsp;<strong><i class="fa @if($dynamic_data->conf_config["day".intval($i)."_breakfast"] == 1) fa-check text-success @else fa-times text-danger @endif"></i> {{__('form.conference_breakfast')}}</strong>
                            <br>&nbsp; &nbsp; &nbsp;<strong><i class="fa @if($dynamic_data->conf_config["day".intval($i)."_lunch"] == 1) fa-check text-success @else fa-times text-danger @endif"></i> {{__('form.conference_lunch')}}</strong>
                            <br>&nbsp; &nbsp; &nbsp;<strong><i class="fa @if($dynamic_data->conf_config["day".intval($i)."_dinner"] == 1) fa-check text-success @else fa-times text-danger @endif"></i> {{__('form.conference_dinner')}}</strong>
                        </p>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</section>
