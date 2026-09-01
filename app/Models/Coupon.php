<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
#[Fillable(['coupon_code',
        'type',
        'max_discount',
        'value',
        'limit',
        'exp_date',
        'status',])]
class Coupon extends Model
{
    public function orders()
    {
        return $this->hasMany(Order::class, 'coupon_id');
    }
    public function users()
{
    return $this->belongsToMany(User::class, 'coupon_user');
}
}



