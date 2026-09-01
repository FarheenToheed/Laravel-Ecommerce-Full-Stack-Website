<?php
use App\Http\Controllers\Admin\ChildCategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderDetailController;
use App\Http\Controllers\Admin\PageContentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\ProductVariantController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\FaqCategoryController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\TicketController;
use App\Models\ChildCategory;
use App\Models\Inquiry;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
     Route::resource('category', CategoryController::class);
     Route::resource('subcategory', SubCategoryController::class);
     Route::resource('childcategory',ChildCategoryController::class);
     Route::resource('color', ColorController::class);
     Route::resource('size', SizeController::class);
     Route::resource('product',ProductController::class);
     
     Route::resource('productvariant',ProductVariantController::class);
     Route::resource('contact',ContactController::class);
    Route::resource('orderdetails',OrderDetailController::class);

    Route::resource('faq-categories', FaqCategoryController::class);
    Route::resource('faqs', FaqController::class);
    Route::resource('coupons', CouponController::class);
    Route::resource('tickets', TicketController::class);
    Route::resource('pages', PageContentController::class); 
    Route::resource('blogs', BlogController::class);
});
