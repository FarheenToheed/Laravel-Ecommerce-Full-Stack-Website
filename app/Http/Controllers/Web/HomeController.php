<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SubCategory;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Sabse zyada order hue product IDs nikalo (Trending ke liye)
        $topProductIds = DB::table('order_items')
            ->select('product_id', DB::raw('SUM(quantity) as total_qty'))
            ->groupBy('product_id')
            ->orderByDesc('total_qty')
            ->limit(8)
            ->pluck('product_id');

        $products = Product::with([
                'product_images',
                'product_variants.product_size',
                'sub_category'
            ])
            ->where('status', 'active')
            ->whereIn('id', $topProductIds)
            ->get();

        $allproducts = Product::with([
                'product_images',
                'product_variants.product_size',
                'sub_category.category',
                'child_category'
            ])
            ->where('status', 'active')
            ->whereHas('product_variants',function($pro){
                $pro->where('price','>',0);
            })
            ->latest()
            ->paginate(15);

        return view('web.pages.home.index', compact('products', 'allproducts'));
    }

//     public function index($id = null)
// {
//     $products = Product::with([
//         'product_images',
//         'product_variants.product_size',
//         'sub_category'
//     ]);

//     if ($id) {
//         $products->where('sub_category_id', $id);
//     }

//     $products->where('status', 'active');

//     $products = $products->paginate(8);

//     return view('web.pages.home.index', compact('products'));
// }

//     public function index($id = null)
// {

//     $products = Product::with(['product_images', 'product_variants']);

//     if ($id) {
//         $products->where('sub_Category_id', $id);
//     }
//     $products->where('status', 'active');
//     $products = $products->paginate(8);

//     return view('web.pages.home.index', compact('products'));
// }


    /**
     * Show the form for creating a new resource.
     */
   
}
