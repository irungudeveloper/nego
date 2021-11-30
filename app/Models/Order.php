<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";

    protected $fillable = ['user_id',
                            'product_id',
                            'quantity',
                            'amount',
                            'delivery_status',
                        ];

    public function product()
    {
        // code...
        return $this->hasMany(Product::class,'id','product_id');
    }

    public function user()
    {
        // code...
        return $this->hasMany(User::class,'id','user_id');
    }
}
