<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\OrderController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\PagesController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\AccountController;
use App\Http\Controllers\Web\CouponController;
use App\Http\Controllers\Web\WishlistController;
use App\Http\Controllers\Web\CheckoutController;
use App\Http\Controllers\Web\TicketController;
use App\Http\Controllers\Web\FaqController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\BlogController;
use App\Http\Controllers\Web\SearchController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

//User side routes
//static page -> route::get
//crud pages -> route::resource
Route::get('/',[HomeController::class,'index'])->name('home');
// search drawer
Route::get('/search-drawer-data', [SearchController::class, 'drawerData'])->name('search.drawer.data');
Route::get('/search', [SearchController::class, 'search'])->name('search.live');




//Route::get('/products',[ProductController::class,'index'])->name('index');
//Route::get('/search',[ProductController::class,'search'])->name('search');
// Route::get('/about',[PagesController::class,'about'])->name('about');
Route::get('/contact-us',[ContactController::class,'index'])->name('contact');
Route::post('/contact-us',[ContactController::class,'store'])->name('contact.store');
// Route::get('/exchange-return',[PagesController::class,'index'])->name('exchanges_return');
// Route::get('/payment',[PagesController::class,'payment'])->name('payment');
// Route::get('/about-us',[PagesController::class,'about'])->name('about_us');
// Route::get('/privacy-policy.html',[PagesController::class,'privacy'])->name('privacy_policy');

// Route::get('/about', [PagesController::class, 'show'])->name('about')->defaults('slug', 'about');
// Route::get('/exchange-return', [PagesController::class, 'show'])->name('exchanges_return')->defaults('slug', 'exchange-return');
// Route::get('/payment', [PagesController::class, 'show'])->name('payment')->defaults('slug', 'payment');
// Route::get('/about-us', [PagesController::class, 'show'])->name('about_us')->defaults('slug', 'about-us');
// Route::get('/privacy-policy.html', [PagesController::class, 'show'])->name('privacy_policy')->defaults('slug', 'privacy-policy');
// Route::get('/payments.html', [PagesController::class, 'show'])->name('payments')->defaults('slug', 'payments');
// about , contact us and other pages
Route::get('/page/{slug}', [PagesController::class, 'show'])->name('page.show');
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');

Route::get('/Faqs',[FaqController::class,'index'])->name('faqs');




//Route::get('/products/{id}', [ProductController::class, 'index'])->name('products');
// sub categories on home page display
Route::get('/subcategory-trending/{id}', [HomeController::class, 'index'])->name('home.subcategory');
//  Route::get('/subcategory/{id}', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products/details');

// use to fatch products category wise
Route::get('/category/{id}', [CategoryController::class, 'index'])->name('category');
Route::get('/subcategory/{id}', [CategoryController::class, 'subCategory'])->name('subcategory.products');
Route::get('/childcategory/{id}', [CategoryController::class, 'childCategory'])->name('childcategory.products');

    // use to add products into cart
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
  Route::get('/cart/drawer', [CartController::class, 'drawer'])
        ->name('cart.drawer');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/coupons', [CouponController::class, 'index'])->name('coupons.index');
    // checkout route
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.place-order');
Route::get('/order/confirmation/{id}', [CheckoutController::class, 'confirmation'])
    ->name('order.confirmation');


// wishlist user to add / see and remove products form cart
Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');

Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::delete('/wishlist/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');
// cart all routes
Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');

   

    Route::patch('/cart/{cartItem}/increase', [CartController::class, 'increaseQuantity'])
        ->name('cart.increase');

    Route::patch('/cart/{cartItem}/decrease', [CartController::class, 'decreaseQuantity'])
        ->name('cart.decrease');

        Route::delete('/cart/{id}', [CartController::class, 'remove'])
    ->name('cart.remove');
    // Route::delete('/cart/{cartItem}', [CartController::class, 'remove'])
    //     ->name('cart.remove');

    //     Route::delete('/cart/product/{product}', [CartController::class,'removeProduct'])
    //     ->name('cart.remove.product');
        Route::get('/cart/refresh', [CartController::class, 'refresh'])
    ->name('cart.refresh');

    // Naya route for user profile and account
    Route::get('/account', [AccountController::class, 'index'])->name('account');

    // Order History
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

// Single Order Details
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

// Support for User
 Route::get('/support', [TicketController::class, 'create'])->name('support.create');
    Route::post('/support', [TicketController::class, 'store'])->name('support.store');

    Route::get('/support/all-cases', [TicketController::class, 'index'])->name('support.index');

});


// recently comment line for removing admin login
require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
