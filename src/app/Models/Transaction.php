<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Transaction extends Model
{
    protected $fillable = ['category_id','amount','type','memo','date'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
