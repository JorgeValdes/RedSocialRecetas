<?php

namespace App\Http\Controllers;

use App\Receta;
use Illuminate\Http\Request;

class LikesController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {


        //Almacena los likes de un usuario  aa una receta
        return auth()->user()->meGusta()->toggle($receta);
    }
}
