<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "product";

    protected $fillable = [
                            'product_name',
                            'product_image',
                            'category_id',
                            'brand_id',
                            'user_id',
                            'product_quantity',
                            'product_retail_price',
                            'product_final_price',
                            'product_price',
                            'negotiable',
                            'availability_status',
                         ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function order()
    {
        // code...
        return $this->belongsTo(Order::class);
    }

    public function notification($value='')
    {
        // code...
        return $this->hasMany(Notification::class,'product_id','id');
    }
}
