<section class="section section-lg section-hero section-shaped pb-200">
    <!-- Background circles -->
    <div class="shape shape-style-1 shape-primary">
        <span class="span-150 animated pulse infinite delay-1s slow"></span>
        <span class="span-50 animated pulse infinite delay-2s slower"></span>
        <span class="span-50 animated pulse infinite delay-4s slow"></span>
        <span class="span-75 animated pulse infinite delay-2s slow"></span>
        <span class="span-100 animated pulse infinite delay-3s slow"></span>
        <span class="span-75 animated pulse infinite delay-1s slow"></span>
        <span class="span-50 animated pulse infinite delay-5s slow"></span>
        <span class="span-100 animated pulse infinite delay-2s slow"></span>
        <span class="span-50 animated pulse infinite delay-5s slow"></span>
        <span class="span-100 animated pulse infinite delay-3s slow"></span>

    </div>
    <div class="container shape-container d-flex align-items-center py-lg">
        <div class="col px-0">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-10 text-center">
                    @if(App::getLocale() == 'en')<h1 class="display-2 text-white">{{ $dynamic_data->conference->title_en }}</h1>
                    @else<h1 class="display-2 text-white">{{ $dynamic_data->conference->title_sk }}</h1>
                    @endif
                </div>
                <div class="col-lg-10 text-center">
                    <h2 class="display-3 text-white">{{ $dynamic_data->conference->year }}</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- SVG separator -->
    <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
            <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
        </svg>
    </div>
</section>
