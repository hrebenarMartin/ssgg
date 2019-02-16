@extends('layouts.app')



@if(App::isLocale('en'))
    @section('title', $page->title_second)
@else
    @section('title', $page->title)
@endif

@section('page_css')

@endsection


@section('content')

    {{-- dd($data) --}}
    @foreach($data as $block)
        @if(App::isLocale('en'))
            {!! $block->content !!}
        @else
            {!! $block->content_en !!}
        @endif
    @endforeach


@endsection


@section('page_scripts')

@endsection
