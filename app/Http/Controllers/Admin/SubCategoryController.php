<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 1st)
        // ->with('category')
        // 2nd)
        // ->load('category')
        $sub_categories = SubCategory::with('category')->get();
    $categories = Category::all();

    return view('admin.pages.subcategory.index',compact('sub_categories', 'categories'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

    
        return view('admin.pages.subcategory.index',compact('categories'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
        'category_id' => 'required|exists:categories,id',
        'name' => 'required|string|max:255',
    ]);

    SubCategory::create([
        'category_id' => $request->category_id,
        'name' => $request->name,
    ]);

    return redirect()->route('admin.subcategory.index')->with('success', 'Sub Category Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    //     $category = Category::find($id);
    //     $sub_category = SubCategory::find($id);

    // if (!$category) {
    //     return redirect()->back()->with('error', 'Category not found');
    // }

    // return view('admin.pages.subcategory.index', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subCategory = SubCategory::find($id);
    if (!$subCategory) {
        return back()->with('error', 'Sub Category not found');
    }
    $categories = Category::all();
    return view('admin.pages.subcategory.edit',compact('subCategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       
    $request->validate([
        'category_id' => 'required|exists:categories,id',
        'name' => 'required|string|max:255',
    ]);

    $subCategory = SubCategory::find($id);

    if (!$subCategory) {
        return redirect()->back()->with('error', 'Sub Category not found');
    }

    $subCategory->update([
        'category_id' => $request->category_id,
        'name' => $request->name,
    ]);

    return redirect()->route('admin.subcategory.index')->with('success', 'Sub Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sub_category = SubCategory::find($id);
        if(!$sub_category){
            return redirect()->back()->with('error','Sub_Category not found');
        }
        $sub_category->delete();
        return redirect()->back()->with('success','Sub_Category Deleted Successfully');

    }
}
