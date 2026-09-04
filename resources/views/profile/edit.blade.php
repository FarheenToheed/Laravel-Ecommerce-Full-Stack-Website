{{-- resources/views/web/pages/account/all-cases.blade.php --}}
@extends('web.layout.master')

@section('title', 'All Cases')

@section('content')

<style>
    nav.bg-white,
    x-app-layout nav {
        display: none !important;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('account') }}" style="text-decoration:none; color:inherit;">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Profile') }}
            </h2>
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="display:flex; gap:30px;">

            {{-- LEFT: Sidebar --}}
            @include('web.pages.account.partials.side-bar')

            {{-- RIGHT: Edit Profile Options --}}
            <div style="flex:1;" class="space-y-6">

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
@endsection