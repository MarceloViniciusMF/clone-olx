<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdController extends Controller
{
    /**
     * Mostra o formulário para criar um novo anúncio.
     */
    public function create()
    {
        // Precisamos de todas as categorias para popular o <select> no formulário
        $categories = Category::all();

        return view('ads.create', ['categories' => $categories]);
    }

    /**
     * Salva o novo anúncio no banco de dados.
     */
    public function store(Request $request)
    {
        // 1. Validação dos campos
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id', // Verifica se a Categoria existe
            'price'       => 'required|numeric|min:0',
            'location'    => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        // 2. Tratamento de upload de imagem
        $path = null;
        if ($request->hasFile('image')) {
            // Salva o arquivo na pasta 'storage/app/public/ads/images'
            // A variável $path conterá 'ads/images/nome_do_arquivo.jpg'
            $path = $request->file('image')->store('ads/images', 'public');
        }

        // 3. Gerar o slug
        // Adicionamos um timestamp (número do tempo) para garantir que o slug seja único
        $slug = Str::slug($validated['title']) . '-' . time();

        // 4. Adicionar o ID do usuário logado e o slug aos dados validados
        $data = array_merge($validated, [
            'user_id' => Auth::id(), // Pega o ID do usuário logado
            'slug'    => $slug,
            'image_path' => $path,
        ]);

        // 5. Criar o anúncio
        Ad::create($data);

        // 6. Redirecionar (vamos redirecionar para a 'home' por enquanto)
        return redirect()->route('home')->with('success', 'Anúncio publicado com sucesso!');
    }

        // 7. Editar um anúncio
    public function edit(Ad $ad)
    {
        $this->authorize('update', $ad);

        $categories = Category::all();

        return view('ads.edit', ['ad' => $ad, 'categories' => $categories]);
    }

        // 8. Atualizar um anúncio
    public function update(Request $request, Ad $ad)
    {
        
        $this->authorize('update', $ad);

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'price'       => 'required|numeric|min:0',
            'location'    => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // 'nullable' = opcional
        ]);

        // Lidar com o Upload (se uma nova imagem foi enviada)
        if ($request->hasFile('image')) {
            // Apagar a imagem antiga
            if ($ad->image_path) {
                Storage::disk('public')->delete($ad->image_path);
            }
            
            // Salvar a nova imagem e atualizar o 'path'
            $path = $request->file('image')->store('ads/images', 'public');
            $validated['image_path'] = $path;
        }

        // Atualizar o slug se o título mudou
        if ($request->title != $ad->title) {
            $validated['slug'] = Str::slug($validated['title']) . '-' . time();
        }

        // Atualizar o anúncio no banco
        $ad->update($validated);

        // Redirecionar para a página do anúncio (show)
        return redirect()->route('ads.show', $ad)->with('success', 'Anúncio atualizado com sucesso!');
    }


        // 9. Mostrar anúncios usando "Eager Loading"
    public function show(Ad $ad)
    {
        $ad->load('user', 'category');

        return view('ads.show', ['ad' => $ad]);
    }

        // 10. Deleta Anúncios
    public function destroy(Ad $ad)
    {

        $this->authorize('delete', $ad);


        if ($ad->image_path && Storage::disk('public')->exists($ad->image_path)) {
            Storage::disk('public')->delete($ad->image_path);
        }

        $ad->delete();

        return redirect()->route('welcome')->with('success', 'Anúncio excluído com sucesso!');
    }
}