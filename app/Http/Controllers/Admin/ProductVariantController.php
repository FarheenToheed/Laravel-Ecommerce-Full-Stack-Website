<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use App\Models\Size;
use App\Models\Color;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();
        $product_size = Size::all();
        $product_color = Color::all();
        $product_variants=ProductVariant::all();
        return view('admin.pages.productvariant.index',compact('product','product_size', 'product_color','product_variants'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = Product::all(); 
        $product_size = Size::all();
        $product_color = Color::all(); 
        return view('admin.pages.productvariant.index',compact('product','product_size', 'product_color'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'size_id'=> 'nullable|exists:sizes,id',
            'color_id'=> 'nullable|exists:colors,id',
            'price'=> 'required|numeric|min:0'
        ]);
        if (!$request->color_id && !$request->size_id) {
            return redirect()->back()->with('error', 'Select at least a color or a size');
        }

        // $variantExists = ProductVariant::where('product_id', $request->product_id)
        //     ->where('size_id', $request->size_id)->Where('color_id', $request->color_id)->exists();
        
        $variantExists = ProductVariant::where('product_id', $request->product_id)->where(function ($q) use ($request) {
            $q->where('size_id', $request->size_id)->Where('color_id', $request->color_id);
        })->exists();
        if ($variantExists) {
            return redirect()->back()->with('error', 'Product variant for this color or size already exists');
        }

        ProductVariant::create([
            'product_id' => $request->product_id,
            'size_id' => $request->size_id,
            'color_id'=>$request->color_id,
            'price'=>$request->price,
    ]);

    return redirect()->route('admin.productvariant.index')->with('success', 'Product Varient Created Successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product_variants = ProductVariant::find($id);
        if(!$product_variants){
            return redirect()->back()->with('error', 'Product Variant not found');
        }
        
        $product = Product::all();
        $product_size = Size::all();
        $product_color = Color::all();
        return view('admin.pages.productvariant.index',compact('product', 'product_size','product_color'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'size_id'=> 'nullable|exists:sizes,id',
            'color_id'=> 'nullable|exists:colors,id',
            'price'=> 'required|numeric|min:0'
        ]);

    if (!$request->color_id && !$request->size_id) {
        return redirect()->back()->with('error', 'Select at least a color or a size');
    }

        $product_variants = ProductVariant::find($id);
        if(!$product_variants){
            return redirect()->back()->with('error', 'Product Variant not found');
        }
         $product_variants->update([
            'product_id' => $request->product_id,
            'size_id' => $request->size_id,
            'color_id'=>$request->color_id,
            'price'=>$request->price,
    ]);    
    return redirect()->route('admin.productvariant.index')->with('success', 'Product Variants updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product_variants = ProductVariant::find($id);
        if(!$product_variants){
            return redirect()->back()->with('error', 'Product Variant not found');
        }
        $product_variants->delete();
        return redirect()->back()->with('success','Product Variants Deleted Successfully');
    }
}
