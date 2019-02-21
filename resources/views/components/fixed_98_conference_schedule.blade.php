<div class="section section-sm" id="program">
    <div class="container shape-container bg-lighter d-flex bg-">
        <div class="col px-0">
            <div class="row align-items-center justify-content-center">
                <div class="col-sm-10">
                    <h3 class="py-2">{{ __('titles.conference_schedule') }}</h3>
                    @if(App::getLocale() == 'en')
                        {!! Markdown::convertToHtml($dynamic_data->conference->schedule_en) !!}
                    @else
                        {!! Markdown::convertToHtml($dynamic_data->conference->schedule_sk) !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
