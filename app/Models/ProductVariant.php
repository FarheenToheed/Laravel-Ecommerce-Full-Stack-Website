<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
#[Fillable(['price','color_id','product_id','size_id'])]

class ProductVariant extends Model
{
    public function product_color(){
        return $this->belongsTo(Color::class, 'color_id');
    }
    public function product_size(){
        return $this->belongsTo(Size::class, 'size_id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function cart_items()
    {
        return $this->hasMany(CartItem::class);
    }
    
    
}
