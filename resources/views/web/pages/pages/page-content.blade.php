{{-- @extends('web.layout.master')

@section('title', $page->page_name . ' – Sapphire')

@section('content')

    <div class="page-content-wrapper">

        <div class="page-content-hero text-center" style="font-size: 16px; font-weight: 500; letter-spacing: 0.3px; padding-top: 15px; padding-bottom: 12px; margin-top: 15px;">
            <h1>{{ $page->page_name }}</h1>
        </div>

        <div class="page-content-body">
            {!! $page->content !!}
        </div>

    </div>

@endsection --}}


@extends('web.layout.master')

@section('title', $page->page_name . ' – Sapphire')

@section('content')

<div class="page-content-wrapper">

    <div class="page-content-hero text-center">
        <h1>{{ $page->page_name }}</h1>
    </div>

    <div class="page-content-body">
        {!! $page->content !!}
    </div>

</div>

@endsection
