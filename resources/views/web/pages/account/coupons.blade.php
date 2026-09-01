{{-- resources/views/web/pages/account/coupons.blade.php --}}
@extends('web.layout.master')

@section('title', 'Coupons')

@section('content')

<div class="account-wrapper">

    {{-- Sidebar --}}
    @include('web.pages.account.partials.side-bar')


    {{-- Right Side --}}
    <div class="account-main">

        <div class="order-history-header">

            <div class="order-details-heading">

                <div>
                    <span class="order-label">REWARDS</span>
                    <h2>Coupons</h2>
                </div>

            </div>

        </div>

        <div class="order-detail-card coupons-list">

            <div class="table-responsive">
                <table class="coupons-table">
                    <thead>
                        <tr>
                            <th>Coupon Code</th>
                            <th>Max Discount</th>
                            <th>Value</th>
                            <th>Expiry Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($coupons as $coupon)
                            <tr>
                                <td class="coupon-code">{{ $coupon->coupon_code }}</td>
                                <td>Rs. {{ number_format($coupon->max_discount, 2) }}</td>
                                <td>
                                    {{ $coupon->type === 'percentage' ? $coupon->value.'%' : 'Rs. '.number_format($coupon->value, 2) }}
                                </td>
                                <td>{{ \Carbon\Carbon::parse($coupon->exp_date)->format('d M, Y') }}</td>
                                <td>
                                    <span class="coupon-status coupon-status-{{ $coupon->status }}">
                                        {{ ucfirst($coupon->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="coupons-empty">No coupons available at the moment.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

    </div>

</div>

@endsection