<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    protected $table = "billing";

    protected $fillable = [
        'user_id','email','phone_number','address'
    ];

    public function delivery()
    {
        // code...
        return $this->hasOne(Delivery::class,'id','delivery_id');
    }

    public $timestamps = false;
}
