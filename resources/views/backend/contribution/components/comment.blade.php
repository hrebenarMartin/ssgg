<div class="row gray-bg p-3">
    <div class="col-1">
        @if($c->author->profile->image)
            <img
                src="{{asset('public/images/profiles/'.$c->author->profile->id."/".$c->author->profile->image)}}"
                class="rounded-circle" width="100%" style="max-width: 50px;">
        @endif
    </div>
    <div class="col-8 col-sm-10">
        <p>
            <strong>{{$c->author->profile->first_name." ".$c->author->profile->last_name}}</strong>
            <br>{{\Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $c->created_at)->format('d M, Y')}}
        </p>
    </div>
    <div class="col-12">
        {{$c->comment}}
    </div>
</div>
