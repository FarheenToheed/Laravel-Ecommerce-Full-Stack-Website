@extends('web.layout.master')

@section('title', 'Contact Us – Sapphire')

@section('content')

    <div class="contact-page">
        
        {{-- PAGE HEADING --}}
        <div class="contact-heading">
            <h1>CONTACT US</h1>
        </div>

        {{-- MAIN CONTENT --}}
        <div class="contact-wrapper">

            <div class="contact-grid">

                {{-- ===== LEFT: FORM ===== --}}
                <div class="contact-form-side">

                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf

                        {{-- Name --}}
                        <div class="form-group">
                            <label for="name">Your Name <span>*</span></label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Your Name">
                            @error('name')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="form-group">
                            <label for="email">Your Email <span>*</span></label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Your Email">
                            @error('email')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Phone --}}
                        <div class="form-group">
                            <label for="phone">Your Phone Number <span>*</span></label>
                            <div class="phone-wrapper">
                                <span class="phone-flag">🇵🇰 +92</span>
                                <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                                    placeholder="Phone Number">
                            </div>
                            @error('phone')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Subject --}}
                        <div class="form-group">
                            <label for="subject">Subject <span>*</span></label>
                            <input type="text" id="subject" name="subject" value="{{ old('subject') }}"
                                placeholder="Subject">
                            @error('subject')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Message --}}
                        <div class="form-group">
                            <label for="message">Your Message <span>*</span></label>
                            <textarea id="message" name="message" placeholder="Your Message">{{ old('message') }}</textarea>
                            @error('message')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Fake captcha ki jagah yeh lagao --}}
                        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}">
                        </div>
                        @error('captcha')
                            <span class="error-text">{{ $message }}</span>
                        @enderror

                        {{-- Submit --}}
                        <button type="submit" class="btn-submit">SUBMIT</button>

                    </form>
                </div>

                {{-- ===== RIGHT: CONTACT INFO ===== --}}
                <div class="contact-info-side">
                    <h2>CONTACT INFORMATION</h2>

                    <p>
                        Sapphire Retail Head Office 1.5-Km, Defence Road,
                        Bhobtian Chowk, Off Raiwind Road, Opposite University
                        of Lahore, Lahore.
                    </p>

                    <a href="mailto:wecare@sapphireonline.pk" style="color: #000;">
                        wecare@sapphireonline.pk
                    </a>

                    <a href="tel:+9204232388245" style="color: #000;">
                        +92(0)42 323-882-45
                    </a>

                    <a href="tel:+92042111738245" style="color: #000;">
                        +92(0)42 111-738-245
                    </a>
                </div>

            </div>
        </div>
    </div>

@endsection