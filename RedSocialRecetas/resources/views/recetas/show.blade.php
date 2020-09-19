@extends('layouts.app')

@section('content')
    <article class="contenido-receta bg-white p-5 shadow">
        <h1 class="text-center mb-4">{{$receta->titulo}}</h1>
        <div class="imagen-receta">
            <img src="/storage/{{ $receta->imagen}}" class="w-100">

        </div>
        <div class="receta-meta mt-5">
        <p>
            <span class="font-weight-bold text-primary">Escrito en : 
               
            </span>
            <span> {{$receta->categoria->nombre}}</span>
        </p>
          <p>
            <span class="font-weight-bold text-primary">Autor : 
                {{-- Todo : Mostrar el usuario --}}
                
            </span>
            <span>{{$receta->autor->name}}</span>
        </p>
           <p>
            <span class="font-weight-bold text-primary">Fecha:</span>
                {{-- Todo : Mostrar el usuario --}}

                @php
                    $fecha = $receta->created_at
                @endphp 
                 <fecha-receta fecha="{{$fecha}}"></fecha-receta>
            
        </p>
        
      

        <div class="ingredientes">
            <h2 class="my-3 text-primary">Ingredientes
            </h2>
            {!! $receta->ingredientes !!}
        </div>

        <div class="preparacion">
            <h2 class="my-3 text-primary">Preparacion
            </h2>
            {!! $receta->preparacion !!}
        </div>
     
        <likebutton 
        receta-id="{{ $receta->id}}"
        like="{{$like}}"
        likes="{{$likes}}"
        >
        
        
        </likebutton>
        </div>
    </article>
@endsection


