@extends('web.layout.master')

@section('title', 'My Account - My Store')

@section('content')

<div class="account-wrapper">

    {{-- LEFT SIDEBAR --}}
     @include('web.pages.account.partials.side-bar')

    {{-- RIGHT MAIN CONTENT --}}
    <div class="account-main">

        <h2 class="account-welcome">WELCOME {{ strtoupper($user->name) }}!</h2>

        {{-- Store Credit --}}
        <div class="account-card account-card-row">
            <span class="account-card-title">STORE CREDIT</span>
            <span class="account-credit">PKR 0.00</span>
        </div>

        {{-- Profile --}}
        <div class="account-card">

            <div class="account-card-header">
                <h4>PROFILE</h4>
            </div>

            <div class="account-profile-row">
                <div class="account-profile-col">
                    <p class="account-label">Name</p>
                    <p class="account-value">{{ $user->name }} {{ $user->lastname }}</p>
                </div>
                <div class="account-profile-col">
                    <p class="account-label">Email</p>
                    <p class="account-value">{{ $user->email }}</p>
                </div>
            </div>

            <a href="{{ route('profile.edit') }}" class="account-edit-link">Edit Profile</a>

        </div>

    </div>

</div>

@endsection