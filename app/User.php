<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Product;
use App\Utils\CanRate;
use App\Utils\CanBeRated;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasApiTokens, CanRate,CanBeRated;


    protected $fillable = [
        'name', 'email', 'password',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function products(){
        return $this->hasMany(Product::Class);
    }
}
