<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
#[Fillable(['order_id','pay_method','pay_status','total_amount','paid_at','transaction_id','paid_amount'])]


class Payment extends Model
{
    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }
}
