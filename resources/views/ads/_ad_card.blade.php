<div class="col-md-6 mb-4">
                                    <div class="card h-100">

                                        <img src="{{ Storage::url($ad->image_path) }}" class="card-img-top"
                                            alt="{{ $ad->title }}" style="height: 200px; object-fit: cover;">

                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">{{ $ad->title }}</h5>

                                            <h6 class="card-subtitle mb-2 fw-bold">
                                                R$ {{ number_format($ad->price, 2, ',', '.') }}
                                            </h6>

                                            <a href="{{ route('categories.show', $ad->category) }}" class="card-text text-muted mb-2 text-decoration-none">
                                                {{ $ad->category->name }}
                                            </p>

                                            <p class="card-text">
                                                {{ Str::limit($ad->description, 100) }}
                                            </p>

                                            <a href="{{ route('ads.show', $ad) }}" class="btn btn-primary mt-auto">Ver
                                                Detalhes</a>
                                        </div>
                                        <div class="card-footer text-muted">
                                            Postado em {{ $ad->created_at->format('d/m/Y') }}
                                            <br>
                                            {{ $ad->location }}
                                        </div>
                                    </div>
                                </div>