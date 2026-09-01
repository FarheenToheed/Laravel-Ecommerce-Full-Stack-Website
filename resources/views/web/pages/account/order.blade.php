@extends('web.layout.master')

@section('title', 'Order Details')

@section('content')

<div class="account-wrapper">

    {{-- Sidebar --}}
    @include('web.pages.account.partials.side-bar')


    {{-- Right Side --}}
    <div class="account-main">

        {{-- HEADER --}}
        <div class="order-history-header">

            <div class="order-details-heading">

                <div>

                    <span class="order-label">
                        ORDER DETAILS
                    </span>
                    <h2>
                        Order #{{ $order->id }}
                    </h2>

                </div>

                <a href="{{ route('orders.index') }}"
                   class="order-back-btn">

                    Back to Orders
                </a>

            </div>

        </div>


        {{-- ORDER STATUS --}}
        <div class="order-detail-card">

            <div class="detail-card-title">
                <h3>Order Status</h3>
            </div>

            <div class="order-status-box">

                <span class="order-status status-{{ $order->status }}">
                    {{ ucfirst($order->status) }}
                </span>

                <span>
                    Ordered on
                    {{ $order->created_at->format('d M Y, h:i A') }}
                </span>

            </div>

        </div>


        {{-- PRODUCTS --}}
        <div class="order-detail-card">

            <div class="detail-card-title">

                <h3>Order Items</h3>

            </div>


            @foreach($order->order_items as $item)

                <div class="detail-product-row">

                    <div class="detail-product-info">

                        <h4>
                            {{ $item->product->name ?? 'Product' }}
                        </h4>

                        <p>
                            Quantity:
                            {{ $item->quantity }}
                        </p>

                    </div>

                </div>

            @endforeach

        </div>


        {{-- ORDER SUMMARY --}}
        <div class="order-detail-card">

            <div class="detail-card-title">

                <h3>Order Summary</h3>

            </div>

            <div class="detail-summary">

                <div>
                    <span>Subtotal</span>

                    <strong>
                        PKR {{ number_format($order->subtotal, 2) }}
                    </strong>
                </div>

                <div>
                    <span>Tax</span>

                    <strong>
                        PKR {{ number_format($order->tax, 2) }}
                    </strong>
                </div>

                <div class="detail-total">

                    <span>Total</span>

                    <strong>
                        PKR {{ number_format($order->total, 2) }}
                    </strong>

                </div>

            </div>

        </div>


        {{-- SHIPPING ADDRESS --}}
        @if($order->shipping)

            <div class="order-detail-card">

                <div class="detail-card-title">

                    <h3>Shipping Address</h3>

                </div>


                <div class="shipping-address">

                    <strong>
                        {{ $order->shipping->first_name }}
                        {{ $order->shipping->last_name }}
                    </strong>

                    <p>
                        {{ $order->shipping->address }}
                    </p>

                    <p>
                        {{ $order->shipping->city }},
                        {{ $order->shipping->province }}
                    </p>

                    <p>
                        {{ $order->shipping->country }}
                        - {{ $order->shipping->postal_code }}
                    </p>

                    <p>
                        Phone:
                        {{ $order->shipping->phone_no }}
                    </p>

                </div>

            </div>

        @endif


        {{-- PAYMENT --}}
        @if($order->payment)

            <div class="order-detail-card">

                <div class="detail-card-title">

                    <h3>Payment Information</h3>

                </div>


                <div class="payment-info">

                    <div>

                        <span>Payment Method</span>

                        <strong>
                            {{ strtoupper($order->payment->pay_method) }}
                        </strong>

                    </div>


                    <div>

                        <span>Payment Status</span>

                        <strong>
                            {{ ucfirst($order->payment->pay_status) }}
                        </strong>

                    </div>


                    @if($order->payment->transaction_id)

                        <div>

                            <span>Transaction ID</span>

                            <strong>
                                {{ $order->payment->transaction_id }}
                            </strong>

                        </div>

                    @endif

                </div>

            </div>

        @endif


        {{-- BACK BUTTON --}}
        <div class="order-bottom-action">

            <a href="{{ route('orders.index') }}"
               class="order-back-btn">

                ← Back to Order History

            </a>

        </div>

    </div>

</div>

@endsection