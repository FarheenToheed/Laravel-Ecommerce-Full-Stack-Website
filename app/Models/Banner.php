<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['title','subtitle','description','image','link_url','placement','sort_order','is_active'])]
class Banner extends Model
{
    //
}
