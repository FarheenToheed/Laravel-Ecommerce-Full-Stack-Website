<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\User;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Saare coupons ki list dikhata hai.
     */
    public function index()
    {
        $coupons = Coupon::latest()->paginate(10);

        return view('admin.pages.coupons.index', compact('coupons'));
    }

    /**
     * Naya coupon banane ka form dikhata hai.
     */
    public function create()
    {
        $users = User::orderBy('name')->get();

        return view('admin.pages.coupons.create', compact('users'));
    }

    /**
     * Naya coupon save karta hai aur select kiye gaye user ko assign karta hai.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'coupon_code'  => 'required|string|max:50|unique:coupons,coupon_code',
            'type'         => 'required|in:total_amount,percentage',
            'max_discount' => 'required|numeric|min:0',
            'value'        => 'required|numeric|min:0',
            'limit'        => 'nullable|integer|min:1',
            'exp_date'     => 'required|date|after:today',
            'status'       => 'required|in:active,inactive',
            'user_id'      => 'nullable|exists:users,id',
        ]);

        $coupon = Coupon::create($validated);

        $coupon->users()->sync($request->user_id ? [$request->user_id] : []);

        return redirect()
            ->route('admin.coupons.index')
            ->with('success', 'Coupon created successfully.');
    }

    /**
     * Coupon edit karne ka form dikhata hai, sath hi pehle se assigned user bhi.
     */
    public function edit(Coupon $coupon)
    {
        $users = User::orderBy('name')->get();

        $assignedUserIds = $coupon->users()->pluck('users.id')->toArray();

        return view('admin.pages.coupons.edit', compact('coupon', 'users', 'assignedUserIds'));
    }

    /**
     * Coupon update karta hai aur assigned user ko dobara sync karta hai.
     */
    public function update(Request $request, Coupon $coupon)
    {
        $validated = $request->validate([
            'coupon_code'  => 'required|string|max:50|unique:coupons,coupon_code,' . $coupon->id,
            'type'         => 'required|in:total_amount,percentage',
            'max_discount' => 'required|numeric|min:0',
            'value'        => 'required|numeric|min:0',
            'limit'        => 'nullable|integer|min:1',
            'exp_date'     => 'required|date',
            'status'       => 'required|in:active,inactive',
            'user_id'      => 'nullable|exists:users,id',
        ]);

        $coupon->update($validated);

        $coupon->users()->sync($request->user_id ? [$request->user_id] : []);

        return redirect()
            ->route('admin.coupons.index')
            ->with('success', 'Coupon updated successfully.');
    }

    /**
     * Coupon delete karta hai.
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return redirect()
            ->route('admin.coupons.index')
            ->with('success', 'Coupon deleted successfully.');
    }
}