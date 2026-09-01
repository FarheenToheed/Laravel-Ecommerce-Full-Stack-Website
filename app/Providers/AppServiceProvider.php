<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $categories = Category::with('sub_Categories.child_Categories')->get();
        view()->share('categories', $categories);

        // Cart - sirf cart-drawer view ke liye
        View::composer('web.layout.cart-drawer', function ($view) {
            $cart = null;

            if (Auth::check()) {
                $cart = Cart::with(['cart_items.product.product_images', 'cart_items.variant.product_size'])
                    ->where('user_id', Auth::id())
                    ->first();
            }

            $view->with('cart', $cart);
        });
    }
}
