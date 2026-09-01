<?php

namespace App\Http\Controllers\Web;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $allproducts = Product::with([
            'product_images',
            'product_variants.product_size',
            'sub_category.category',
            'child_category'
        ])
        ->where('status', 'active')
        ->whereHas('product_variants', function($pro){
            $pro->where('price','>',0);
        })
        ->paginate(15);

        return view('web.pages.product.index', compact('allproducts'));
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
{
    $product = Product::with([
        'product_images',
        'product_variants.product_size',
        'product_variants.product_color',
        'sub_category.category',
        'child_category'
    ])
    ->where('status', 'active')
    ->whereHas('product_variants',function($pro){
            $pro->where('price','>','0');
    })
    ->findOrFail($id);

    // Sirf unique sizes aur colors nikal rahe hain (duplicate na aayein)
    $product->available_sizes = $product->product_variants->pluck('product_size')->filter()->unique('id');
    $product->available_colors = $product->product_variants->pluck('product_color')->filter()->unique('id');

    // Price aur uski 3 installments nikal rahe hain
    $product->current_price = optional($product->product_variants->first())->price ?? 0;
    $product->installment_amount = $product->current_price > 0 ? round($product->current_price / 3) : 0;

    return view('web.pages.product.show', compact('product'));
}

   
}
