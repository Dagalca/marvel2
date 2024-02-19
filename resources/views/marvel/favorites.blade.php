{{-- resources/views/favorites.blade.php --}}
@extends('layouts.marvel')

@section('content')
    <div class="relative overflow-hidden bg-cover bg-no-repeat" style="
        background-position: 50%;
        background-image: url('{{ asset('storage/bg_marvel.jpg') }}');
        height: 300px;
      ">
        <div class="absolute top-0 right-0 bottom-0 left-0 h-full w-full overflow-hidden bg-[hsla(0,0%,0%,0.75)] bg-fixed">
            <div class="flex h-full items-center justify-center">
                <div class="px-6 text-center text-white md:px-12">
                    <h1 class="mt-2 mb-8 text-3xl font-bold tracking-tight md:text-4xl xl:text-5xl">
                        MIS FAVORITOS
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container mx-auto px-4 py-6">

        @php
            $types = ['characters' => 'Personajes', 'comics' => 'Cómics', 'creators' => 'Creadores', 'series' => 'Series', 'stories' => 'Historias'];
        @endphp

        @foreach($types as $type => $title)
            <h1 class="text-3xl font-bold mb-4 mt-6">
                @if (Str::contains($title, ['Series', 'Historias']))
                    Mis {{ $title }} Favoritas
                @else
                    Mis {{ $title }} Favoritos
                @endif
            </h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @if ($favorites->where('favoritable_type', $type)->isEmpty())
                    <p class="text-white text-l">No has añadido ninguno aún.</p>
                @else
                    @foreach ($favorites->where('favoritable_type', $type) as $favorite)
                        <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition duration-300 text-white flex flex-col relative">
                            @auth
                                <form action="{{ route('favorites.remove', $favorite->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este favorito?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="absolute top-2 left-2 text-2xl text-red-600 hover:text-red-700 focus:outline-none">
                                        <i class="fas fa-heart"></i> <!-- Ícono de corazón relleno -->
                                    </button>
                                </form>
                            @endauth
                            @if ($favorite['image_url'] !== 'default_image.jpg')
                                <img class="w-full h-64 object-cover" src="{{ $favorite['image_url'] }}" alt="{{ $favorite['title'] }}">
                            @endif
                            <div class="p-4 flex-grow">
                                <h2 class="text-xl font-bold mb-2  mt-4 text-red-600">
                                    <a href="{{ route($type . '.show', $favorite['favoritable_id']) }}" class="hover:underline">{{ $favorite['title'] }}</a>
                                </h2>
                                <p class="text-gray-300">{{ $favorite['description'] ?: 'Descripción no disponible' }}</p>
                            </div>
                            <a href="{{ route($type . '.show', $favorite['favoritable_id']) }}" class="bg-red-600 text-white py-2 px-4 text-center hover:bg-red-700 transition-colors duration-300 mt-auto">Más Detalles</a>
                        </div>
                    @endforeach
                @endif
            </div>
        @endforeach
    </div>
@endsection
