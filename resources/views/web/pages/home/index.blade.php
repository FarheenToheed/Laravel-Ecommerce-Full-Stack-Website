@extends('web.layout.master')

@section('title', 'Home - My Store')
@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
@endpush

@section('content')

    <section class="trending-section">

        <div class="trending-header">

            <div class="trending-left">
                <h2>TRENDING</h2>
                <p>DISCOVER THE BEST-SELLING STYLES</p>
            </div>

            <div class="trending-tabs">
                <div class="sub-category-group">
                    @foreach($categories->first()->sub_categories->take(4) as $subCategory)
                        <a href="{{ route('home', $subCategory->id) }}">
                            {{ $subCategory->name }}
                        </a>
                    @endforeach
                </div>
            </div>

        </div>

    </section>

    {{-- Trending slider --}}
    <div class="product-slider">
        <div class="swiper productSwiper">
            <div class="swiper-wrapper">
                @foreach($products as $product)
                    <div class="swiper-slide">
                        @include('web.pages.product.partials.product-card', ['product' => $product])
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>

    {{-- All Products heading --}}
    <section class="all-products-section">
        <div class="all-products-header">
            <div class="all-products-center">
                <h2>All Products</h2>
                <p>Discover All Our Best-Selling Styles</p>
            </div>
        </div>
    </section>

    {{-- All products slider (same partial, same classes) --}}
    <div class="product-slider">
        <div class="swiper productSwiper">
            <div class="swiper-wrapper">
                @foreach($allproducts as $product)
                    <div class="swiper-slide">
                        @include('web.pages.product.partials.product-card', ['product' => $product])
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="text-center">
        <a href="{{ route('products') }}" class="btn-view-all">
            View All Products
        </a>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
@endpush


{{-- @extends('web.layout.master')

@section('title', 'Home - My Store')
@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
@endpush

@section('content')
    <section class="trending-section">

        <div class="trending-header">

            {{-- Left Side --}}
            {{-- <div class="trending-left">

                <h2>TRENDING</h2>

                <p>DISCOVER THE BEST-SELLING STYLES</p>

            </div>

            {{-- Right Side --}}
            {{-- <div class="trending-tabs">

                <div class="sub-category-group">

                    @foreach($categories->first()->sub_categories->take(4) as $subCategory)
                        <a href="{{ route('home', $subCategory->id) }}">
                            {{ $subCategory->name }}
                        </a>
                    @endforeach

                </div>

            </div>

        </div>

    </section>

    <div class="product-slider">

        <div class="swiper productSwiper">

            <div class="swiper-wrapper">

                @foreach($products as $product)                    
                    @include('web.pages.product.partials.product-card', $product)
                @endforeach

            </div>

            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

        </div>

    </div> --}}

    {{-- View All Products --}}
    {{-- <section class="all-products-section">

        <div class="all-products-header">

            {{-- Center Content --}}
            {{-- <div class="all-products-center">

                <h2>All Products</h2>

                <p>Discover All Our Best-Selling Styles</p>

            </div>

        </div>

    </section>  --}}

    {{-- <div class="product-slider">

        <div class="swiper productSwiper">

            <div class="swiper-wrapper">


                @foreach($allproducts as $product)

                    <div class="swiper-slide">

                        <div class="product-card">
                            <a href="{{ route('products/details', $product->id) }}" class="grid-product-image">

                                <div class="product-image">

                                    <img src="{{ asset('storage/' . $product->product_images->first()->image_path) }}"
                                        alt="{{ $product->name }}">

                                    <div class="product-overlay">

                                        <div class="product-sizes">

                                            @foreach($product->product_variants as $variant)

                                                <span>{{ $variant->product_size?->name }}</span>

                                            @endforeach

                                        </div>

                                        <div class="product-actions">

                                            <button class="bag-btn">
                                                ADD TO BAG
                                            </button>

                                            <button class="wish-btn">
                                                <i class="fa-regular fa-heart"></i>
                                            </button>

                                        </div>

                                    </div>

                                </div>
                            </a>

                            <div class="product-info">

                                <h4>{{ $product->name }}</h4>

                                <p>{{ $product->sub_category->name ?? 'NEW ARRIVALS' }}</p>

                                <h5>
                                    Rs. {{ optional($product->product_variants->first())->price }}
                                </h5>

                            </div>

                        </div>

                    </div>

                @endforeach


            </div>

            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

        </div>

    </div>
    <div class="text-center">
        <a href="{{ route('products') }}" class="btn-view-all">
            View All Products
        </a>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
@endpush --}}