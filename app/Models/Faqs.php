<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Attributes\Fillable;
#[Fillable(['question',
        'answer',
        'faq_category_id',])]
class Faqs extends Model
{
    /**
     * Relationship: FAQ belongs to Category
     */
    public function faqcategory()
    {
        return $this->belongsTo(FaqCategory::class,'faq_category_id');
    }
}