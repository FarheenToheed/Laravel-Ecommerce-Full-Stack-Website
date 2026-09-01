{{-- resources/views/web/pages/checkout/confirmation.blade.php --}}
@extends('web.layout.master')

@section('title', 'Order Confirmation')

@section('content')

<div class="confirmation-page">

    <div class="confirmation-header">

        <i class="fa-solid fa-circle-check confirmation-tick"></i>

        <h2>Thank You, {{ $customerName }}</h2>

        <p class="confirmation-subtext">
            We have received your order. You will receive an order confirmation request on WhatsApp.
            Once you confirm, your order will be processed and you will receive e-mail updates on
            <strong>{{ $customerEmail }}</strong>.
        </p>

        <div class="confirmation-meta">
            <p>Order Number: <strong>{{ $orderNumber }}</strong></p>
            <p>Order Date: <strong>{{ $orderDate }}</strong></p>
            <p>Order Status: <strong>{{ $orderStatus }}</strong></p>
        </div>

        <a href="{{ route('products') }}" class="btn-continue-shopping">
            CONTINUE SHOPPING
        </a>

    </div>

    <hr class="confirmation-divider">

    <div class="confirmation-items">

        <h4>Items Ordered</h4>

        <div class="confirmation-items-grid">

            @foreach($items as $item)

                <div class="confirmation-item">

                    <div class="confirmation-item-image">
                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}">
                    </div>

                    <div class="confirmation-item-info">

                        <p class="confirmation-item-name">{{ $item['name'] }}</p>
                        <p class="confirmation-item-price">{{ $item['price'] }}</p>

                        @foreach($item['meta_lines'] as $line)
                            <p class="confirmation-item-meta">{{ $line }}</p>
                        @endforeach

                    </div>

                </div>

            @endforeach

        </div>

    </div>

    <div class="confirmation-details-grid">

        <div class="confirmation-box">
            <h5>Billing Info</h5>
            @foreach($billingLines as $line)
                <p>{{ $line }}</p>
            @endforeach
        </div>

        <div class="confirmation-box">
            <h5>Shipping Info</h5>
            @foreach($shippingLines as $line)
                <p>{{ $line }}</p>
            @endforeach
        </div>

        <div class="confirmation-box">
            <h5>Payment Info</h5>
            <p>{{ $paymentMethod }}</p>
        </div>

    </div>

    <div class="confirmation-amount-summary">

        <h5>Amount Summary</h5>

        @foreach($amountSummary as $row)
            <div class="confirmation-amount-row">
                <span>{{ $row['label'] }}</span>
                <span>{{ $row['value'] }}</span>
            </div>
        @endforeach

        <div class="confirmation-amount-row confirmation-total-row">
            <span>Total (PKR)</span>
            <span>{{ $totalAmount }}</span>
        </div>

    </div>

</div>

@endsection