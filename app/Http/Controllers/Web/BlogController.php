<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    /**
     * Saare blogs ki list dikhata hai (public).
     */
    public function index()
    {
        $blogs = Blog::latest()->paginate(9);

        return view('web.pages.blogs.index', compact('blogs'));
    }

    /**
     * Ek blog ka detail page dikhata hai.
     */
    public function show(Blog $blog)
    {
        return view('web.pages.blogs.show', compact('blog'));
    }
}