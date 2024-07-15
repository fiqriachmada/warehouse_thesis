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

    protected $keyType = "string";
    protected $fillable = [
        'id',
        'username',
        'password',
        'level'
    ];

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function tenant()
    {
        return $this->hasOne(Tenant::class);
    }

    public function bank()
    {
        return $this->hasMany(Bank::class);
    }
}
