@extends('layouts.app')

@section('botones')

<a href="{{ route('recetas.create')}}" class="btn btn-primary mr-2 text-white">Crear recetas</a>
@endsection

@section('content')

<h2 class="text-center mb-5">Administra tus recetas </h2>
<div class="=col-md-10 mx-auto bg-white p-3">
    <table class="table">
        <thead class="bg-primary text-ligth">
            <tr>
                <th scole="col">Titulo</th>
                <th scole="col">Categoria</th>
                <th scole="col">Acciones</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>PIzzas</td>
                <td>laskds</td>
            </tr>
        </tbody>
    </table>
</div>

@endsection
