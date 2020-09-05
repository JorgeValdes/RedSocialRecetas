<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    //relacion de perfil 1:1
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
