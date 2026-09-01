{{-- @extends('web.layout.master')

@section('title', ($subCategory->name ?? $childCategory->name ?? 'Category') . ' - My Store')

@section('content')

<div class="all-products-wrapper">
    <div class="about-breadcrumb">
        <a href="{{ route('home') }}">Home</a> &nbsp;/&nbsp; About Us
    </div>

    <div class="category-header">
        <h1 class="category-title">
            {{ $category->name?? $subCategory->name ?? $childCategory->name ?? 'Products' }}
        </h1>
    </div>

    <div class="all-products-grid">

        @forelse($products as $product)

            <div class="grid-product-card">

                <a href="{{ route('products/details', $product->id) }}" class="grid-product-image">

                    <img src="{{ $product->product_images->first() ? asset('storage/' . $product->product_images->first()->image_path) : asset('images/no-image.jpg') }}"
                        alt="{{ $product->name }}">

                    <div class="grid-product-overlay">

                        <div class="grid-product-sizes">
                            @foreach($product->product_variants as $variant)
                                <span>{{ $variant->product_size?->name }}</span>
                            @endforeach
                        </div>

                        <div class="grid-product-actions">
                            <button class="grid-bag-btn" onclick="event.preventDefault()">ADD TO BAG</button>
                            <button class="grid-wish-btn" onclick="event.preventDefault()">
                                <i class="fa-regular fa-heart"></i>
                            </button>
                        </div>

                    </div>

                </a>

                <div class="grid-product-info">
                    <h4>{{ $product->name }}</h4>
                    <p>{{ $product->sub_category->name ?? 'NEW ARRIVALS' }}</p>
                    <h5>Rs. {{ optional($product->product_variants->first())->price }}</h5>
                </div>

            </div>

        @empty
            <p class="no-products-text">No products found in this category.</p>
        @endforelse

    </div>

    <div class="pagination-wrapper">

        @if ($products->hasPages())

            @if ($products->onFirstPage())
                <span class="pd-page-link pd-disabled">Previous</span>
            @else
                <a href="{{ $products->previousPageUrl() }}" class="pd-page-link">Previous</a>
            @endif

            @for ($i = 1; $i <= $products->lastPage(); $i++)
                @if ($i == $products->currentPage())
                    <span class="pd-page-link pd-active">{{ $i }}</span>
                @else
                    <a href="{{ $products->url($i) }}" class="pd-page-link">{{ $i }}</a>
                @endif
            @endfor

            @if ($products->hasMorePages())
                <a href="{{ $products->nextPageUrl() }}" class="pd-page-link">Next</a>
            @else
                <span class="pd-page-link pd-disabled">Next</span>
            @endif

        @endif

    </div>

</div>

@endsection --}}

@extends('web.layout.master')

@section('title', ($subCategory->name ?? $childCategory->name ?? $category->name ?? 'Category') . ' - My Store')

@section('content')

<div class="all-products-wrapper">

    <div class="about-breadcrumb">
        <a href="{{ route('home') }}">Home</a> &nbsp;/&nbsp; {{ $category->name ?? $subCategory->name ?? $childCategory->name ?? 'Products' }}
    </div>

    <div class="category-header">
        <h1 class="category-title">
            {{ $category->name ?? $subCategory->name ?? $childCategory->name ?? 'Products' }}
        </h1>
    </div>

    <div class="all-products-grid">

        @forelse($products as $product)

            @include('web.pages.product.partials.product-card', ['product' => $product])

        @empty

            <p class="no-products-text">No products found in this category.</p>

        @endforelse

    </div>

    <div class="pagination-wrapper">

        @if ($products->hasPages())

            @if ($products->onFirstPage())
                <span class="pd-page-link pd-disabled">Previous</span>
            @else
                <a href="{{ $products->previousPageUrl() }}" class="pd-page-link">Previous</a>
            @endif

            @for ($i = 1; $i <= $products->lastPage(); $i++)
                @if ($i == $products->currentPage())
                    <span class="pd-page-link pd-active">{{ $i }}</span>
                @else
                    <a href="{{ $products->url($i) }}" class="pd-page-link">{{ $i }}</a>
                @endif
            @endfor

            @if ($products->hasMorePages())
                <a href="{{ $products->nextPageUrl() }}" class="pd-page-link">Next</a>
            @else
                <span class="pd-page-link pd-disabled">Next</span>
            @endif

        @endif

    </div>

</div>

@endsection