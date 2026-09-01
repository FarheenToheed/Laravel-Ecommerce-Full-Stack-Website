<?php

namespace App\Http\Controllers\Web;
use App\Models\Inquiry;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('web.pages.contact.contact_us');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    //     $captchaResponse = Http::withoutVerifying()->post('https://www.google.com/recaptcha/api/siteverify', [
    //     'secret'   => env('RECAPTCHA_SECRET_KEY'),
    //     'response' => $request->input('g-recaptcha-response'),
    // ]);

    // if (!$captchaResponse->json()['success']) {
    //     return back()->withErrors([
    //         'captcha' => 'Please complete the captcha verification!'
    //     ]);
    // }
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
 
        Inquiry::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);
 
        return back()->with('success', 'Your message has been sent successfully. We will get back to you soon!');
    }

}
