<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;


    const ROLE_PATIENT = 'patient';
    const ROLE_ADMIN = 'admin';
    const ROLE_DOCTOR = 'doctor';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'role',
        'email',
        'specialtie_id',
        'mobile_number',
        'password',
        'amount',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getAuthIdentifierName(): string
    {
        return 'mobile_number'; // Return 'username' instead of 'email'
    }
    public function specialty()
    {
        return $this->hasOne(specialty::class, 'id', 'specialtie_id');
    }

    public function availability()
    {
        return $this->hasMany(Availability::class);
    }
}
