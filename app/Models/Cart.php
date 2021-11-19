<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = "cart";

    protected $fillable = [
        'user_id','product_id','product_quantity','total_cost','cart_status'
    ];

    public function product()
    {
        // code...
        return $this->hasMany(Product::class,'id','product_id');
    }
    
}
