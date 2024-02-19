@extends('layouts.marvel')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="font-bold text-center text-4xl text-red-600 mb-3">{{ $character['name'] }}</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="col-span-1">
                <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg text-white p-4">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="font-bold text-2xl text-red-600">{{ $character['name'] }}</h2>
                        <a href="{{ route('characters.index') }}" class="inline-block bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-red-700 transition-colors duration-300">Volver</a>

                    </div>

                    @if(isset($character['thumbnail']) && isset($character['thumbnail']['path']) && isset($character['thumbnail']['extension']))
                        <img class="w-full object-cover object-center mb-4" src="{{ $character['thumbnail']['path'].'.'.$character['thumbnail']['extension'] }}" alt="{{ $character['name'] }}">
                    @endif

                    <div class="mb-4">
                        <h3 class="font-bold text-lg mb-2">Descripción:</h3>
                        <p>{{ $character['description'] ?: 'No disponible' }}</p>
                    </div>
                </div>
            </div>

            <div class="col-span-1 lg:col-span-2">
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg text-white p-4">
                        <h3 class="font-bold text-lg mb-2">Comics:</h3>
                        <ul>
                            @forelse ($relatedItems['comics'] as $comicItem)
                                <li><a href="{{ route('comics.show', $comicItem['id']) }}" class="hover:text-red-600 hover:underline">{{ $comicItem['title'] }}</a></li>
                            @empty
                                <li>No disponible</li>
                            @endforelse

                        </ul>
                    </div>

                    <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg text-white p-4">
                        <h3 class="font-bold text-lg mb-2">Historias:</h3>
                        <ul>
                            @forelse ($relatedItems['stories'] as $storyItem)
                                <li><a href="{{ route('stories.show', $storyItem['id']) }}" class="hover:text-red-600 hover:underline">{{ $storyItem['title'] }}</a></li>
                            @empty
                                <li>No disponible</li>
                            @endforelse
                        </ul>
                    </div>

                    <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg text-white p-4">
                        <h3 class="font-bold text-lg mb-2">Series:</h3>
                        <ul>
                            @forelse ($relatedItems['series'] as $serieItem)
                                <li><a href="{{ route('series.show', $serieItem['id']) }}" class="hover:text-red-600 hover:underline">{{ $serieItem['title'] }}</a></li>
                            @empty
                                <li>No disponible</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
