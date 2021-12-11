<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;

    protected $table = "tasks";

    protected $fillable = [
                            'user_id',
                            'task_title',
                            'deadline',
                            'urgency',
                            'status',
                        ];

    public function user()
    {
        // code...
        return $this->belongsTo(User::class,'user_id','id');
    }

}
