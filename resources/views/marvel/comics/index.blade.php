@extends('layouts.marvel')

@section('content')
    <div class="relative overflow-hidden bg-cover bg-no-repeat" style="
        background-position: 50%;
        background-image: url('{{ asset('storage/bg_marvel.jpg') }}');
        height: 300px;
      ">
        <div
            class="absolute top-0 right-0 bottom-0 left-0 h-full w-full overflow-hidden bg-[hsla(0,0%,0%,0.75)] bg-fixed">
            <div class="flex h-full items-center justify-center">
                <div class="px-6 text-center text-white md:px-12">
                    <h1 class="mt-2 mb-8 text-3xl font-bold tracking-tight md:text-4xl xl:text-5xl">
                        CÓMICS DE MARVEL
                    </h1>
                    <p class="text-xl mt-2 mb-8">Sumérgete en la rica biblioteca de cómics de Marvel, donde cada página te sumerge en aventuras épicas y batallas memorables.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Formulario de búsqueda -->
    <form action="{{ route('comics.index') }}" method="GET" class="mb-6">
        <div class="flex items-center justify-center mt-5 mb-5">
            <input type="text" name="search" value="{{ $searchTerm ?? '' }}" placeholder="Buscar cómics..." class="text-xl w-50 px-4 py-2 border-b-2 border-white focus:outline-none focus:border-red-600 bg-transparent placeholder-white text-white">
            <button type="submit" class="ml-2 px-6 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors duration-300 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
        </div>
    </form>
    @if (session('success'))
        <div class="text-center bg-green-600 px-4 py-2 rounded-md mb-4">
            {{ session('success') }}
            <a href="{{ route('favorites.index') }}" class="text-white font-bold ml-2">Ir a favoritos</a>
        </div>
    @endif

    @if (session('error'))
        <div class="text-center bg-red-600 px-4 py-2 rounded-md mb-4">
            {{ session('error') }}
            <a href="{{ route('favorites.index') }}" class="text-white font-bold ml-2">Ir a favoritos</a>
        </div>
    @endif
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($comics as $comic)
                <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300 text-white flex flex-col relative">
                    <!-- Botón de Favoritos -->
                    @auth
                        <form action="{{ route('favorites.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="favoritable_id" value="{{ $comic['id'] }}">
                            <input type="hidden" name="favoritable_type" value="comics">
                            <input type="hidden" name="title" value="{{ $comic['title'] }}">
                            <input type="hidden" name="image_url" value="{{ $comic['thumbnail']['path'].'.'.$comic['thumbnail']['extension'] }}">
                            <input type="hidden" name="description" value="{{ $comic['description'] }}">

                            <button type="submit" class="favorite-btn absolute top-2 left-2 text-2xl text-red-300 hover:text-red-600 focus:outline-none">
                                <i class="far fa-heart"></i>
                            </button>
                        </form>
                    @endauth
                    <img class="w-full h-64 object-cover" src="{{ $comic['thumbnail']['path'].'.'.$comic['thumbnail']['extension'] }}" alt="{{ $comic['title'] }}">
                    <div class="p-4 flex-grow">
                        <h2 class="text-xl font-bold mb-2 text-red-600">
                            <a href="{{ route('comics.show', $comic['id']) }}" class="hover:underline">{{ $comic['title'] }}</a>
                        </h2>
                        <p class="text-gray-300 mt-2">Descripción: </p>
                        @if($comic['description'])
                            <p class="text-white">{{ Str::limit($comic['description'], 150) }}</p>
                        @else
                            <p class="text-white">Descripción no disponible</p>
                        @endif
                        <p class="text-gray-300 mt-2">Creadores: </p>
                        {{ $comic['creators']['items'] ? implode(', ', array_column($comic['creators']['items'], 'name')) : 'Creadores no disponibles' }}
                    </div>
                    <a href="{{ route('comics.show', $comic['id']) }}" class="bg-red-600 text-white py-2 px-4 text-center hover:bg-red-700 transition-colors duration-300 mt-auto">Más Detalles</a>
                </div>
            @endforeach
        </div>

        {{-- Paginación --}}
        @if(is_object($comics) && method_exists($comics, 'links'))
            <div class="mt-4">
                {{ $comics->links() }}
            </div>
        @endif
    </div>
@endsection
