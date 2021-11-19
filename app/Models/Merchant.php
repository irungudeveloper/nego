<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;

    protected $table = "merchant_details";

    protected $fillable = [
                            'user_id',
                            'first_name',
                            'last_name',
                            'phone_number',
                            'email',
                            'share_contact',
                          ];

    public function user()
    {
        // code...
        return $this->belongsTo(User::class,'user_id','id');
    }

}
