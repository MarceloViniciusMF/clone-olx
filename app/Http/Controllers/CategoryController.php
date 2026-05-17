<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Mostra uma categoria e todos os anúncios associados a ela.
     */
    public function show(Category $category)
    {
        // 1. Carregar os anúncios relacionados a esta categoria
        // Usamos 'load' para carregar a relação 'ads' que definimos no Modelo
        // Também carregamos a 'categoria' de cada anúncio (útil para o card)
        $category->load(['ads' => function ($query) {
            $query->with('category')->latest();
        }]);

        // 2. Passar a categoria (que agora contém seus anúncios) para a view
        return view('categories.show', ['category' => $category]);
    }
}