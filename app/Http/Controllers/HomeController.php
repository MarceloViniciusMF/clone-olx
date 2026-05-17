<?php

namespace App\Http\Controllers;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard ("Meus Anúncios").
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // 1. Pegar o ID do usuário logado
        $userId = Auth::id();

        // 2. Buscar anúncios ONDE 'user_id' é igual ao $userId
        $ads = Ad::where('user_id', $userId)
            ->with('category')
            ->latest()
            ->get();

        // 4. Envia os anúncios filtrados para a view 'home'
        return view('home', ['ads' => $ads]);
        
    }
}
