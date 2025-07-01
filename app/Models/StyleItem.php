<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StyleItem extends Model
{
    protected $fillable = [
        'code',
        'category_id',
        'extraPrompt',
        'url',
    ];

    public function categoryStyle()
    {
        return $this->belongsTo(CategoryStyle::class);
    }
}