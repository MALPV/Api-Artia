<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StyleItem extends Model
{
    protected $fillable = [
        'code',
        'category',
        'extraPrompt',
        'url',
    ];
}