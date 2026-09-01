 
 @forelse($cart->cart_items ?? [] as $item)

    <div class="cart-page-item">

        <div class="cart-page-image">
            @if($item->product->product_images->count())
                <img src="{{ asset('storage/'.$item->product->product_images->first()->image_path) }}" alt="Product">
            @else
                <img src="{{ asset('web/assets/images/demo-product.jpg') }}" alt="Product">
            @endif
        </div>

        <div class="cart-page-details">

            <h5>{{ strtoupper($item->product->name) }}</h5>

            @if($item->variant && $item->variant->product_size)
                <p class="cart-page-size">Size: {{ $item->variant->product_size->name }}</p>
            @endif

            <div class="cart-page-actions-icons">
                <a href="{{ route('products/details', $item->product->id) }}"><i class="fa-regular fa-pen-to-square"></i></a>
                <button class="cart-page-remove" data-item-id="{{ $item->id }}"><i class="fa-regular fa-trash-can"></i></button>
            </div>

            <p class="cart-page-stock {{ $item->product->stock > 0 ? 'in-stock' : 'out-stock' }}">
                {{ $item->product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
            </p>

        </div>

        <div class="cart-page-price">
            Rs.{{ number_format($item->price) }}
        </div>

        <div class="cart-page-qty">
            <div class="qty-box">
                <button class="qty-minus" data-item-id="{{ $item->id }}">−</button>
                <span>{{ $item->quantity }}</span>
                <button class="qty-plus" data-item-id="{{ $item->id }}" data-max-stock="{{ $item->product->stock }}">+</button>
            </div>
        </div>

        <div class="cart-page-total">
            Rs.{{ number_format($item->total_price) }}
        </div>

    </div>

@empty

<div class="cart-empty">

    <div class="cart-empty-icon">
        <i class="fa-solid fa-cart-shopping"></i>
    </div>

    <h4>Your Bag is Empty</h4>

    <a href="{{ route('home') }}" class="continue-shopping-btn">
        CONTINUE SHOPPING
    </a>

</div>

@endforelse