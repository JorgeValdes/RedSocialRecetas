@extends('layouts.app')

@section('botones')
     {{--  {{Auth::user() }}  --}}
    {{-- se crea un archivo para la navegacion  --}}
    @include('ui.navegacion')
@endsection

@section('content')

<h2 class="text-center mb-5">Administra tus recetas </h2>


<div class="=col-md-10 mx-auto bg-white p-3">
    <table class="table">
        <thead class="bg-primary text-white">
            <tr>
                <th scole="col">Titulo</th>
                <th scole="col">Categoria</th>
                <th scole="col">Acciones</th>
              {{--   <th scole="col">Ingredientes</th>
                <th scole="col">Preparacion</th> --}}
            </tr>
        </thead>

        <tbody>
            @foreach($recetas as $receta )
            <tr>
                <td>{{$receta->titulo}}</td>
                <td>{{$receta->categoria->nombre}}</td>
               {{--   <td>{{$receta->ingredientes}}</td>
                 <td>{{$receta->preparacion}}</td> --}}
                 <td>
                  


                    <eliminar-receta receta-id={{ $receta->id }}></eliminar-receta>  
                  
                    <a href="{{ route('recetas.edit', ['receta' => $receta->id]) }}" class="btn btn-dark d-block w-100 mb-2">Editar</a>
                    <a href="{{ route('recetas.show', ['receta' => $receta->id]) }}" class="btn btn-success d-block w-100 mb-2">Ver</a>
                    {{-- se puede usar action('RecetaController@show' o tambien route  --}}
                 </td>
                    
             
            </tr>
            @endforeach
         
        </tbody>
    </table>

    <div class="col-12 mt-4 justify-content-center d-flex">
    {{$recetas->links()}}

    </div>

</div>

@endsection
