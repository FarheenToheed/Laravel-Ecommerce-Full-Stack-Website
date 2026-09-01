<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
     public function index()
    {
        $orders = Order::with([
            'user',
            'shipping',
        ])->latest()
        ->paginate(15);

        return view('admin.pages.orderdetails.index',compact('orders'));
    }
    

    public function show($id)
    {
        $order = Order::with([
            'user',
            'shipping',
            'order_items.product',
            'order_items.variant.product_size',
            'order_items.variant.product_color',
        ])
        ->findOrFail($id);

        return view('admin.pages.orderdetails.show',compact('order'));
        
    }
    
//    public function update(Request $request, Order $orderdetail)
// {
//     $request->validate([
//         'status' => 'required|in:pending,processing,confirmed,shipped,delivered,cancelled'
//     ]);

//     $orderdetail->update([
//         'status' => $request->status
//     ]);

//     return redirect()
//         ->route('admin.orderdetails.index')
//         ->with('success', 'Order status updated successfully.');
// }

 public function update(Request $request, Order $orderdetail)
    {
        // ===== Zaroori Check — Final status ko lock karo =====
        if (in_array($orderdetail->status, ['delivered', 'cancelled'])) {
            return redirect()
                ->route('admin.orderdetails.index')
                ->with('error', 'This order is already ' . $orderdetail->status . ' and its status cannot be changed.');
        }

        $request->validate([
            'status' => 'required|in:pending,processing,confirmed,shipped,delivered,cancelled'
        ]);

        $orderdetail->update([
            'status' => $request->status
        ]);

        return redirect()
            ->route('admin.orderdetails.index')
            ->with('success', 'Order status updated successfully.');
    }
}
