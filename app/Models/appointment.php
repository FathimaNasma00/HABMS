<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class appointment extends Model
{
    //use HasFactory;
    protected $table = 'appointments';
    protected $fillable = [
        'doctor_id',
        'user_id',
        'name',
        'age',
        'date',
        'time',
        'mobile_number',
        'status',
        'amount',
        'email',
        'reminder_send_at',
    ];

//    protected $casts = [
//        'reminder_send_at' => 'timestamp',
//    ];

    public function doctor()
    {
        return $this->hasOne(User::class, 'id', 'doctor_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function payment(): HasOne
    {
        return $this->hasOne(payment::class, 'appointment_id', 'id');
    }
}
