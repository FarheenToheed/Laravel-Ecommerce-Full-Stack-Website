@extends('admin.layout.master')

@section('main')

    <div class="container-fluid py-4">

        <div class="row justify-content-center">

            <div class="col-md-10">

                <div class="card">

                    {{-- HEADER --}}
                    <div class="card-header d-flex justify-content-between align-items-center">

                        <h5 class="mb-0">
                            Order Details #{{ $order->id }}
                        </h5>

                        <a href="{{ route('admin.orderdetails.index') }}"
                            class="btn btn-primary">

                            Back to Orders

                        </a>

                    </div>

                    <div class="card-body">

                        {{-- ORDER INFORMATION --}}
                        <h6 class="mb-3">
                            Order Information
                        </h6>

                        <div class="table-responsive">

                            <table class="table table-bordered align-middle">

                                <tbody>

                                    <tr class="text-sm">

                                        <th>
                                            Order ID
                                        </th>

                                        <td>
                                            #{{ $order->id }}
                                        </td>

                                    </tr>

                                    <tr class="text-sm">

                                        <th>
                                            Order Status
                                        </th>

                                        <td>
                                            {{ ucfirst($order->status) }}
                                        </td>

                                    </tr>

                                    <tr class="text-sm">

                                        <th>
                                            Order Date
                                        </th>

                                        <td>
                                            {{ $order->created_at?->format('d M Y, h:i A') ?? 'Not Available' }}
                                        </td>

                                    </tr>

                                </tbody>

                            </table>

                        </div>


                        {{-- CUSTOMER INFORMATION --}}
                        <h6 class="mt-4 mb-3">
                            Customer Information
                        </h6>

                        <div class="table-responsive">

                            <table class="table table-bordered align-middle">

                                <tbody>

                                    <tr class="text-sm">

                                        <th>
                                            Name
                                        </th>

                                        <td>
                                            {{ $order->user?->name ?? 'Guest User' }}
                                        </td>

                                    </tr>

                                    <tr class="text-sm">

                                        <th>
                                            Email
                                        </th>

                                        <td>
                                            {{ $order->user?->email ?? 'Not Available' }}
                                        </td>

                                    </tr>

                                </tbody>

                            </table>

                        </div>


                        {{-- SHIPPING INFORMATION --}}
                        <h6 class="mt-4 mb-3">
                            Shipping Information
                        </h6>

                        <div class="table-responsive">

                            <table class="table table-bordered align-middle">

                                <tbody>

                                    <tr class="text-sm">

                                        <th>
                                            Address
                                        </th>

                                        <td>
                                            {{ $order->shipping?->address ?? 'Not Available' }}
                                        </td>

                                    </tr>

                                    <tr class="text-sm">

                                        <th>
                                            City
                                        </th>

                                        <td>
                                            {{ $order->shipping?->city ?? 'Not Available' }}
                                        </td>

                                    </tr>

                                    <tr class="text-sm">

                                        <th>
                                            Province
                                        </th>

                                        <td>
                                            {{ $order->shipping?->province ?? 'Not Available' }}
                                        </td>

                                    </tr>

                                    <tr class="text-sm">

                                        <th>
                                            Country
                                        </th>

                                        <td>
                                            {{ $order->shipping?->country ?? 'Not Available' }}
                                        </td>

                                    </tr>

                                    <tr class="text-sm">

                                        <th>
                                            Phone
                                        </th>

                                        <td>
                                            {{ $order->shipping?->phone_no ?? 'Not Available' }}
                                        </td>

                                    </tr>

                                </tbody>

                            </table>

                        </div>


                        {{-- ORDERED PRODUCTS --}}
                        <h6 class="mt-4 mb-3">
                            Ordered Products
                        </h6>

                        <div class="table-responsive">

                            <table class="table table-bordered align-middle">

                                <thead>

                                    <tr>

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Product
                                        </th>

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Size
                                        </th>

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Color
                                        </th>

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Quantity
                                        </th>

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Price
                                        </th>

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Total
                                        </th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @forelse($order->order_items as $item)

                                        @php
                                            $price = $item->variant?->price ?? 0;
                                            $itemTotal = $price * $item->quantity;
                                        @endphp

                                        <tr class="text-sm">

                                            <td>
                                                {{ $item->product?->name ?? 'Product Removed' }}
                                            </td>

                                            <td>
                                                {{ $item->variant?->product_size?->name ?? '-' }}
                                            </td>

                                            <td>
                                                {{ $item->variant?->product_color?->name ?? '-' }}
                                            </td>

                                            <td>
                                                {{ $item->quantity }}
                                            </td>

                                            <td>
                                                Rs. {{ number_format($price, 2) }}
                                            </td>

                                            <td>
                                                Rs. {{ number_format($itemTotal, 2) }}
                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td colspan="6"
                                                class="text-center text-muted">

                                                No products found

                                            </td>

                                        </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>


                        {{-- ORDER SUMMARY --}}
                        <h6 class="mt-4 mb-3">
                            Order Summary
                        </h6>

                        <div class="table-responsive">

                            <table class="table table-bordered align-middle">

                                <tbody>

                                    <tr class="text-sm">

                                        <th>
                                            Subtotal
                                        </th>

                                        <td>
                                            Rs. {{ number_format($order->subtotal, 2) }}
                                        </td>

                                    </tr>

                                    <tr class="text-sm">

                                        <th>
                                            Tax
                                        </th>

                                        <td>
                                            Rs. {{ number_format($order->tax, 2) }}
                                        </td>

                                    </tr>

                                    <tr class="text-sm">

                                        <th>
                                            Grand Total
                                        </th>

                                        <td>
                                            Rs. {{ number_format($order->total, 2) }}
                                        </td>

                                    </tr>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection