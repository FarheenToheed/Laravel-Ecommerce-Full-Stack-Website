{{-- resources/views/web/pages/account/support.blade.php --}}
@extends('web.layout.master')

@section('title', 'Support')

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
                    <h2>Submit Your Query</h2>
                </div>

            </div>

        </div>


        <div class="order-detail-card">

            @if(session('success'))
                <div class="support-success-msg">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('support.store') }}" class="support-form">
                @csrf

                <div class="support-field">
                    <label>Case Email <span class="required">*</span></label>
                    <input type="email" value="{{ $userEmail }}" disabled>
                </div>

                <div class="support-field">
                    <label>Subject: <span class="required">*</span></label>
                    <input type="text" name="subject" value="{{ old('subject') }}" required>
                </div>

                <div class="support-field">
                    <label>Description:</label>
                    <textarea name="description" rows="6" required>{{ old('description') }}</textarea>
                </div>

                <button type="submit" class="support-submit-btn">SUBMIT</button>

            </form>

        </div>

    </div>

</div>

@endsection