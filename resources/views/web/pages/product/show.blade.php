@extends('web.layout.master')

@section('title', $product->name . ' - My Store')

@section('content')

    <div class="pd-wrapper">

        {{-- LEFT SIDE: Product Images --}}
        <div class="pd-images">

            @forelse($product->product_images as $image)
                <div class="pd-image-box">
                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $product->name }}"
                        class="pd-gallery-trigger">
                    <span class="pd-zoom-icon">
                        <i class="fa-solid fa-plus"></i>
                    </span>
                </div>
            @empty
                <div class="pd-image-box">
                    <img src="{{ asset('images/no-image.jpg') }}" alt="No Image" class="pd-gallery-trigger">
                    <span class="pd-zoom-icon">
                        <i class="fa-solid fa-plus"></i>
                    </span>
                </div>
            @endforelse

        </div>

        {{-- RIGHT SIDE: Product Info --}}
        <div class="pd-info">

            <h1 class="pd-title">{{ $product->name }}</h1>

            <p class="pd-price">
                Rs. {{ number_format($product->current_price) }}
            </p>

            <p class="pd-sku">SKU: {{ $product->sku }}</p>

            {{-- Color Selection --}}
            @if($product->available_colors->count())
                <div class="pd-colors">
                    <p class="pd-colors-label">Colour</p>
                    <div class="pd-colors-row">
                        @foreach($product->available_colors as $color)
                            <button class="pd-color-swatch" style="background-color: {{ $color->code }}" title="{{ $color->name }}"
                                data-color-id="{{ $color->id }}"></button>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Size Selection --}}
            {{-- <div class="pd-size-section" data-has-sizes="{{ $product->available_sizes->count() ? 'true' : 'false' }}">

                @if($product->available_sizes->count())
                    <div class="pd-size-heading">
                        <span>SELECT YOUR SIZE</span>
                        <a href="#" id="pdOpenSizeGuideBtn">SIZE CHART</a>
                    </div>

                    <div class="pd-size-options">
                        @foreach($product->available_sizes as $size)
                            <button class="pd-size-btn" data-size-id="{{ $size->id }}">
                                {{ $size->name }}
                            </button>
                        @endforeach
                    </div>
                @endif

            </div> --}}

            {{-- Quantity + Add to Bag --}}
<div class="pd-action-row">

    <div class="pd-qty-selector">
        <button class="pd-qty-btn" id="pdQtyMinus">-</button>
        <span id="pdQtyValue">1</span>
        <button class="pd-qty-btn" id="pdQtyPlus">+</button>
    </div>

    <form action="{{ route('cart.add') }}" method="POST" id="pdAddToBagForm">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <input type="hidden" name="product_variant_id" id="pdVariantId" value="">

        <button type="submit" class="pd-add-to-bag-btn" id="pdAddToBagBtn" data-stock="{{ $product->stock }}">
            ADD TO BAG
        </button>
    </form>

</div>

            {{-- Stock Warning Message --}}
            <div class="pd-stock-warning" id="pdStockWarning">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <span id="pdStockWarningText">Not enough items available.</span>
                <button class="pd-stock-warning-close" id="pdStockWarningClose">&times;</button>
            </div>

            {{-- BaadMay Button --}}
            @if($product->installment_amount > 0)
                <button class="pd-baadmay-btn" id="pdBaadmayBtn">
                    <span class="pd-baadmay-logo">baadmay</span>
                    PAY IN 3 INSTALLMENTS OF RS. {{ number_format($product->installment_amount) }}
                </button>
            @endif

            {{-- Tabs --}}
            <div class="pd-tabs">
                <button class="pd-tab-link pd-tab-active" data-tab="pdDetails">DETAILS</button>
                <button class="pd-tab-link" data-tab="pdDescription">DESCRIPTION</button>
                <button class="pd-tab-link" data-tab="pdSizeguide">SIZE GUIDE</button>
            </div>

            <div class="pd-tab-content pd-tab-content-active" id="pdDetails">
                {!! $product->details !!}
            </div>

            <div class="pd-tab-content" id="pdDescription">
                {!! $product->description !!}
            </div>

            <div class="pd-tab-content" id="pdSizeguide">
                {!! $product->size_guide !!}
            </div>

        </div>

    </div>

    {{-- LIGHTBOX / GALLERY MODAL --}}
    <div class="pd-lightbox" id="pdLightbox">

        <div class="pd-lightbox-top">
            <span class="pd-lightbox-counter" id="pdLightboxCounter">1/1</span>
            <div class="pd-lightbox-controls">
                <button class="pd-lightbox-zoom-btn" id="pdLightboxZoomBtn">
                    <i class="fa-solid fa-magnifying-glass-plus"></i>
                </button>
                <button class="pd-lightbox-close" id="pdLightboxClose">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        </div>

        <button class="pd-lightbox-arrow pd-lightbox-prev" id="pdLightboxPrev">
            <i class="fa-solid fa-chevron-left"></i>
        </button>

        <div class="pd-lightbox-main">
            <img src="" alt="" id="pdLightboxMainImage">
        </div>

        <button class="pd-lightbox-arrow pd-lightbox-next" id="pdLightboxNext">
            <i class="fa-solid fa-chevron-right"></i>
        </button>

        <div class="pd-lightbox-thumbs" id="pdLightboxThumbs">
            {{-- JS se yahan thumbnails inject honge --}}
        </div>

    </div>

    {{-- BaadMay Popup  Modal--}}
<div class="pd-baadmay-modal" id="pdBaadmayModal">
    <div class="pd-baadmay-content">
        <button class="pd-baadmay-close" id="pdBaadmayClose">&times;</button>

        <div class="pd-baadmay-header">
            <p>Pay for your purchase, thora abhi, baaqi?</p>
            <h2>baadmay</h2>
        </div>

        <div class="pd-baadmay-box">
            <p>Pay in 3 easy instalments</p>
        </div>

        <h4>Added items to your cart?</h4>

        <div class="pd-baadmay-steps">
            <div class="pd-baadmay-step">
                <i class="fa-solid fa-cart-shopping"></i>
                <p>Select BaadMay at Checkout</p>
            </div>
            <div class="pd-baadmay-step">
                <i class="fa-solid fa-circle-check"></i>
                <p>Verify your account details</p>
            </div>
            <div class="pd-baadmay-step">
                <i class="fa-solid fa-tag"></i>
                <p>Pay only your first installment now</p>
            </div>
        </div>

        <p class="pd-baadmay-footer">Let's shop and pay BaadMay!</p>
    </div>
</div>
@endsection