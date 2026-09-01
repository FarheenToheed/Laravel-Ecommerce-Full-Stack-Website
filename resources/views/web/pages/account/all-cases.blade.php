{{-- resources/views/web/pages/account/all-cases.blade.php --}}
@extends('web.layout.master')

@section('title', 'All Cases')

@section('content')

<div class="account-wrapper">

    {{-- Sidebar --}}
    @include('web.pages.account.partials.side-bar')


    {{-- Right Side --}}
    <div class="account-main">

        <div class="order-history-header">

            <div class="order-details-heading">

                <div>
                    <span class="order-label">SUPPORT</span>
                    <h2>All Cases</h2>
                </div>

            </div>

        </div>

        <div class="order-detail-card cases-list">

            @forelse($tickets as $ticket)

                <div class="detail-product-row">

                    <div class="detail-product-info">

                        <div class="case-item-header">
                            <h4>{{ $ticket->subject }}</h4>
                            <span class="case-status case-status-{{ $ticket->status }}">
                                {{ strtoupper($ticket->status) }}
                            </span>
                        </div>

                        <p>{{ $ticket->message }}</p>

                        <p class="case-item-date">{{ $ticket->created_at->format('d M, Y') }}</p>

                    </div>

                </div>

            @empty

                <p class="cases-empty">You haven't submitted any queries yet.</p>

            @endforelse

        </div>

    </div>

</div>

@endsection