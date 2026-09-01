<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $categories = Category::all();
       return view('admin.pages.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255'
        ]);
        Category::create($request->all());
        return redirect()->route('admin.category.index')->with('success','Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    //     $category = Category::find($id);

    // if (!$category) {
    //     return redirect()->back()->with('error', 'Category not found');
    // }

    // return view('admin.pages.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        if(!$category){
            return redirect()->back()->with('error','Category not found');
        }
        return view('admin.pages.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'required|string|max:255'
        ]);
        $category = Category::find($id);
        if(!$category){
            return redirect()->back()->with('error','Category not found');
        }
        $category->update([
            'name'=>$request->name,
        ]);
        return redirect()->route('admin.category.index')->with('success','Category updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if(!$category){
            return redirect()->back()->with('error','Category not found');
        }
        $category->delete();
        return redirect()->back()->with('success','Category Deleted Successfully');
    }
}
