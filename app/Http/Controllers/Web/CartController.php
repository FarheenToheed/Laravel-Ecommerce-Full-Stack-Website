<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        if (! Auth::check()) {
            return response()->json([
                'status' => false,
                'login' => true,
                // change msg
                'message' => 'Plz login first.',
            ]);
        }

        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'product_variant_id' => ['nullable', 'exists:product_variants,id'],
            'quantity' => ['nullable', 'integer', 'min:1'],
        ]);

        $quantity = $request->quantity ?? 1;

        DB::transaction(function () use ($request, $quantity) {
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
            $product = Product::findOrFail($request->product_id);

            if ($request->filled('product_variant_id')) {
                $variant = ProductVariant::findOrFail($request->product_variant_id);
            } else {
                $variant = $product->product_variants()->first();
            }

            $price = $variant?->price ?? 0;

            $cartItem = CartItem::where('cart_id', $cart->id)
                ->where('product_id', $product->id)
                ->where('product_variant_id', $variant?->id)
                ->first();

            if ($cartItem) {
                $cartItem->quantity += $quantity;
                $cartItem->total_price = $cartItem->quantity * $cartItem->price;
                $cartItem->save();
            } else {
                // $cart->cart_items()->create([

                // ])
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'product_variant_id' => $variant?->id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'total_price' => $price * $quantity,
                ]);
            }
        });

        $cart = Cart::with(['cart_items.product.product_images', 'cart_items.variant.product_size'])
            ->where('user_id', Auth::id())
            ->first();

        return response()->json([
            'status' => true,
            'message' => 'Product added to bag successfully.',
            'html' => view(
                'web.layout.partials.cart-item',
                compact('cart')
            )->render(),
            'count' => $cart->cart_items->sum('quantity'),
        ]);
    }

    //  Shopping Bag Page
    public function index()
    {
        $cart = Cart::with([
            'cart_items.product.product_images',
            'cart_items.variant.product_size',
        ])->where('user_id', Auth::id())->first();

        return view('web.pages.cart.index', compact('cart'));
    }

    public function drawer()
    {
        $cart = Cart::with([
            'cart_items.product.product_images',
            'cart_items.variant.product_size',
        ])
            ->where('user_id', Auth::id())
            ->first();

        $html = view(
            'web.layout.partials.cart-item',
            compact('cart')
        )->render();

        return response()->json([
            // 'html' => $html,
            'html' => view(
        'web.layout.partials.cart-item',
        compact('cart')
    )->render(),

    'page_html' => view(
        'web.layout.partials.cart-page',
        compact('cart')
    )->render(),
            'count' => $cart ? $cart->cart_items->sum('quantity') : 0,
            'subtotal' => number_format($cart ? $cart->cart_items->sum('total_price') : 0),
        ]);
    }
    public function refresh()
{
    $cart = Cart::with([
        'cart_items.product.product_images',
        'cart_items.variant.product_size',
    ])
    ->where('user_id', Auth::id())
    ->first();

    return response()->json([
        'html' => view('web.layout.partials.cart-page', compact('cart'))->render(),
        'count' => $cart ? $cart->cart_items->sum('quantity') : 0,
        'subtotal' => number_format($cart ? $cart->cart_items->sum('total_price') : 0),
    ]);
}

    public function increaseQuantity(CartItem $cartItem)
    {
        // Sirf apne cart ka item update ho
        if ($cartItem->cart->user_id != Auth::id()) {
            abort(403);
        }

        // Stock Check
        if ($cartItem->quantity >= $cartItem->product->stock) {
            return response()->json([
                'status' => false,
                'message' => 'Maximum '.$cartItem->product->stock.' pieces of this item can be added to Cart.',
            ]);
        }

        $cartItem->quantity += 1;
        $cartItem->total_price = $cartItem->quantity * $cartItem->price;
        $cartItem->save();

        return $this->drawer();
    }

    public function decreaseQuantity(CartItem $cartItem)
    {
        if ($cartItem->cart->user_id != Auth::id()) {
            abort(403);
        }

        // Quantity 1 se niche nahi jayegi
        if ($cartItem->quantity > 1) {

            $cartItem->quantity -= 1;
            $cartItem->total_price = $cartItem->quantity * $cartItem->price;
            $cartItem->save();

        }

        return $this->drawer();
    }

public function remove($id)
{
    // Pehle CartItem ID check karo
    $cartItem = CartItem::where('id', $id)
        ->whereHas('cart', function ($q) {
            $q->where('user_id', Auth::id());
        })
        ->first();

    // Agar CartItem ID nahi mili to Product ID samjho
    if (!$cartItem) {

        $cartItem = CartItem::where('product_id', $id)
            ->whereHas('cart', function ($q) {
                $q->where('user_id', Auth::id());
            })
            ->first();

        if (!$cartItem) {
            return response()->json([
                'status' => false
            ]);
        }
    }

    $productId = $cartItem->product_id;

    $cartItem->delete();

    return response()->json([
        'status'     => true,
        'product_id' => $productId,
        'drawer'     => $this->drawer()->getData(true),
    ]);
}

//     public function remove(CartItem $cartItem)
// {
//     if ($cartItem->cart->user_id != Auth::id()) {
//         abort(403);
//     }

//     $productId = $cartItem->product_id;

//     $cartItem->delete();

//     return response()->json([
//         'status'     => true,
//         'removed'    => true,
//         'product_id' => $productId,
//         'drawer'     => $this->drawer()->getData(true),
//     ]);
// }

    // public function remove(CartItem $cartItem)
    // {
    //     if ($cartItem->cart->user_id != Auth::id()) {
    //         abort(403);
    //     }

    //     $cartItem->delete();

    //     return $this->drawer();
    // }

    // public function removeProduct(Product $product)
    // {
    //     $cart = Cart::where('user_id', Auth::id())->first();

    //     if (! $cart) {
    //         return response()->json([
    //             'status' => false,
    //         ]);
    //     }

    //     CartItem::where('cart_id', $cart->id)
    //         ->where('product_id', $product->id)
    //         ->delete();

    //     return response()->json([
    //         'status' => true,
    //         'removed' => true,
    //         'message' => 'Removed from bag.',
    //     ]);
    // }

    
}
