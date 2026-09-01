<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
         public function index()
    {
        $userId = auth()->id();

        $coupons = Coupon::where('status', 'active')
            ->where('exp_date', '>=', now())
            ->where(function ($query) use ($userId) {
                $query->whereDoesntHave('users')
                      ->orWhereHas('users', fn ($q) => $q->where('users.id', $userId));
            })
            ->latest()
            ->get();

        return view('web.pages.account.coupons', compact('coupons'));
    }
}
