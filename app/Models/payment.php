<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class payment extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'appointment_id',
        'amount',
        'currency',
        'status',
        'method',
        'card',
    ];

    public function appointment(): BelongsTo
    {
        return $this->belongsTo(appointment::class);
    }
}
