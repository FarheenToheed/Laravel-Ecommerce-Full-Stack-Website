@extends('web.layout.master')

@section('title', 'Order History')

@section('content')

    <div class="account-wrapper">

        {{-- LEFT SIDEBAR --}}
        @include('web.pages.account.partials.side-bar')

        {{-- RIGHT MAIN CONTENT --}}
        <div class="account-main">

            <div class="order-history-header">

                <h2>ORDER HISTORY</h2>

                <p>
                    View your previous orders and order details.
                </p>

            </div>


            {{-- SUCCESS MESSAGE --}}
            @if(session('success'))

                <div class="alert alert-success">
                    {{ session('success') }}
                </div>

            @endif


            {{-- ORDERS --}}
            @forelse($orders as $order)

                <div class="order-card">

                    {{-- ORDER HEADER --}}
                    <div class="order-card-header">

                        <div>
                            <span class="order-label">
                                ORDER ID
                            </span>

                            <strong>
                                #{{ $order->id }}
                            </strong>
                        </div>


                        <div>
                            <span class="order-label">
                                ORDER DATE
                            </span>

                            <strong>
                                {{ $order->created_at->format('d M Y') }}
                            </strong>
                        </div>


                        <div>
                            <span class="order-label">
                                STATUS
                            </span>

                            <span class="order-status status-{{ $order->status }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="order-card-footer">
                        <div>
                            <span>Total</span>
                            <strong>
                                PKR {{ number_format($order->total, 2) }}
                            </strong>
                        </div>

                        <a href="{{ route('orders.show', $order->id) }}" class="order-view-btn">

                            View Details

                        </a>
                    </div>




                </div>

            @empty

                <div class="empty-orders">

                    <h3>No Orders Found</h3>

                    <p>
                        You have not placed any orders yet.
                    </p>

                    <a href="{{ route('products') }}" class="order-shop-btn">

                        Continue Shopping

                    </a>

                </div>

            @endforelse


            {{-- PAGINATION --}}
            @if($orders->hasPages())

                <div class="order-pagination">

                    {{ $orders->links() }}

                </div>

            @endif

        </div>

    </div>

@endsection