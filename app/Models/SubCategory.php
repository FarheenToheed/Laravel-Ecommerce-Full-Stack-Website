<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
#[Fillable(['name','category_id'])]
class SubCategory extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function child_categories(){
        return $this->hasMany(ChildCategory::class, 'subcategory_id');
    }
     public function product(){
        return $this->hasMany(Product::class, 'sub_category_id');
    }
}


