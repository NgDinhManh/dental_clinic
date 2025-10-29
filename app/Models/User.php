<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $table = 'users';

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'name',
        'phone',
        'password',
        'email',
        'avatar',
        'is_active',
        'email_verified_at',
        'remember_token',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'user_id', 'user_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'user_id', 'user_id');
    }

    public function receptionist()
    {
        return $this->belongsTo(Receptionist::class, 'user_id', 'user_id');
    }
}
