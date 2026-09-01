<!-- HEADER -->
<header class="header">
    <div class="header-main">

        {{-- Hamburger --}}
        <button class="hamburger" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </button>

        {{-- Overlay --}}
        <div class="menu-overlay" id="menuOverlay" onclick="toggleMenu()"></div>

        {{-- Side Menu --}}
        <div class="side-menu" id="sideMenu">

            {{-- Close --}}
            <button class="close-btn" onclick="toggleMenu()">
                <i class="fa-solid fa-xmark"></i>
            </button>

            {{-- Top Categories --}}
            <div class="menu-top">

                @foreach($categories as $category)

                    <div class="main-cat {{ $loop->first ? 'active' : '' }}" onclick="showSubCat({{ $category->id }},this)">

                        {{ $category->name }}

                    </div>

                @endforeach

            </div>



            {{-- Body --}}
            <div class="menu-content">


                {{-- LEFT SIDE (Sub Categories) --}}
                <div class="menu-left">

                    @foreach($categories as $category)

                        <div class="sub-group" id="sub_{{ $category->id }}"
                            style="{{ $loop->first ? '' : 'display:none' }}">

                            {{-- @foreach($category->sub_categories as $sub) --}}
                            @foreach($category->sub_categories ?? [] as $sub)

                                <div class="sub-cat">

                                    @if($sub->child_categories->count())
                                        {{-- Child-categories hain -> naam pe click karne se sirf expand hoga, products page pe NAHI
                                        jayega --}}
                                        <span class="sub-cat-link sub-cat-expandable" onclick="showChildCat({{ $sub->id }}, this)">
                                            {{ $sub->name }}
                                        </span>
                                    @else

                                        {{-- Child-categories nahi hain -> seedha is sub-category ke products dikhao --}}
                                        <a href="{{ route('subcategory.products', $sub->id) }}" class="sub-cat-link">
                                            {{ $sub->name }}
                                        </a>

                                    @endif

                                </div>

                                {{-- <div class="sub-cat" onclick="showChildCat({{ $sub->id }},this)">

                                    {{ $sub->name }}

                                    @if($sub->child_categories->count())

                                    <i class="fa-solid fa-angle-right"></i>

                                    @endif

                                </div> --}}

                            @endforeach

                        </div>

                    @endforeach

                </div>



                {{-- RIGHT SIDE (Child Categories) --}}
                <div class="menu-right">

                    @foreach($categories as $category)

                        @foreach($category->sub_categories ?? [] as $sub)

                            <div class="child-group" id="child_{{ $sub->id }}" style="display:none">

                                @foreach($sub->child_categories as $child)

                                    <a href="{{ route('childcategory.products', $child->id) }}" class="child-cat">

                                        {{ $child->name }}

                                    </a>

                                @endforeach

                            </div>

                        @endforeach

                    @endforeach

                </div>

            </div>

        </div>

        {{-- Overlay --}}
        <div class="menu-overlay" id="menuOverlay" onclick="toggleMenu()"></div>
        <a href="{{ route('home') }}" class="logo">{{ config('app.name') }}</a>

        <div class="header-icons">
            {{-- Search --}}
            <a href="#" data-bs-toggle="offcanvas" data-bs-target="#searchDrawer">
                <i class="fa-solid fa-magnifying-glass"></i>
            </a>

            
            {{-- Auth/Login/Register --}}
            @auth
                <a href="{{ route('account') }}">
                    <i class="fa-regular fa-user"></i>
                </a>
            @else
                <a href="#" onclick="toggleAuth(); return false;">
                    <i class="fa-regular fa-user"></i>
                </a>
            @endauth

            {{-- Cart --}}
            <a href="#" style="position:relative" data-bs-toggle="offcanvas" data-bs-target="#shoppingCart">
                <i class="fa-solid fa-bag-shopping"></i>
                <span class="cart-count">
                    {{ auth()->check() && auth()->user()->cart ? auth()->user()->cart->cart_items->sum('quantity') : 0 }}
                </span>
            </a>


            {{-- <a href="{{ route('index') }}" style="position:relative">
                <i class="fa-solid fa-bag-shopping"></i>
                <span class="cart-count">0</span>
            </a> --}}
        </div>
    </div>

    {{-- <nav class="header-nav">
        <ul>

            <li><a href="#">Woman</a></li>
            <li><a href="#">Man</a></li>
            <li><a href="#">Fragrances</a></li>
        </ul>
    </nav> --}}
</header>

@include('web.layout.search-drawer')
@include('web.layout.auth-drawer')
@include('web.layout.cart-drawer')
@if(session('auth-drawer'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            toggleAuth();
        });
    </script>
@endif


<!-- SEARCH OVERLAY -->
{{-- <div class="search-overlay" id="searchOverlay">
    <button class="search-close" onclick="toggleSearch(event)">&times;</button>
    <div class="search-box">
        <form action="{{ route('search') }}" method="GET">
            <input type="text" name="q" placeholder="Search products..." autofocus>
        </form>
    </div>
</div> --}}