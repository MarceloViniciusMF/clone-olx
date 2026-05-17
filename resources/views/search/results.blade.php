@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1>Resultados da busca por: "{{ $query }}"</h1>
        </div>
    </div>

    <div class="row">
        @forelse ($ads as $ad)
            
            @include('ads._ad_card', ['ad' => $ad])

        @empty
            <div class="col">
                <p class="text-center fs-4 mt-5">Nenhum resultado encontrado.</p>
                <p class="text-center">Tente buscar por um termo diferente.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection