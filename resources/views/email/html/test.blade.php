@extends('email.html.layout')

@section('content')
    <h1>TEST EMAIL</h1>
    <hr>
    <h1>{{__('email.review_accepted_title')}}</h1>
    <br>
    <br>
    <section>
        <p>{{__('email.review_accepted_text_1', ['name' => "Name Surname"])}}</p>
        <p>{{__('email.review_accepted_text_2')}}</p>
        <a href="{{route('user.myContribution.index')}}">{{__('email.general_system_link')}}</a>
    </section>
@stop
