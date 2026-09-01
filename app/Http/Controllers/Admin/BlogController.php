<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Saare blogs ki list dikhata hai.
     */
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);

        return view('admin.pages.blogs.index', compact('blogs'));
    }

    /**
     * Naya blog banane ka form dikhata hai.
     */
    public function create()
    {
        return view('admin.pages.blogs.create');
    }

    /**
     * Naya blog save karta hai.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'              => 'required|string|max:255',
            'short_description'  => 'required|string|max:500',
            'detail'             => 'required|string',
            'image'              => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('blogs', 'public');
        }

        Blog::create($validated);

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog created successfully.');
    }

    /**
     * Blog edit karne ka form dikhata hai.
     */
    public function edit(Blog $blog)
    {
        return view('admin.pages.blogs.edit', compact('blog'));
    }

    /**
     * Blog update karta hai.
     */
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title'              => 'required|string|max:255',
            'short_description'  => 'required|string|max:500',
            'detail'             => 'required|string',
            'image'              => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }

            $validated['image'] = $request->file('image')->store('blogs', 'public');
        }

        $blog->update($validated);

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog updated successfully.');
    }

    /**
     * Blog delete karta hai.
     */
    public function destroy(Blog $blog)
    {
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog deleted successfully.');
    }
}