<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
        /**
     * Order History
     */
    public function index()
    {
        $orders = Order::with([
            'payment',
            'order_items.product',
        ])
        ->where('user_id', Auth::id())
        ->latest()
        ->paginate(15);

        return view('web.pages.account.orders', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    
    /**
     * Order Details
     */
    public function show(Order $order)
    {
        // Sirf logged-in user apna order dekh sake
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load([
            'payment',
            'shipping',
            'order_items.product',
            'order_items.variant',
        ]);

        return view('web.pages.account.order', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
