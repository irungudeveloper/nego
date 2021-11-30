<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mpesa extends Model
{
    use HasFactory;

    protected $table = "mpesa_transaction";

    protected $fillable = [
                        'user_id',
                        'merchant_request_id',
                        'checkout_request_id',
                        'amount',
                        'transaction_status',
                    ];
}
