{{-- 
@extends('web.layout.master')

@section('title', 'Home - My Store')

@section('content')

<div class="all-products-wrapper">

    <div class="all-products-grid">
        @foreach($allproducts as $product)
            @include('web.pages.product.partials.product-card', ['product' => $product])
        @endforeach
    </div>

    <div class="pagination-wrapper">
        {{ $allproducts->links() }}
    </div>

</div>

@endsection --}}

@extends('web.layout.master')

@section('title', 'Home - My Store')

@section('content')

<div class="all-products-wrapper">

    <div class="all-products-grid">

        @foreach($allproducts as $product)           

            @include('web.pages.product.partials.product-card', $product)

        @endforeach

    </div>

    {{-- View All button yahan (agar page pe sab products na dikhane hon) --}}
    <div class="pagination-wrapper">
        {{ $allproducts->links() }}
    </div>
    {{-- infinite scrolling through ajax --}}

</div>

@endsection