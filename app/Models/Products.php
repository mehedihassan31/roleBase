<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'sku',
        'brand_id',
        'description',
        'short_description',
        'category_id',
        'status',
        'price',
        'dis_price',
        'stock',
    ];

}
