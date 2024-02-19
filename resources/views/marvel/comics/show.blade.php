@extends('layouts.marvel')

@section('content')
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="col-span-1">
                <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg text-white p-4">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="font-bold text-2xl mb-4 text-red-600">{{ $comic['title'] }}</h2>
                        <a href="{{ route('comics.index') }}" class="inline-block bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-red-700 transition-colors duration-300">Volver</a>
                    </div>
                    @if ($comic['thumbnail'] && $comic['thumbnail']['path'] && $comic['thumbnail']['extension'])
                        <img class="w-full object-cover object-center mb-4" src="{{ $comic['thumbnail']['path'].'.'.$comic['thumbnail']['extension'] }}" alt="{{ $comic['title'] }}">
                    @endif

                    <div class="mb-4">
                        <h3 class="font-bold text-lg mb-2">Descripción:</h3>
                        <p>{{ $comic['description'] ?: 'No disponible' }}</p>
                    </div>
                </div>
            </div>

            <div class="col-span-1 lg:col-span-2">
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg text-white p-4">
                        <h3 class="font-bold text-lg mb-2">Personajes:</h3>
                        <ul>
                            @if(isset($comic['characters']) && isset($comic['characters']['items']))
                                @foreach ($comic['characters']['items'] as $character)
                                    <li><a href="{{ route('characters.show', basename($character['resourceURI'])) }}" class="hover:text-red-600 hover:underline">{{ $character['name'] }}</a></li>
                                @endforeach
                            @else
                                <li>No disponible</li>
                            @endif
                        </ul>
                    </div>

                    <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg text-white p-4">
                        <h3 class="font-bold text-lg mb-2">Creadores:</h3>
                        <ul>
                            @if(isset($comic['creators']) && isset($comic['creators']['items']))
                                @foreach ($comic['creators']['items'] as $creator)
                                    <li><a href="{{ route('creators.show', basename($creator['resourceURI'])) }}" class="hover:text-red-600 hover:underline">{{ $creator['name'] }}</a></li>
                                @endforeach
                            @else
                                <li>No disponible</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
