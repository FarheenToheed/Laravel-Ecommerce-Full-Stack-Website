<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FaqCategoryController extends Controller
{
    public function index()
    {
        $categories = FaqCategory::withCount('faqs')->paginate(10);

        return view('admin.pages.faq-categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:faq_categories,name'],
        ]);

        FaqCategory::create($validated);

        return redirect()
            ->route('admin.faq-categories.index')
            ->with('success', 'FAQ Category created successfully.');
    }

    public function update(Request $request, FaqCategory $faqCategory)
    {
        $validated = $request->validate([
            'name' => [
                'required', 'string', 'max:255',
                Rule::unique('faq_categories', 'name')->ignore($faqCategory->id),
            ],
        ]);

        $faqCategory->update($validated);

        return redirect()
            ->route('admin.faq-categories.index')
            ->with('success', 'FAQ Category updated successfully.');
    }

    public function destroy(FaqCategory $faqCategory)
    {
        $faqCategory->delete();

        return redirect()
            ->route('admin.faq-categories.index')
            ->with('success', 'FAQ Category deleted successfully.');
    }
}