<section class="section section-sm" id="lokácia">
    <div class="container shape-containe d-flex bg-">
        <div class="col px-0">
            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <h1 class="py-2">{{ __('titles.conference_when_where') }}</h1>
                    <hr>
                </div>
                <div class="col-sm-10 col-lg-5">
                    <h3><i class="fa fa-calendar-alt"></i> {{__('main.when')}}?</h3>
                    <p><strong>{{__('form.conference_registration_dates')}}: </strong>
                        <br>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $dynamic_data->conference->registration_start)->format('d M,Y') }} -
                            {{ \Carbon\Carbon::createFromFormat('Y-m-d', $dynamic_data->conference->registration_end)->format('d M,Y') }}
                    </p>
                    <p><strong>{{__('form.conference_conference_dates')}}: </strong><u>
                        <br>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $dynamic_data->conference->conference_start)->format('d M,Y') }} -
                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $dynamic_data->conference->conference_end)->format('d M,Y') }}</u>
                    </p>
                    <h3><i class="fa fa-map-marker-alt"></i> {{__('main.where')}}?</h3>
                    <p>
                        {{$dynamic_data->conference->address_place}}<br>
                        {{$dynamic_data->conference->address_city}}<br>
                        {{$dynamic_data->conference->country_name}}<br>
                        <strong>{{__('form.conference_lat')}}:</strong> {{$dynamic_data->conference->lat}}<br>
                        <strong>{{__('form.conference_lng')}}:</strong> {{$dynamic_data->conference->lng}}
                    </p>
                </div>
                <div class="col-sm-10 col-lg-7">
                    <div id="map" style="height: 100%; min-height: 400px"></div>
                </div>
            </div>
        </div>
    </div>
</section>
