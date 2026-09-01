<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use App\Models\Product;

class CategoryController extends Controller
{
    /**
     * Main Category ke products dikhao (jaise "Woman")
     */
    public function index($id)
    {
        // $category = Category::with('sub_categories.child_categories')
        //     ->findOrFail($id);
        $category = Category::with('sub_categories.child_categories')
        ->find($id);

    // Agar category na mile to empty products ke sath view dikhao
    if (!$category) {
        $products = collect(); // empty collection
        return view('web.pages.category.index', compact('category', 'products'));
    }

        $subCategoryIds = $category->sub_categories->pluck('id');

        $products = Product::with([
                'product_images',
                'product_variants.product_size',
                'sub_category.category',
                'child_category'
            ])
            ->whereIn('sub_category_id', $subCategoryIds)
            ->where('status', 'active')
            ->latest()
            ->paginate(15);

        return view('web.pages.category.index', compact('category', 'products'));
    }

    /**
     * Sub-category ke products dikhao (jaise "Kurtas")
     */
    public function subCategory($id)
    {
        //$subCategory = SubCategory::with('category')->findOrFail($id);

        $subCategory = SubCategory::with('category')->find($id);
         if (!$subCategory) {
        $products = collect(); // empty collection
        return view('web.pages.category.index', compact('subCategory', 'products'));
    }
    
        $products = Product::with([
                'product_images',
                'product_variants.product_size',
                'sub_category.category',
                'child_category'
            ])
            ->where('sub_category_id', $id)
            ->where('status', 'active')
            ->latest()
            ->paginate(15);

        return view('web.pages.category.index', compact('subCategory', 'products'));
    }

    /**
     * Child-category ke products dikhao (jaise "Printed Kurtas")
     */
    public function childCategory($id)
    {
        // $childCategory = ChildCategory::with('sub_category.category')->findOrFail($id);

        $childCategory = ChildCategory::with('sub_category.category')->find($id);
         if (!$childCategory) {
        $products = collect(); // empty collection
        return view('web.pages.category.index', compact('childCategory', 'products'));
    }
        $products = Product::with([
                'product_images',
                'product_variants.product_size',
                'sub_category.category',
                'child_category'
            ])
            ->where('child_category_id', $id)
            ->where('status', 'active')
            ->latest()
            ->paginate(15);

        return view('web.pages.category.index', compact('childCategory', 'products'));
    }
}