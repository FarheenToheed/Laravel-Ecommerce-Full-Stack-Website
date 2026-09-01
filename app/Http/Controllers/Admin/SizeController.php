<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Size;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $size = Size::all();
       return view('admin.pages.size.index', compact('size'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.size.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'name'=>'required|string|max:255',
        ]);
        Size::create($request->all());
        return redirect()->route('admin.size.index')->with('success','size created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    //     $size = Size::find($id);

    // if (!$size) {
    //     return redirect()->back()->with('error', 'Size not found');
    // }

    // return view('admin.pages.size.index', compact('size'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $size = Size::find($id);
        if(!$size){
            return redirect()->back()->with('error','Size not found');
        }
        return view('admin.pages.size.index', compact('size'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'required|string|max:255',
        ]);
        $size = Size::find($id);
        if(!$size){
            return redirect()->back()->with('error','Size not found');
        }
        $size->update([
            'name'=>$request->name,
        ]);
        return redirect()->route('admin.size.index')->with('success','Size updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $size = Size::find($id);
        if(!$size){
            return redirect()->back()->with('error','Size not found');
        }
        $size->delete();
        return redirect()->back()->with('success','Size Deleted Successfully');

    }
}
