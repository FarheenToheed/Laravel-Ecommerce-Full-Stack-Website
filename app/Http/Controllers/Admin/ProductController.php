<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // pagination, fields limit, select()
        
        $product = Product::all();
        $sub_categories = SubCategory::all();
        $child_categories = ChildCategory::all();
        // Log::info($child_categories);
        return view('admin.pages.product.index',compact('child_categories', 'sub_categories' ,'product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $sub_categories = SubCategory::all();
         $child_categories = ChildCategory::all(); 
         $categories = Category::with('sub_categories.child_categories')->get();   
        return view('admin.pages.product.create',compact('sub_categories','child_categories','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */

public function store(Request $request)
{
    // VALIDATION
    
    $request->validate([
        'sub_category_id'   => 'required|exists:sub_categories,id',
        'child_category_id' => 'required|exists:child_categories,id',
        'name'              => 'required|string|max:255',
        'details'           => 'required',
        'description'       => 'required',
        'size_guide'        => 'required|string|max:255',
        'stock'             => 'required|integer|min:0',
        'status'            => 'required|in:active,inactive',

        // images validation
        'images'   => 'required',
        'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    // CREATE PRODUCT
    $product = Product::create([
        'name'              => $request->name,
        'sku'               => 'PRD-' . strtoupper(uniqid()),
        'details'           => $request->details,
        'description'       => $request->description,
        'size_guide'        => $request->size_guide,
        'stock'             => $request->stock,
        'status'            => $request->status,
        'sub_category_id'   => $request->sub_category_id,
        'child_category_id' => $request->child_category_id,
    ]);
        if ($request->hasFile('images')) {

        foreach ($request->file('images') as $image) {

            $path = $image->store('products', 'public');

            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $path,
            ]);
        }
    }     
    
    // SUCCESS
    return redirect()->route('admin.product.index')->with('success', 'Product Created Successfully');
}

    public function show(string $id)
{
    $product = Product::with('product_images')->find($id);

    if (!$product) {
        return back()->with('error', 'Product not found');
    }

    return view('admin.pages.product.show', compact('product'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::with('product_images')->find($id);
        

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        $categories = Category::with('sub_categories.child_categories')->get();
        $sub_categories = SubCategory::all();
        $child_categories = ChildCategory::all();

        return view('admin.pages.product.edit', compact('product','sub_categories','child_categories','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //dd($request->all());
        $product = Product::find($id);
        if (!$product) {
        return redirect()->back()->with('error', 'Product not found');
    }
         $request->validate([
        'sub_category_id'   => 'required|exists:sub_categories,id',
        'child_category_id' => 'required|exists:child_categories,id',
        'name'              => 'required|string|max:255',
        'details'           => 'required',
        'description'       => 'required',
        'size_guide'        => 'required|string|max:255',
        'stock'             => 'required|integer|min:0',
        'status'            => 'required|in:active,inactive',

        // images validation
        'images'   => 'nullable',
        'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);
        $product->update([
            'name'              => $request->name,
            'details'           => $request->details,
            'description'       => $request->description,
            'size_guide'        => $request->size_guide,
            'stock'             => $request->stock,
            'status'            => $request->status,
            'sub_category_id'   => $request->sub_category_id,
            'child_category_id' => $request->child_category_id,
        ]);
        if ($request->filled('delete_images')) {

    $deleteImages = json_decode($request->delete_images, true);

    if (!empty($deleteImages)) {

        ProductImage::whereIn('id', $deleteImages)->delete();

    }
}

        if ($request->hasFile('images')) {

        foreach ($request->file('images') as $image) {

            $path = $image->store('products', 'public');

            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $path,
            ]);
        }
    }
        return redirect()->route('admin.product.index')->with('success', 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $product = Product::find($id);
        if(!$product){
            return redirect()->back()->with('error','Product not found');
        }
        $product->delete();
        return redirect()->back()->with('success','Product Deleted Successfully');

    }
}
