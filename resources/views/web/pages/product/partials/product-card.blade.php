{{-- resources/views/web/pages/product/partials/product-card.blade.php --}}
@php
    $sizeVariants = $product->product_variants->filter(fn($variant) => $variant->product_size);
    $hasSizeOptions = $sizeVariants->count() > 0;
    $defaultVariantId = $hasSizeOptions ? '' : optional($product->product_variants->first())->id;
@endphp

<div class="grid-product-card">

    <a href="{{ route('products/details', $product->id) }}" class="grid-product-image">

        <img src="{{ asset('storage/' . $product->product_images->first()->image_path) }}" alt="{{ $product->name }}">

        <div class="grid-product-overlay">

            @if($hasSizeOptions)
                <div class="grid-product-sizes">
                    @foreach($sizeVariants as $variant)
                        <span class="grid-size-option" data-variant-id="{{ $variant->id }}">
                            {{ $variant->product_size->name }}
                        </span>
                    @endforeach
                </div>
            @endif

            <div class="grid-product-actions">

                <form action="{{ route('cart.add') }}" method="POST" class="grid-cart-form">
                    @csrf

                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="product_variant_id" class="grid-variant-id" value="{{ $defaultVariantId }}">

                    <button type="submit"
                            class="pd-add-to-bag-btn {{ $product->isInCart() ? 'added' : '' }}"
                            data-product="{{ $product->id }}">

                        {{ $product->isInCart() ? 'REMOVE FROM BAG' : 'ADD TO BAG' }}

                    </button>

                </form>

                <form action="{{ route('wishlist.add') }}" method="POST" class="wishlist-form">
                    @csrf

                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <button type="submit" class="grid-wish-btn">
                        <i class="fa-regular fa-heart"></i>
                    </button>

                </form>

            </div>

        </div>

    </a>

    <div class="grid-product-info">
        <h4>{{ $product->name }}</h4>
        <p>{{ $product->sub_category->name ?? 'NEW ARRIVALS' }}</p>
        <h5>Rs. {{ optional($product->product_variants->first())->price }}</h5>
    </div>

</div>



{{-- resources/views/web/pages/product/partials/product-card.blade.php --}}
{{-- <div class="grid-product-card">

    <a href="{{ route('products/details', $product->id) }}" class="grid-product-image">

        <img src="{{ asset('storage/' . $product->product_images->first()->image_path) }}" alt="{{ $product->name }}">

        <div class="grid-product-overlay">

            <div class="grid-product-sizes">
                @foreach($product->product_variants as $variant)
                    <span>{{ $variant->product_size?->name }}</span>
                @endforeach
            </div> --}}

            {{-- grid-product-actions ka naya structure --}}
            {{-- <div class="grid-product-actions">

                <form action="{{ route('cart.add') }}" method="POST" class="grid-cart-form">
                    @csrf

                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <button type="submit" class="pd-add-to-bag-btn {{ $product->isInCart() ? 'added' : '' }}"
                        data-product="{{ $product->id }}">

                        {{ $product->isInCart() ? 'REMOVE FROM BAG' : 'ADD TO BAG' }}

                    </button>

                </form>

                <form action="{{ route('wishlist.add') }}" method="POST" class="wishlist-form">
                    @csrf

                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <button type="submit" class="grid-wish-btn">
                        <i class="fa-regular fa-heart"></i>
                    </button>

                </form>

            </div>

        </div>

    </a>

    <div class="grid-product-info">
        <h4>{{ $product->name }}</h4>
        <p>{{ $product->sub_category->name ?? 'NEW ARRIVALS' }}</p>
        <h5>Rs. {{ optional($product->product_variants->first())->price }}</h5>
    </div>

</div> --}}


{{-- <div class="grid-product-card">

    <a href="{{ route('products/details', $product->id) }}" class="grid-product-image">

        <div class="grid-product-image">

            <img src="{{ asset('storage/' . $product->product_images->first()->image_path) }}"
                alt="{{ $product->name }}">

            <div class="grid-product-overlay">

                <div class="grid-product-sizes">

                    @foreach($product->product_variants as $variant)

                    <span>{{ $variant->product_size?->name }}</span>

                    @endforeach

                </div>

                <div class="grid-product-actions">

                    <button class="grid-bag-btn">
                        ADD TO BAG
                    </button>

                    <button class="grid-wish-btn">
                        <i class="fa-regular fa-heart"></i>
                    </button>

                </div>

            </div>

        </div>
    </a>

    <div class="grid-product-info">

        <h4>{{ $product->name }}</h4>

        <p>{{ $product->sub_category->name ?? 'NEW ARRIVALS' }}</p>

        <h5>
            Rs. {{ optional($product->product_variants->first())->price }}
        </h5>

    </div>

</div> --}}