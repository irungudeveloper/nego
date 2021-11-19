<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = "customer_details";

    protected $fillable = [
                            'user_id',
                            'first_name',
                            'last_name',
                            'phone_number',
                            'email',
                        ];

    public function user()
    {
        // code...
        return $this->belongsTo(User::class,'user_id','id');
    }
}
