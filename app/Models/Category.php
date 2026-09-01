<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name'])]
class Category extends Model
{
    public function sub_categories() {
        return $this->hasMany(SubCategory::class, 'category_id');
    }
    
    public function faqs() {
        return $this->hasMany(Faqs::class, 'category_id');
    }

}

