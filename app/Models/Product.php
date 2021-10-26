<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "product";

    protected $fillable = [
        'product_name','product_image','category_id','brand_id','user_id','product_quantity','product_retail_price','product_final_price','negotiable','availability_status',
    ];
}
