<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
#[Fillable(['name','sub_category_id','child_category_id','sku','description','details','size_guide','status','stock'])]

class Product extends Model
{
    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class,'sub_category_id');
    }

    public function child_category()
    {
        return $this->belongsTo(ChildCategory::class,'child_category_id');
    }

    public function product_variants() {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }

    
    public function product_images()
    {
        return $this->hasMany(ProductImage::class,'product_id');
    }

    public function cart_items()
    {
        return $this->hasMany(CartItem::class,'product_id');
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class,'product_id');
    }
     
    public function wishlists(){
        return $this->hasMany(Wishlist::class,'product_id');
    }

    public function isInCart()
{
    if (!auth()->check()) {
        return false;
    }

    return CartItem::whereHas('cart', function ($q) {
        $q->where('user_id', auth()->id());
    })
    ->where('product_id', $this->id)
    ->exists();
}
    
}
