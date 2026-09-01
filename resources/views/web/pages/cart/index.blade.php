@extends('web.layout.master')

@section('title', 'Shopping Bag - My Store')

@section('content')

@php
    $cartItems = $cart->cart_items ?? collect();
    $subtotal = $cartItems->sum('total_price');
    $freeShippingLimit = 8000;
    $percent = min(($subtotal / $freeShippingLimit) * 100, 100);
@endphp

@if($cartItems->count())
<div class="cart-page">

    <div class="cart-page-left">

        <div class="cart-table-header">
            <span class="cart-col-product">PRODUCT({{ $cartItems->count() }})</span>
            <span class="cart-col-price">PRICE</span>
            <span class="cart-col-qty">QUANTITY</span>
            <span class="cart-col-total">TOTAL</span>
        </div>

        <div id="cartPageItems">
            @include('web.layout.partials.cart-page',['cart'=>$cart])
        </div>

        <div class="cart-note-section">
            <label for="orderNote">Add Order Note</label>
            <textarea id="orderNote" name="order_note" placeholder="How can we help you?"></textarea>
        </div>

    </div>

    <div class="cart-page-right">

        <div class="cart-summary-row">
            <span>SUBTOTAL:</span>
            <strong id="cartPageSubtotal">Rs.{{ number_format($subtotal) }}</strong>
        </div>

        <a href="{{ route('checkout') }}" class="cart-checkout-btn">CHECKOUT</a>

        <div class="cart-payment-icons">
            <i class="fa-brands fa-cc-mastercard"></i>
            <i class="fa-brands fa-cc-visa"></i>
        </div>

        <div class="cart-shipping-bar">
            <span>Rs.0</span>
            <div class="cart-shipping-track">
                <div class="cart-shipping-fill" id="cartPageShippingFill" style="width: {{ $percent }}%"></div>
            </div>
            <span>Rs.{{ number_format($freeShippingLimit) }}</span>
        </div>

        <p class="cart-shipping-message" id="cartPageShippingText">
            @if($subtotal >= $freeShippingLimit)
                <span class="cart-shipping-success">CONGRATS 🎉 !<br>YOU HAVE EARNED FREE SHIPPING</span>
            @else
                Add PKR {{ number_format(max($freeShippingLimit - $subtotal, 0)) }} more for FREE shipping
            @endif
        </p>

    </div>

</div>
@else
<div class="cart-empty">


    <div class="cart-empty-icon">
        <i class="fa-solid fa-cart-shopping"></i>
    </div>

    <h3>YOUR CART IS EMPTY</h3>

    <a href="{{ route('home') }}" class="continue-shopping-btn">
        CONTINUE SHOPPING
    </a>

</div>

@endif

@endsection