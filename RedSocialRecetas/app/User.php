<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'url'
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

    protected static function boot()

    {
        parent::boot();

        // Asginar perfil que se haya creado el usuario nuevo
        static::created((function ($user) {
            $user->perfil()->create();
        }));
    }

    /* Relacion  1:n de Usuario a recentas */

    public function recetas()
    {
        return $this->hasMany(Receta::class);
    }

    //Relacion uno a uno de usuario a Pefil
    public function perfil()
    {
        return $this->hasOne(Perfil::class);
    }

    //receta que el usuario la ha dado me gusta
    public function meGusta()
    {
        return  $this->belongsToMany(Receta::class, 'likes_receta');
    }
}
