<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Availability extends Model
{
    use SoftDeletes, HasFactory;

    const monday = 1;
    const tuesday = 2;
    const wednesday = 3;
    const thursday = 4;
    const friday = 5;
    const saturday = 6;
    const sunday = 7;

    protected $fillable = [
        'user_id',
        'day',
        'start_time',
        'end_time',
        'created_at',
        'updated_at'
    ];

//    protected $casts = [
//        'start_time' => 'timestamp',
//        'end_time' => 'timestamp',
//    ];

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
