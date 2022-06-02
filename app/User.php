<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function properties(){

        return $this->hasMany(Property::class);
        
    }

    public function offers(){

        return $this->hasMany(Transaksi::class);
        
    }

    public function useremails(){

        return $this->hasMany(UserEmail::class);
        
    }

    public function favorites(){

        return $this->hasMany(Favorit::class);

    }

    public function comments(){

        return $this->hasMany(Comment::class);

    }


}
