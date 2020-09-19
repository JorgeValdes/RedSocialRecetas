<?php

namespace App\Http\Controllers;

use App\Receta;
use App\CategoriaReceta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index()
    {
        // Mostar las recetas por cantidad de votos
        $votadas = Receta::has(); // has hace que el método cuente 
        // Obtener las recetas mas nuevas 
        //$nuevas = Receta::orderBy('created_at', 'ASC')->get();
        $nuevas = Receta::latest()->take(5)->get();
        //Recetas por categoria
        // una forma de hacerlo es esa 
        // $mexicana = Receta::lastest()->take(6)->get();

        //obtener todas las categorias
        $categorias = CategoriaReceta::all();

        // return $categorias;

        //Agrupar las recetas por categoria

        $recetas = [];

        foreach ($categorias as $categoria) {
            $recetas[Str::slug($categoria->nombre)][] = Receta::where('categoria_id', $categoria->id)->take(3)->get();
        }

        //pasarlas a la vista
        return view("inicio.index", compact('nuevas', 'recetas'));
    }
}
