<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PageContent;

class PagesController extends Controller
{
    public function show($slug)
    {
        $page = PageContent::where('page_link', $slug)->firstOrFail();

        return view('web.pages.pages.page-content', compact('page'));
    }
}


    
    // public function index()
    // {
    //     return view('web.pages.pages.exchanges_return');
    // }

    // public function about()
    // {
    //     return view('web.pages.pages.about_us');
    // }

       
    // public function privacy()
    // {
    //     return view('web.pages.pages.privacy_policy');
    // }

    // public function payment()
    // {
    //     return view('web.pages.pages.payment');
    // }
    
    