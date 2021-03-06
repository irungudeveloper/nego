<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function merchant()
    {
        // code...
        return $this->hasOne(Merchant::class,'user_id','id');
    }

    public function customer()
    {
        // code...
        return $this->hasOne(Customer::class,'user_id','id');
    }

    public function delivery()
    {
        // code...
        return $this->hasMany(Delivery::class,'user_id','id');
    }

    public function billing()
    {
        // code...
        return $this->hasOne(Billing::class,'user_id','id');
    }

    public function merchant_notification()
    {
        return $this->hasMany(Nofication::class,'merchant_id','id');
        // code...
    }

    public function customer_notification()
    {
        // code...
        return $this->hasMany(Notification::class,'customer_id','id');
    }
}
