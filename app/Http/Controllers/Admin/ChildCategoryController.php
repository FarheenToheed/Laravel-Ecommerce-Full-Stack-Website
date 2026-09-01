<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;



class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // pagination, fields limit, select()
        $child_categories = ChildCategory::with(['sub_category.category'])->get();
        $sub_categories = SubCategory::all();
        // Log::info($child_categories);
        return view('admin.pages.childcategory.index',compact('child_categories', 'sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sub_categories = SubCategory::all();

    
        return view('admin.pages.childcategory.index',compact('sub_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
         $request->validate([
        'subcategory_id' => 'required|exists:sub_categories,id',
        'name' => 'required|string|max:255',
    ]);

    ChildCategory::create([
        'subcategory_id' => $request->subcategory_id,
        'name' => $request->name,
    ]);

    return redirect()->route('admin.childcategory.index')->with('success', 'Child Category Created Successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    //     $sub_category = SubCategory::find($id);
    //     $child_category = ChildCategory::find($id);

    // if(!$sub_category){
    //     return redirect()->back()->with('error','Sub Category not found.');
    // }

    // return view('admin.pages.subcategory.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $child_category = ChildCategory::find($id);
    if (!$child_category) {
        return back()->with('error', 'Child Category not found');
    }
    $sub_categories = SubCategory::all();
    return view('admin.pages.childcategory.index',compact('child_category', 'sub_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
        'subcategory_id' => 'required|exists:sub_categories,id',
        'name' => 'required|string|max:255',
    ]);

    $child_category = ChildCategory::find($id);

    if (!$child_category) {
        return redirect()->back()->with('error', 'Child Category not found');
    }

    $child_category->update([
        'subcategory_id' => $request->subcategory_id,
        'name' => $request->name,
    ]);

    return redirect()->route('admin.childcategory.index')->with('success', 'Child Category updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $child_category = ChildCategory::find($id);
        if(!$child_category){
            return redirect()->back()->with('error','Child Category not found');
        }
        $child_category->delete();
        return redirect()->back()->with('success','Child Category Deleted Successfully');
    }
}
