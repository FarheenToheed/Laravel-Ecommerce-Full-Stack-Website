<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FaqCategory;
class FaqController extends Controller
{
    public function index()
    {
        $categories = FaqCategory::with(['faqs' => function ($query) {
        }])->has('faqs')->orderBy('name')->get();

        return view('web.pages.pages.faqs', compact('categories'));
    }
}