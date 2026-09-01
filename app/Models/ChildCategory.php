<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
#[Fillable(['name','subcategory_id'])]

class ChildCategory extends Model
{
    public function sub_category(){
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }
    public function products(){
        return $this->hasMany(Product::class, 'child_category_id');
    }
}