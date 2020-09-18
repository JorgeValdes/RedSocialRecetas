<?php

namespace App\Http\Controllers;

use App\User;
use App\Receta;
use App\CategoriaReceta;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Auth\Access\HandlesAuthorization;


class RecetaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //Auth::user()->recetas->dd(); //con este método y la relacion me traigo las recetas por usuario
        //Auth::user()->recetas->dd(); //con este método y la relacion me traigo las recetias por usuario
        //recetas con paginacion
        $usuario = auth()->user();

        // $meGusta = auth()->user()->meGusta;
        $recetas = Receta::where('user_id', $usuario->id)->paginate(2);

        return view('recetas.index')
            ->with('recetas', $recetas)
            ->with('usuario', $usuario);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()


    {
        //metodo get me trae todos los elementos de esa tabla y
        // tambien el metodo pluck solamente nos trae los campos que nos quiere 
        /*  $categorias = DB::table('categoria_recetas')->get()->pluck('nombre', 'id');
         */


        //Obtener las categorias con Modelo
        $categorias = CategoriaReceta::all(['id', 'nombre']);
        return view('recetas.create')->with('categorias', $categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd( $request['imagen']->store('upload-recetas', 'public')); //dependiendo de tu servicio se puede almacena


        //Validacion 
        $data = request()->validate([
            'titulo' => 'required|min:6',
            'categoria' => 'required',
            'preparacion' => 'required',
            'ingredientes' => 'required',
            'imagen' => 'required|image' //se le púeden agregar diferentes reglas de validacion
        ]);

        //obtener la ruta de la imagen
        $ruta_imagen = $request['imagen']->store('upload-recetas', 'public');

        //resize de la imagen

        $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1200, 550);
        $img->save();

        //almacenar en la base de datos sin el modelo todavia 
        //DB SE OCUPA SIN LOS MODELOS
        /*    DB::table('recetas')->insert([
            'titulo' => $data['titulo'],
            'ingredientes' => $data['ingredientes'],
            'preparacion' => $data['preparacion'],
            'imagen' => $ruta_imagen,
            'user_id' => Auth::user()->id, //funcion para guardar el usuario autenticado
            'categoria_id' => $data['categoria']
        ]); */

        //almacenar en la base de datos con modelos

        auth()->user()->recetas()->create([
            'titulo' => $data['titulo'],
            'ingredientes' => $data['ingredientes'],
            'preparacion' => $data['preparacion'],
            'imagen' => $ruta_imagen,
            //'user_id' => Auth::user()->id, //funcion para guardar el usuario autenticado
            'categoria_id' => $data['categoria']
        ]);


        //redirecionnar

        return redirect()->action('RecetaController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        //obtener si el usuario le ha dado me gusta a la receta
        $like = (auth()->user()) ? auth()->user()->meGusta->contains($receta->id) : false;
        //return view('recetas.show', compact('receta'));
        //constructor pk que las recetas que se muestren

        $likes = $receta->likes->count();
        return view('recetas.show', compact('receta', 'like', 'likes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        $categorias = CategoriaReceta::all(['id', 'nombre']);
        return view('recetas.edit', compact('categorias', 'receta')); /* uso compact en el caso que sean mas de dos atributos para pasar a la vista */
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {

        //return revisar el policy;
        //$this->authorize('update', $receta);

        $data = $request->validate([
            'titulo' => 'required|min:6',
            'categoria' => 'required',
            'preparacion' => 'required',
            'ingredientes' => 'required',
            //se le púeden agregar diferentes reglas de validacion
        ]);

        //Asignar los valores
        $receta->titulo = $data['titulo'];
        $receta->categoria_id = $data['categoria'];
        $receta->preparacion = $data['preparacion'];
        $receta->ingredientes = $data['ingredientes'];

        //En el caso que el usuario quiera subir una nueva imagen
        if (request('imagen')) {
            $ruta_imagen = $request['imagen']->store('upload-recetas', 'public');

            //resize de la imagen

            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1200, 550);
            $img->save();

            //Asignamos el objetos
            $receta->imagen = $ruta_imagen;
        }

        $receta->save();
        return redirect()->action('RecetaController@index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        //Ejecutar el policy



        $receta->delete();
        return redirect()->action('RecetaController@index');
    }
}
