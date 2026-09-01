
@forelse($cart->cart_items ?? [] as $item)

            <div class="cart-item">

                <div class="cart-image">

                    @if($item->product->product_images->count())
                        <img src="{{ asset('storage/'.$item->product->product_images->first()->image_path) }}" alt="Product">
                    @else
                        <img src="{{ asset('web/assets/images/demo-product.jpg') }}" alt="Product">
                    @endif

                </div>

                <div class="cart-details">

                    <h5>{{ $item->product->name }}</h5>

                    <p class="cart-price">
                        Rs.{{ number_format($item->price) }}
                    </p>

                    <p class="cart-stock">
                        In Stock
                    </p>

                    <div class="cart-bottom">

                        <div class="qty-box">

                            <button class="qty-minus" data-item-id="{{ $item->id }}">
                                −
                            </button>

                            <span>
                                {{ $item->quantity }}
                            </span>

                            <button class="qty-plus" data-item-id="{{ $item->id }}"
                                data-max-stock="{{ $item->product->stock }}">
                                +
                            </button>

                        </div>

                        <button class="remove-item" data-item-id="{{ $item->id }}">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>

                    </div>

                </div>

            </div>

        {{-- @empty

            <p class="cart-empty-text">Your bag is empty.</p>

        @endforelse --}}
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