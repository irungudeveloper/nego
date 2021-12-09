<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $table = "discount";

    protected $fillable = [
                            'code',
                            'active',
                            'product_id',
                            'percentage',
                            'user_id',
                        ];

    public function product()
    {
        // code...
        return $this->belongsTo(Product::class,'product_id','id');
    }

}
