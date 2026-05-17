@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h2>{{ $ad->title }}</h2>
                    </div>

                    <div class="card-body">
                        <div class="mb-4 text-center">
                            <img src="{{ Storage::url($ad->image_path) }}" class="img-fluid rounded mx-auto d-block"
                                alt="{{ $ad->title }}" style="max-height: 450px; object-fit: contain;">
                        </div>

                        <h3 class="fw-bold text-primary mb-3">
                            R$ {{ number_format($ad->price, 2, ',', '.') }}
                        </h3>

                        <div class="mb-3 p-3 bg-light rounded">
                            <p class="mb-1">
                                <strong>Vendedor:</strong> {{ $ad->user->name }}
                            </p>
                            <p class="mb-1">
                                <strong>Categoria:</strong>
                                <a href="{{ route('categories.show', $ad->category) }}">{{ $ad->category->name }}</a>
                            </p>
                            <p class="mb-1">
                                <strong>Localização:</strong> {{ $ad->location }}
                            </p>
                            <p class="text-muted mb-0">
                                Postado em: {{ $ad->created_at->format('d/m/Y \à\s H:i') }}
                            </p>
                        </div>

                        @can('update', $ad)
                            <div class="mt-3 mb-3 p-3 border rounded">
                                <h5>Ações do Proprietário</h5>
                                <a href="{{ route('ads.edit', $ad) }}" class="btn btn-secondary">Editar Anúncio</a>
                                <form method="POST" action="{{ route('ads.destroy', $ad) }}" style="display:inline-block;">
                                    @csrf @method('DELETE') <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Tem certeza que quer excluir este anúncio? Isso não pode ser desfeito.')">
                                        Excluir Anúncio
                                    </button>
                                </form>
                            </div>
                        @endcan

                        <div class="mt-4">
                            <h4>Descrição</h4>
                            <hr>
                            <p style="white-space: pre-wrap;">{{ $ad->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection