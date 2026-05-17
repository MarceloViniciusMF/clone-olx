@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1>Anúncios em {{ $category->name }}</h1>
        </div>
    </div>

    <div class="row">
        @forelse ($category->ads as $ad)
            
            @include('ads._ad_card', ['ad' => $ad])

        @empty
            <div class="col">
                <p class="text-center fs-4 mt-5">Que pena!</p>
                <p class="text-center">Ainda não há nenhum anúncio publicado nesta categoria.</p>
                
                @auth
                    <p class="text-center">
                        <a href="{{ route('ads.create') }}" class="btn btn-primary">Seja o primeiro a anunciar!</a>
                    </p>
                @endauth
            </div>
        @endforelse
    </div>
</div>
@endsection