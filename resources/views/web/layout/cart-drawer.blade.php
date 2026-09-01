<div class="offcanvas offcanvas-end cart-drawer" tabindex="-1" id="shoppingCart"
    aria-labelledby="shoppingCartLabel">

    {{-- Header --}}
    <div class="offcanvas-header cart-header">

        <h5 class="offcanvas-title" id="shoppingCartLabel">
            SHOPPING BAG
        </h5>

        <button type="button" class="btn-close shadow-none"
            data-bs-dismiss="offcanvas" aria-label="Close">
        </button>

    </div>

    {{-- Free Shipping Progress Bar --}}
    @php
        $subtotal = $cart ? $cart->cart_items->sum('total_price') : 0;
        $freeShippingLimit = 8000;
        $percent = min(($subtotal / $freeShippingLimit) * 100, 100);
        $remaining = max($freeShippingLimit - $subtotal, 0);
    @endphp

    <div class="cart-shipping-banner">

        @if($subtotal >= $freeShippingLimit)
            <p class="cart-shipping-text cart-shipping-success">
                CONGRATS 🎉 !<br>YOU HAVE EARNED FREE SHIPPING
            </p>
        @else
            <p class="cart-shipping-text">
                Add PKR {{ number_format($remaining) }} more for FREE shipping
            </p>
        @endif

        <div class="cart-shipping-bar">
            <span>Rs.0</span>
            <div class="cart-shipping-track">
                <div class="cart-shipping-fill" style="width: {{ $percent }}%"></div>
            </div>
            <span>Rs.{{ number_format($freeShippingLimit) }}</span>
        </div>

    </div>

    {{-- Body --}}
    <div class="offcanvas-body cart-body">
        @include('web.layout.partials.cart-item')

    </div>

    {{-- Footer --}}
    @if(($cart->cart_items ?? collect())->count())
    <div class="cart-footer">

        <div class="cart-subtotal">
            <span>SUBTOTAL:</span>
            <strong>Rs.{{ number_format($subtotal) }}</strong>
        </div>

        <a href="{{ route('cart.index') }}" class="cart-btn cart-btn-view">VIEW BAG</a>
        <a href="{{ route('checkout') }}" class="cart-btn cart-btn-checkout">CHECKOUT</a>
        <a href="{{ route('home') }}" class="cart-btn cart-btn-view">CONTINUE SHOPPING</a>

    </div>
    @endif
    
</div>

{{-- Stock Limit Warning (Sapphire jaisa yellow toast) --}}
<div class="cart-stock-warning" id="cartStockWarning">
    <i class="fa-solid fa-triangle-exclamation"></i>
    <span id="cartStockWarningText">Maximum pieces of this item can be added to Cart.</span>
    <button class="cart-stock-warning-close" onclick="document.getElementById('cartStockWarning').classList.remove('show')">&times;</button>
</div>