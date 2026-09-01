<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inquiry;

class ContactController extends Controller
{
    public function index()
    {
        $inquiries = Inquiry::all();
       return view('admin.pages.contact.index',compact('inquiries'));
    }
}
