<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
  id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
      aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="{{ route('admin.dashboard') }}" target="_blank">
      <img src="{{ asset('admin/assets/img/logo-ct-dark.png')}}" width="26px" height="26px"
        class="navbar-brand-img h-100" alt="main_logo">
      <span class="ms-1 font-weight-bold">{{ config('app.name') }}</span>
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <div>
    {{-- <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main"> --}}
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('admin.dashboard') }}">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-display text-dark text-sm opacity-10"></i> <i class=""></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.category.index') }}">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-list text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Category</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{ route('admin.subcategory.index') }}">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-layer-group text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Sub Category</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{ route('admin.childcategory.index') }}">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-sitemap text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Child Category</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{ route('admin.color.index') }}">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-palette text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Color</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{ route('admin.size.index') }}">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-ruler text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Size</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{ route('admin.product.index') }}">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-box text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Product</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{ route('admin.productvariant.index') }}">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-clone text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Product Varients</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{ route('admin.contact.index') }}">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-circle-question text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Users Inquiries</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{ route('admin.orderdetails.index') }}">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-circle-question text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Orders </span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{ route('admin.faq-categories.index') }}">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-circle-question text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Faqs Category </span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{ route('admin.faqs.index') }}">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-circle-question text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Faqs  </span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{ route('admin.tickets.index') }}">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-circle-question text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Tickets</span> </span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{ route('admin.coupons.index') }}">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-circle-question text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Coupon</span> </span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{ route('admin.blogs.index') }}">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-circle-question text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Blogs</span> 
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{ route('admin.pages.index') }}">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-circle-question text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Setting</span>
          </a>
        </li>
        
        <li class="nav-item">
          <form method="POST" action="{{ route('logout') }}" class="d-inline">
            @csrf
            <button type="submit" class="nav-link border-0 bg-transparent text-start w-100">
              <div
                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa-solid fa-right-from-bracket text-dark text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Sign Out</span>
            </button>
          </form>
        </li>
      </ul>
    </div>
</aside>