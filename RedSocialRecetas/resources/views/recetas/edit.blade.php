@extends('layouts.app')

@section('styles')
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.css" integrity="sha512-qjOt5KmyILqcOoRJXb9TguLjMgTLZEgROMxPlf1KuScz0ZMovl0Vp8dnn9bD5dy3CcHW5im+z5gZCKgYek9MPA==" crossorigin="anonymous" />



@section('botones')

<a href="{{ route('recetas.index')}}"class="btn btn-primary mr-2 text-white">
    <svg class="icono" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
</svg>Volver</a>
@endsection

@section('content')

  

<h2 class="text-center mb-5">Editar Receta : {{$receta->titulo}}</h2>



<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        {{-- se pueden realizar dos tipos de validaciones desde html 5 , o desde no validate del controlador --}}
        <form method="POST" action="{{ route('recetas.update', ['receta' => $receta->id]) }}" enctype="multipart/form-data"  novalidate>
            @csrf

            @method('PUT')
            <div class="form-group">
                <label for="titulo">Titulo Receta </label>

                <input type="text"
                        name="titulo"
                        class="form-control @error('titulo') is-invalid  @enderror"                 
                        id="titulo"
                        placeholder="Titulo Receta"
                        value="{{$receta->titulo}}"
                >

                @error('titulo')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    
                @enderror
            </div>

            <div class="form-group">
                <label for="categoria">Categoria </label>

                <select
                name="categoria"
                class="form-control @error('categoria') is-invalid @enderror"
                id="categoria">   
                    <option value="">--Seleccione--</option>
                    @foreach($categorias as $categoria)
                        <option 
                        value="{{$categoria->id}}" 
                        {{ $receta->categoria_id == $categoria->id ? 'selected' : "" }}>{{ $categoria->nombre}}
                        </option>
                    @endforeach 
                    
                </select>

                @error('categoria')
                      <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mt-5" >
                <label for="preparacion">Preparacion</label>

                <input id="preparacion" type="hidden" name="preparacion" value="{{$receta->preparacion}}"></input>
                
                <trix-editor class="form-control @error('preparacion') is-invalid @enderror "input="preparacion"></trix-editor>

                  @error('preparacion')
                      <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
             <div class="form-group mt-5" >
                <label for="ingredientes">Ingredientes</label>

                <input id="ingredientes" type="hidden" name="ingredientes" value="{{$receta->ingredientes}}"></input>
                
                <trix-editor class="form-control @error('ingredientes') is-invalid @enderror "input="ingredientes"></trix-editor>

                  @error('ingredientes')
                      <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>

              <div class="form-group mt-5" >
                <label for="imagen">Elije la Imagen</label>
 
                <input id="imagen" type="file" class="form-control @error('imagen') is-invalid @enderror" name="imagen" ></input>
               

                @error('imagen')
                      <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
                   <div class="mt-4">
                    <p>Imagen Actual : </p>

                    <img src="/storage/{{$receta->imagen}}" style="width : 300px">
                </div>
            </div>
          
            <div class="form-group">

                <input type="submit"
                        class="btn btn-primary"
                        value="Guardar Cambios"
                />

            </div>
        </form>
    <div>
<div>
    
@endsection('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.js" integrity="sha512-zEL66hBfEMpJUz7lHU3mGoOg12801oJbAfye4mqHxAbI0TTyTePOOb2GFBCsyrKI05UftK2yR5qqfSh+tDRr4Q==" crossorigin="anonymous" defer></script>
@endsection



