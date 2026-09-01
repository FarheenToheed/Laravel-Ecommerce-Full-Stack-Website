<?php

namespace App\Http\Controllers\Web;

use App\Models\Wishlist;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function add(Request $request)
    {
        // if(!Auth::check()){
        //     return response()->json([
        //     'status' => false,
        //     'login' => true,
        // ]);
        // }
        

        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);
        
        Wishlist::firstOrCreate([
            'user_id'=> Auth::id(),
            'product_id'=> $request->product_id,
        ]);
        return response()->json([
        'status' => true,
        'message' => 'Product is added to your wishlist!',
    ]);
    }

    // Wishlist Page
    // public function index(){
    //     $wishlists = Wishlist::with(['product.product_images',
    //     'product.product_variants.product_size','product.sub_category'])
    //     ->where('user_id', Auth::id())->latest()->get();
    //     return view('web.pages.wishlist.index', compact('wishlists'));
    // }

public function index()
{
    $wishlists = auth()->user()->wishlists()
        ->with(['product.product_variants', 'product.product_images', 'product.sub_category'])
        ->latest()
        ->get();

    return view('web.pages.wishlist.index', compact('wishlists'));
}
    

    // remove product from wishlist
    public function remove($id)
    {
        $wishlist = Wishlist::findOrFail($id);

    if ($wishlist->user_id !== Auth::id()) {
        abort(403);
    }

    $wishlist->delete();

    return back()->with('success', 'Product removed from wishlist.');

    }
}
