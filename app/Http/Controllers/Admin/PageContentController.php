<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use Illuminate\Http\Request;

class PageContentController extends Controller
{
    public function index()
    {
        $pages = PageContent::latest()->paginate(15);

        return view('admin.pages.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.pages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'page_name' => 'required|string|max:255',
            'page_link' => 'required|string|max:255|unique:page_contents,page_link',
            'content'   => 'required|string',
        ]);

        PageContent::create($validated);

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Page created successfully.');
    }

    public function edit(PageContent $page)
    {
        return view('admin.pages.pages.edit', compact('page'));
    }

    public function update(Request $request, PageContent $page)
    {
        $validated = $request->validate([
            'page_name' => 'required|string|max:255',
            'page_link' => 'required|string|max:255|unique:page_contents,page_link,' . $page->id,
            'content'   => 'required|string',
        ]);

        $page->update($validated);

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Page updated successfully.');
    }

    public function destroy(PageContent $page)
    {
        $page->delete();

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Page deleted successfully.');
    }
}