<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Mostra os resultados da pesquisa.
     */
    public function index(Request $request)
    {
        // 1. Pegar o termo da query string (URL) ?q=...
        $query = $request->input('q');

        // 2. Se a query não estiver vazia, pesquise
        if ($query) {
            // Usamos 'LIKE' e '%' para procurar por 'partes' do título
            // Ex: "fusca" encontra "Vende-se Fusca Azul"
            $ads = Ad::where('title', 'LIKE', "%{$query}%")
                        ->with('category')
                        ->latest()
                        ->get();
        } else {
            // Se a pesquisa for vazia, retorna uma coleção vazia
            $ads = collect(); // Cria uma coleção vazia do Laravel
        }

        // 3. Retorna a view de resultados
        return view('search.results', [
            'ads' => $ads,
            'query' => $query
        ]);
    }
}