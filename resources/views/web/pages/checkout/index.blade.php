@extends('web.layout.master')

@section('title', 'Checkout')

@section('content')

<div class="checkout"
     data-place-order-url="{{ route('checkout.place-order') }}"
     data-csrf-token="{{ csrf_token() }}"
     data-confirmation-url="{{ url('/order/confirmation') }}">
     

    <div class="checkout-left">

        {{-- Contact --}}
        <div class="checkout-box">

            <h3>
                <span>1</span>
                Contact Information
            </h3>

            @auth
                <div class="logged-user-box">
                    <p><i class="fa-solid fa-circle-check"></i> Logged in as</p>
                    <h5>{{ auth()->user()->email }}</h5>
                </div>
            @endauth

        </div>

        {{-- Shipping --}}
        <div class="checkout-box" id="shipping">

            <h3>
                <span>2</span>
                Shipping
                <i class="fa-solid fa-check step-check" id="shippingCheck" style="display:none;"></i>
                <a href="#" class="edit-link" id="editShipping" style="display:none;">Edit</a>
            </h3>

            <div id="shippingForm">

                <div class="row">
                    <div class="field">
                        <label>First Name <span class="required">*</span></label>
                        <input type="text" id="first_name" value="{{ $user->name }}" required>
                    </div>

                    <div class="field">
                        <label>Last Name <span class="required">*</span></label>
                        <input type="text" id="last_name" value="{{ $user->lastname }}">
                    </div>
                </div>

                <div class="field">
                    <label>Address <span class="required">*</span></label>
                    <input type="text" id="address">
                </div>

                <div class="row">

                    <div class="field">
                        <label>Country <span class="required">*</span></label>
                        <select id="country">
                            <option value="Pakistan" selected>Pakistan</option>
                            <option value="UAE">United Arab Emirates</option>
                            <option value="Saudi">Saudi Arabia</option>
                        </select>
                    </div>

                    <div class="field">
                        <label>Province <span class="required">*</span></label>
                        <select id="province">
                            <option value="Punjab">Punjab</option>
                            <option value="Sindh">Sindh</option>
                            <option value="KPK">KPK</option>
                            <option value="Balochistan">Balochistan</option>
                        </select>
                    </div>

                </div>

                <div class="row">

                    <div class="field">
                        <label>City <span class="required">*</span></label>
                        <input type="text" id="city">
                    </div>

                    <div class="field">
                        <label>Postal Code <span class="required">*</span></label>
                        <input type="text" id="postal_code">
                    </div>

                </div>

                <div class="field">
                    <label>WhatsApp Number <span class="required">*</span></label>

                    <div class="phone-box">
                        <span class="phone-prefix">
                            <img src="https://flagcdn.com/w40/pk.png" alt="Pakistan">
                            +92
                        </span>
                        <input type="text" id="phone" placeholder="300 1234567"  value="{{ $user->phoneno ?? '' }}" maxlength="10">
                    </div>
                </div>

                <button type="button" class="black-btn full" id="proceedPaymentBtn">
                    PROCEED TO PAYMENT
                </button>

            </div>

            <div id="shippingSummary" style="display:none;">
                <p class="summary-label">Shipping Address:</p>
                <p id="summaryText"></p>
            </div>

        </div>

        {{-- Payment --}}
        <div class="checkout-box" id="payment" style="display:none;">

            <h3>
                <span>3</span>
                Payment
            </h3>

            <div class="promo-box">
                <input type="text" placeholder="Promo Code" id="promo_code">
                <button type="button" class="apply-btn" id="applyPromoBtn">APPLY</button>
            </div>

            <div class="payment-option active" data-method="cod">
                <span class="radio-circle"></span>
                <span class="option-label">Cash On Delivery</span>
            </div>

            <div class="payment-option" data-method="bank">
                <span class="radio-circle"></span>
                <span class="option-label">Debit / Credit Card</span>
            </div>

            <div class="card-fields" id="cardFields">

                <input type="text" placeholder="Card Number" maxlength="19">

                <div class="row">
                    <select>
                        <option>Expiration Month</option>
                        @for($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}">{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}</option>
                        @endfor
                    </select>

                    <select>
                        <option>Expiration Year</option>
                        @for($y = date('y'); $y <= date('y') + 10; $y++)
                            <option value="{{ $y }}">{{ $y }}</option>
                        @endfor
                    </select>
                </div>

                <div class="row">
                    <input type="text" placeholder="Security Code" maxlength="4">
                    <input type="text" placeholder="Cardholder Name">
                </div>

                <p class="secure-text">
                    <i class="fa-solid fa-lock"></i> Your payment details are encrypted
                </p>

            </div>

            <div class="billing-check">
                <input type="checkbox" id="billingSame" checked>
                <label for="billingSame">Billing Address Same as shipping</label>
            </div>

            <button type="button" class="black-btn full" id="placeOrderBtn">
                PLACE YOUR ORDER
            </button>

        </div>

    </div>

    {{-- Right Side --}}
    <div class="checkout-right">

        <div class="summary-box">

            <h4>ORDER SUMMARY ({{ $cart->cart_items->count() }})</h4>

            @foreach($cart->cart_items as $item)
                <div class="summary-product">
                    <img src="{{ asset('storage/'.$item->product->product_images->first()->image_path) }}">
                    {{-- <img src="{{ $item->product->product_images->first()->image_path ?? 'https://via.placeholder.com/80' }}"> --}}
                    <div>
                        <h5>{{ $item->product->name }}</h5>
                        <p>Size : {{ $item->variant->product_size->name ?? '-' }}</p>
                        <p>Qty : {{ $item->quantity }}</p>
                    </div>
                </div>
            @endforeach

            <hr>

            <div class="summary-row">
                <span>Subtotal</span>
                <span>Rs.{{ number_format($subtotal) }}</span>
            </div>

            <div class="summary-row">
                <span>Shipping</span>
                <span>Rs.0</span>
            </div>

            <div class="summary-row total">
                <span>Total</span>
                <span>Rs.{{ number_format($subtotal) }}</span>
            </div>

        </div>

    </div>

</div>

@endsection