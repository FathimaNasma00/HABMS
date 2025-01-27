<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class specialty extends Model
{
    //use HasFactory;
    use SoftDeletes;

    protected $table = 'specialties';

    protected $fillable = [
        'name',
        'description'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'specialtie_id');
    }
}
