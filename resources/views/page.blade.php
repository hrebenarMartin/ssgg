@extends('layouts.app')

@section('title', 'Home')

@section('page_css')

@endsection


@section('content')
    {{-- dd($data) --}}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @foreach($data as $block)
                    {!! $block->data !!}
                @endforeach
            </div>
        </div>
    </div>

@endsection


@section('page_scripts')

@endsection
