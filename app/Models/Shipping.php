<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
#[Fillable(['first_name','last_name','address','country','province','city','postal_code','phone_no'])]
class Shipping extends Model
{
    public function order()
    {
        return $this->hasone(Order::class,'ship_id');
    }
}
