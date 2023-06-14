<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Level;
use App\Models\Peran;
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
    protected $table = "users";
    protected $primaryKey = 'id_user';
    protected $keyType = 'string';
    protected $fillable = [
        'id_user',
        'name',
        'departemen',
        'hp',
        'password',
        'function',
        'function_en',
        'level',
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
    ];

    /**
     * level
     *
     * @return void
     */
    public function level()
    {
        return $this->belongsTo(Level::class, 'level');
    }

    /**
     * peran
     *
     * @return void
     */
    public function peran()
    {
        return $this->belongsTo(Peran::class, 'function');
    }
}
