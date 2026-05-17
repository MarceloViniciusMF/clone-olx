<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdController;
use App\Models\Ad;
use App\Http\Controllers\CategoryController;
use App\Models\Category;
use App\Http\Controllers\SearchController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/anuncio/{ad:slug}', [AdController::class, 'show'])->name('ads.show');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //Rota para filtar por categoria
Route::get('/categoria/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');
    
//Rota para buscar
Route::get('/pesquisar', [SearchController::class, 'index'])->name('search.index');

Route::middleware(['auth'])->group(function () {

    // Rota para mostrar o formulário e a lista de categorias
    Route::get('/admin/categories', [AdminCategoryController::class, 'index'])->name('admin.categories.index');

    // Rota para salvar a nova categoria (quando o formulário for enviado)
    Route::post('/admin/categories', [AdminCategoryController::class, 'store'])->name('admin.categories.store');

});

Route::middleware(['auth'])->group(function () {
    // ... (rotas de categorias que já estavam aqui)

    // Rota para MOSTRAR o formulário de criação de anúncio
    Route::get('/anunciar', [AdController::class, 'create'])->name('ads.create');

    // Rota para SALVAR o novo anúncio
    Route::post('/anunciar', [AdController::class, 'store'])->name('ads.store');

    // Rota para Deletar o anúncio
    Route::delete('/anuncio/{ad}', [AdController::class, 'destroy'])->name('ads.destroy');

    // Rota para MOSTRAR o formulário de edição
    Route::get('/anuncio/{ad}/editar', [AdController::class, 'edit'])->name('ads.edit');

    // Rota para ATUALIZAR o anúncio no banco
    Route::put('/anuncio/{ad}', [AdController::class, 'update'])->name('ads.update');
});

Route::get('/', function () {
    // 1. Busca todos os anúncios
    $ads = Ad::with('category')->latest()->get();

    // 2. Busca todas as categorias
    $categories = Category::all();

    // 3. Envia AMBOS para a view
    return view('welcome', [
        'ads' => $ads,
        'categories' => $categories // <-- Esta linha corrige o erro
    ]);
})->name('welcome');
