<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    //campos que se agregaran
    protected $fillable = [
        'titulo', 'ingredientes', 'preparacion', 'imagen', 'categoria_id',
    ];

    //Obtiene la categoria via FK
    public function categoria()
    {
        return $this->belongsTo(CategoriaReceta::class);
    }

    //OBTIENE LA INFORMACION DEL USUARIO VIA FK
    public function autor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //Likes qe ha recibido una receta
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes_receta');
    }
}
