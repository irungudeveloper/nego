<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $table = "delivery_area";
    protected $fillable = [
                    'user_id',
                    'area_name',
                    'delivery_cost'
                ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function billing()
    {
        // code...
        return $this->belongsTo(Billing::class,'delivery_id','id');
    }
}
