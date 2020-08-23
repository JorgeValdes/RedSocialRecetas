<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecetaController extends Controller


{
 

    public function __invoke(Request $request)
    {

        $recetas = ['Receta Pizza', 'Receta Hamburguesa', 'Receta Tacos'];
        $categorias = ['Comida Mexicana', 'Comida Argentinca', 'Postre'];
        
        return view('recetas.index')
                ->with('recetas', $recetas)
                ->with('categorias', $categorias);

        // return view('recetas.index', compact(('recetas' , 'categorias')));
    }
}
