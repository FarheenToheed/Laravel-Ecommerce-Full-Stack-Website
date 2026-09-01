<?php

namespace App\Http\Controllers\Admin;
use App\Models\Color;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $color = Color::all();
       return view('admin.pages.color.index', compact('color'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.color.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'code'=>'required|string|max:255',
        ]);
        Color::create($request->all());
        return redirect()->route('admin.color.index')->with('success','Color created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    //     $color = Color::find($id);

    // if (!$color) {
    //     return redirect()->back()->with('error', 'Color not found');
    // }

    // return view('admin.pages.color.index', compact('color'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $color = Color::find($id);
        if(!$color){
            return redirect()->back()->with('error','Color not found');
        }
        return view('admin.pages.color.index', compact('color'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'code'=>'required|string|max:255',
        ]);
        $color = Color::find($id);
        if(!$color){
            return redirect()->back()->with('error','Color not found');
        }
        $color->update([
            'name'=>$request->name,
            'code'=>$request->code,
        ]);
        return redirect()->route('admin.color.index')->with('success','Color updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $color = Color::find($id);
        if(!$color){
            return redirect()->back()->with('error','Color not found');
        }
        $color->delete();
        return redirect()->back()->with('success','Color Deleted Successfully');

    }
}
