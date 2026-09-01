<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faqs;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faqs::with('faqcategory')->latest()->paginate(10);

        return view('admin.pages.faqs.index', compact('faqs'));
    }

    public function create()
    {
        $categories = FaqCategory::orderBy('name')->get();

        return view('admin.pages.faqs.create', compact('categories'));
    }

    public function show(Faqs $faq)
{
    $faq->load('faqcategory');

    return view('admin.pages.faqs.show', compact('faq'));
}
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question'        => ['required', 'string', 'max:500'],
            'answer'          => ['required', 'string'],
            'faq_category_id' => ['required', 'exists:faq_categories,id'],
        ]);

        Faqs::create($validated);

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQ created successfully.');
    }

    public function edit(Faqs $faq)
    {
        $categories = FaqCategory::orderBy('name')->get();

        return view('admin.pages.faqs.edit', compact('faq', 'categories'));
    }

    public function update(Request $request, Faqs $faq)
    {
        $validated = $request->validate([
            'question'        => ['required', 'string', 'max:500'],
            'answer'          => ['required', 'string'],
            'faq_category_id' => ['required', 'exists:faq_categories,id'],
        ]);

        $faq->update($validated);

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQ updated successfully.');
    }

    public function destroy(Faqs $faq)
    {
        $faq->delete();

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQ deleted successfully.');
    }
}