<section class="section section-sm" id="archive_list">
    <div class="container shape-containe d-flex bg-">
        <div class="col px-0">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <h2>{{ __('main.archive_list') }}</h2>
                </div>
                <hr>
                @php
                    $colors = ["danger", "primary", "success", "info", "warning", "dark", "light"];
                    $rnd = random_int(0, 6);
                    $color = $colors[$rnd]
                @endphp
                @foreach ($dynamic_data->conferences as $c)
                    <div class="col-xs-4 col-sm-3 text-center">
                        <a href="{{route('archive.show', $c->year)}}" class="btn btn-{{$color}}">{{$c->year}}</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
