@extends('web.layout.master')

@section('content')

<div class="wishlist-page">

    @include('web.pages.account.partials.side-bar')

    <div class="wishlist-content">

        <div class="wishlist-box">

            <div class="wishlist-header">
                <h2>{{ strtoupper(Auth::user()->name) }}'S WISHLIST</h2>
                <a href="#" class="wishlist-share-link">Share Your List</a>
            </div>

            <div class="wishlist-grid">

                @forelse($wishlists as $wishlist)

                    @php
                        $product = $wishlist->product;
                        $variants = $product->product_variants;
                        $mainImage = $product->product_images->first();
                    @endphp

                    <div class="wishlist-item">

                        <form action="{{ route('wishlist.remove', $wishlist->id) }}" method="POST" class="wishlist-remove-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="wishlist-remove-btn">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </form>

                        <a href="{{ route('products/details', $product->id) }}" class="wishlist-image-link">
                            <img src="{{ $mainImage ? asset('storage/' . $mainImage->image_path) : asset('storage/products/no_image.jpg') }}">
                        </a>

                        <a href="{{ route('products/details', $product->id) }}" class="wishlist-name">
                            {{ $product->name }}
                        </a>

                        <p class="wishlist-category">{{ $product->sub_category->name ?? 'NEW ARRIVALS' }}</p>

                        <h4 class="wishlist-price">Rs. {{ number_format(optional($variants->first())->price ?? 0) }}</h4>

                        <form action="{{ route('cart.add') }}" method="POST" class="wishlist-move-form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="product_variant_id" value="{{ optional($variants->first())->id }}">
                            <button type="submit" class="wishlist-size-btn">MOVE TO BAG</button>
                        </form>

                    </div>

                @empty
                    <div class="wishlist-empty">
                        <h3>Your wishlist is empty.</h3>
                    </div>
                @endforelse

            </div>

        </div>

    </div>

</div>

@endsection