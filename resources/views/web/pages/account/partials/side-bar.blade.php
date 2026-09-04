{{-- LEFT SIDEBAR --}}
    <div class="account-sidebar">

        <h4>
        <a href="{{ route('account') }}" style="color:inherit; text-decoration:none;">
            Dashboard
        </a>
    </h4>

        <ul>
            <li>
                <a href="{{ route('orders.index') }}">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    Order History
                </a>
            </li>
            

            <li>
                <a href="{{ route('wishlist.index') }}">
                    <i class="fa-regular fa-heart"></i>
                    Wishlist
                </a>
            </li>
            <li>
                <a href="{{ route('coupons.index') }}">
                    <i class="fa-solid fa-ticket"></i>
                    Coupons
                </a>
            </li>
            <li>
                <a href="{{ route('support.create') }}">
                    <i class="fa-regular fa-folder-open"></i>
                    Support
                </a>
            </li>
            <li>
                <a href="{{ route('support.index') }}">
                    <i class="fa-regular fa-folder-open"></i>
                    All Cases
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Sign Out</button>
                </form>
            </li>
        </ul>

    </div>