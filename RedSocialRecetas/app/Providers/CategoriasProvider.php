<?php

namespace App\Providers;

use App\CategoriaReceta;
use Illuminate\Support\ServiceProvider;
use View;


class CategoriasProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //Dependencias que se ejecutan despues del proyecto
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //caso de uso para provider , requieres algo de uso de laravel
        View::composer('*', function ($view) {
            $categorias = CategoriaReceta::all();
            $view->with('categorias', $categorias);
        });
    }
}
