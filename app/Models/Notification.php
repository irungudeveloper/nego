<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = "notifications";

    protected $fillable = [
                            'merchant_id',
                            'customer_id',
                            'product_id',
                            'discount_amount',
                            'negotiation_status'
                        ];

    public function merchant()
    {
        // code...
        return $this->belongsTo(User::class,'merchant_id','id');

    }

    public function customer()
    {
        // code...
        return $this->belongsTo(User::class,'customer_id','id');
    }

    public function product()
    {
        // code...
        return $this->belongsTo(Product::class,'product_id','id');
    }

}
