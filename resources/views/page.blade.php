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
        @if($block->type == 4)
            @if($block->fixed_id == 99)
                @include('components.fixed_99_conference_head')
            @endif
        @elseif($block->type == 3)
            @if(App::isLocale('en'))
                {!! $block->content_en !!}
            @else
                {!! $block->content !!}
            @endif
        @elseif($block->type == 2)
            @if(App::isLocale('en'))
                {!! $block->content_en !!}
            @else
                {!! $block->content !!}
            @endif
        @elseif($block->type == 1)
            @if(App::isLocale('en'))
                {!! $block->content_en !!}
            @else
                {!! $block->content !!}
            @endif
        @else
        @endif
    @endforeach


@endsection


@section('page_scripts')

@endsection
