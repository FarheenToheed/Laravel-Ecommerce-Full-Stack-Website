<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Category;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | BASIC COUNTS
        |--------------------------------------------------------------------------
        */

        // Total Products
        $totalProducts = Product::count();

        // Total Orders
        $totalOrders = Order::count();

        // Total Users
        $totalUsers = User::count();

        // Total Categories
        $totalCategories = Category::count();


        /*
        |--------------------------------------------------------------------------
        | REVENUE
        |--------------------------------------------------------------------------
        */

        // Sirf completed/delivered orders ki total revenue
        $totalRevenue = Order::where('status', 'delivered')
            ->sum('total');


        /*
        |--------------------------------------------------------------------------
        | PENDING ORDERS
        |--------------------------------------------------------------------------
        */

        $pendingOrders = Order::where('status', 'pending')
            ->count();

            /*
        |--------------------------------------------------------------------------
        |Canceled ORDERS
        |--------------------------------------------------------------------------
        */

        $cancelOrders = Order::where('status', 'cancelled')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | LOW STOCK PRODUCTS
        |--------------------------------------------------------------------------
        */

        // Jinke stock 10 ya us se kam hain
        $lowStockProducts = Product::with([
            'sub_category',
            'child_category'
        ])
        ->where('stock', '<=', 10)
        ->orderBy('stock', 'asc')
        ->get();


        /*
        |--------------------------------------------------------------------------
        | RECENT ORDERS
        |--------------------------------------------------------------------------
        */

        $recentOrders = Order::with([
            'user',
            'shipping'
        ])
        ->latest()
        ->take(5)
        ->get();


        /*
        |--------------------------------------------------------------------------
        | RECENT USERS
        |--------------------------------------------------------------------------
        */

        $recentUsers = User::latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | MONTHLY SALES
        |--------------------------------------------------------------------------
        |
        | Current year ke delivered orders ko month-wise calculate kar rahe hain.
        |
        */

        $currentYear = Carbon::now()->year;

        $monthlySales = Order::selectRaw(
            'MONTH(created_at) as month, SUM(total) as total'
        )
        ->where('status', 'delivered')
        ->whereYear('created_at', $currentYear)
        ->groupByRaw('MONTH(created_at)')
        ->orderByRaw('MONTH(created_at)')
        ->get();


        /*
        |--------------------------------------------------------------------------
        | CHART DATA
        |--------------------------------------------------------------------------
        |
        | January se December tak 12 months rakhenge.
        | Agar kisi month mein sale nahi hui to 0 show hoga.
        |
        */

        $salesLabels = [];
        $salesData = [];

        for ($month = 1; $month <= 12; $month++) {

            $salesLabels[] = Carbon::create()
                ->month($month)
                ->format('M');

            $sale = $monthlySales->firstWhere('month', $month);

            $salesData[] = $sale
                ? (float) $sale->total
                : 0;
        }


        /*
        |--------------------------------------------------------------------------
        | THIS MONTH REVENUE
        |--------------------------------------------------------------------------
        */

        $thisMonthRevenue = Order::where('status', 'delivered')
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('total');


        /*
        |--------------------------------------------------------------------------
        | LAST MONTH REVENUE
        |--------------------------------------------------------------------------
        */

        $lastMonth = Carbon::now()->subMonth();

        $lastMonthRevenue = Order::where('status', 'delivered')
            ->whereYear('created_at', $lastMonth->year)
            ->whereMonth('created_at', $lastMonth->month)
            ->sum('total');


        /*
        |--------------------------------------------------------------------------
        | REVENUE PERCENTAGE
        |--------------------------------------------------------------------------
        */

        if ($lastMonthRevenue > 0) {

            $revenuePercentage = (($thisMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100;

        } else {

            $revenuePercentage = $thisMonthRevenue > 0 ? 100 : 0;
        }


        /*
        |--------------------------------------------------------------------------
        | THIS MONTH ORDERS
        |--------------------------------------------------------------------------
        */

        $thisMonthOrders = Order::whereYear(
            'created_at',
            Carbon::now()->year
        )
        ->whereMonth(
            'created_at',
            Carbon::now()->month
        )
        ->count();


        /*
        |--------------------------------------------------------------------------
        | RETURN DASHBOARD
        |--------------------------------------------------------------------------
        */

        return view('admin.pages.index', compact(

            'totalProducts',
            'totalOrders',
            'totalUsers',
            'totalCategories',

            'totalRevenue',
            'pendingOrders',
            'cancelOrders',

            'lowStockProducts',

            'recentOrders',
            'recentUsers',

            'salesLabels',
            'salesData',

            'thisMonthRevenue',
            'revenuePercentage',
            'thisMonthOrders'

        ));
    }
}

// namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;

// class DashboardController extends Controller
// {
//     // public function index(){
//     //     return view('admin.pages.index');
//     // }
    
// }
