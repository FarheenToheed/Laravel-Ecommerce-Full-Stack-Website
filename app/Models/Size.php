<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
#[Fillable(['name'])]

class Size extends Model
{
    public function product_variants() {
        return $this->hasMany(ProductVariant::class, 'size_id');
    }
}
