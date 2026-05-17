@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">{{ __('Meus Anúncios') }}</div>

                    <div class="card-body">
                        <div class="row">
                            @forelse ($ads as $ad)

                                @include('ads._ad_card', ['ad' => $ad])

                            @empty
                                <div class="col">
                                    <p class="text-center">Você ainda não publicou nenhum anúncio</p>
                                    <p class="text-center">
                                        <a href="{{ route('ads.create') }}" class="btn btn-primary">Clique aqui para anunciar!</a>
                                    </p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection