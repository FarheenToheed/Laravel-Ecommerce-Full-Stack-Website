@extends('web.layout.master')

@section('title', $blog->title . ' – Sapphire')

@section('content')

    <div class="blog-detail-page">

        @if($blog->image)
            <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="blog-detail-img">
        @endif

        <h1 class="blog-detail-title">{{ $blog->title }}</h1>

        <p class="blog-detail-date">{{ $blog->created_at->format('d M, Y') }}</p>

        <div class="blog-detail-content">
            {!! $blog->detail !!}
        </div>

    </div>

@endsection