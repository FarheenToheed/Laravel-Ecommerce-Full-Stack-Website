@extends('web.layout.master')

@section('title', 'Blogs – Sapphire')

@section('content')

    <div class="blogs-page">

        <h1 class="blogs-heading">Our Blogs</h1>

        <div class="blogs-grid">
            @foreach ($blogs as $blog)
                <a href="{{ route('blogs.show', $blog->id) }}" class="blog-card">
                    @if($blog->image)
                        <div class="blog-card-img-wrap">
                            <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="blog-card-img">
                        </div>
                    @endif

                    <div class="blog-card-body">
                        <h3>{{ $blog->title }}</h3>
                        <p>{{Str::limit($blog->short_description, 100) }}</p>
                        <span class="blog-card-link">CONTINUE READING</span>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="blogs-pagination">
            {{ $blogs->links() }}
        </div>

    </div>

@endsection