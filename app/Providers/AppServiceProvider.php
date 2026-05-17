<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // COMPARTILHA AS CATEGORIAS COM A VIEW DA BARRA DE CATEGORIAS
        // Este código vai rodar toda vez que o 'layouts.partials.categories' for carregado
        View::composer('layouts.partials.categories', function ($view) {

            // Aqui buscamos as categorias no banco.
            // Se você usa sub-categorias, o ideal é pegar só as "categorias-pai"
            $categories = Category::limit(10)->get();

            // Se você NÃO usa sub-categorias (parent_id), use este código:
            // $categories = Category::limit(10)->get();

            // Envia a variável $categories para a view
            $view->with('categories', $categories);
        });
    }
}
