<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class AdminCategoryController extends Controller
{
    /**
     * Mostra o formulário de criação e a lista de categorias.
     */
    public function index()
    {
        // Busca todas as categorias do banco de dados
        $categories = Category::all(); 

        // Retorna a view que criamos, passando as categorias para ela
        return view('admin.categories', ['categories' => $categories]);
    }

    /**
     * Salva uma nova categoria no banco de dados.
     */
    public function store(Request $request)
    {
        // 1. Validar os dados (garantir que o campo 'name' foi enviado e é único)
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);

        // 2. Criar e salvar a categoria
        Category::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']), // Ex: "Carros e Peças" -> "carros-e-pecas"
        ]);

        // 3. Redirecionar de volta para a página anterior (com mensagem de sucesso)
        return redirect()->route('admin.categories.index')->with('success', 'Categoria criada com sucesso!');
    }
}
