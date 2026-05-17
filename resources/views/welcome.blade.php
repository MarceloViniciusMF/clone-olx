@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1>Encontre tudo o que precisa!</h1>
            <p class="lead">Os anúncios mais recentes da sua região.</p>
        </div>
    </div>
    
    <div class="category-bar-wrapper mb-4">
    <nav class="nav nav-pills flex-nowrap">
        
        <li class="nav-item">
            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('welcome') }}">
                Todas
            </a>
        </li>

        @foreach ($categories as $category)
            <li class="nav-item">
                <a class="nav-link" href="{{ route('categories.show', $category) }}">
                    {{ $category->name }}
                </a>
            </li>
        @endforeach

    </nav>
</div>

    <div class="row">
        @forelse ($ads as $ad)
            
            @include('ads._ad_card', ['ad' => $ad])

        @empty
            <div class="col">
                <p class="text-center fs-4 mt-5">Que pena!</p>
                <p class="text-center">Ainda não há nenhum anúncio publicado.</p>
                
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