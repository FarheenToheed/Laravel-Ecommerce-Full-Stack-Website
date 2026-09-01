<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
#[Fillable(['status','user_id','ship_id','total','subtotal','tax','coupon_id'])]

class Order extends Model
{
    public function order_items(){
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
   
    public function shipping(){
    return $this->belongsTo(Shipping::class, 'ship_id');
}

    public function payment(){
        return $this->hasOne(Payment::class, 'order_id');
    }

    public function coupon()
{
    return $this->belongsTo(Coupon::class, 'coupon_id');
}
}
