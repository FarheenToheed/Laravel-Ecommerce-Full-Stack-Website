<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
#[Fillable(['name'])]
class FaqCategory extends Model
{
    public function faqs() {
        return $this->hasMany(Faqs::class, 'faq_category_id');
    }
}
