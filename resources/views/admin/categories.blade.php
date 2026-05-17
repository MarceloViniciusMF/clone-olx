@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">{{ __('Adicionar Nova Categoria') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.categories.store') }}">
                        @csrf <div class="mb-3">
                            <label for="name" class="form-label">Nome da Categoria</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" required>
                            
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Salvar Categoria</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">{{ __('Categorias Existentes') }}</div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse ($categories as $category)
                            <li class="list-group-item">{{ $category->name }}</li>
                        @empty
                            <li class="list-group-item">Nenhuma categoria cadastrada.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection