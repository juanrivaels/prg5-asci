<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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
     * @var array<int, string>
     */
    protected $fillable = [
        'us_nama',
        'us_noinduk',
        'us_idrole',
        'us_role',
        'us_email',
        'us_telepon',
        'us_email',
        'us_username',
        'us_password',
        'us_pasfoto',
        'us_status',
    ];

    public function hasRole(string $role)
    {
        // Implementasi sesuai dengan struktur role pada aplikasi Anda
        return $this->us_role === $role;
    }

    public function users(){
        return $this->belongsToMany(Lomba::class);
    }

    public function lombas(){
        return $this->belongsToMany(Pendaftaran::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'us_idrole');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
