<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Store')</title>

    
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Hamari CSS File -->
    <link rel="stylesheet" href="{{ asset('web/assets/css/style.css') }}">

    {{-- bootstrap css cdn --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
   
    <!-- Har page apni extra CSS yahan daal sakta hai -->
    {{-- @yield('styles') --}}
    @stack('styles')
</head>

<body>

    {{-- HEADER - header.blade.php se aa raha hai --}}
    @include('web.layout.header')

    {{-- MAIN CONTENT - har page apna content yahan daalega --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER - footer.blade.php se aa raha hai --}}
    @include('web.layout.footer')

    {{-- jQuery (Zaroori hai cart.js/app.js ke liye) --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    {{-- product slider js --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <script>
    const cartDrawerUrl = "{{ route('cart.drawer') }}";
    const cartPageRefreshUrl = "{{ route('cart.refresh') }}";
    const searchDrawerDataUrl = "{{ route('search.drawer.data') }}";
    const searchLiveUrl = "{{ route('search.live') }}";
</script>
    <!-- Hamari JS File -->
    <script src="{{ asset('web/assets/js/app.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>