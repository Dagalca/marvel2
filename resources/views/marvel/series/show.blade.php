@extends('layouts.marvel')

@section('content')
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="col-span-1">
                <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg text-white p-4">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="font-bold text-2xl mb-4 text-red-600">{{ $series['title'] }}</h2>
                        <a href="{{ route('series.index') }}" class="inline-block bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-red-700 transition-colors duration-300">Volver</a>
                    </div>
                    @if ($series['thumbnail'] && $series['thumbnail']['path'] && $series['thumbnail']['extension'])
                        <img class="w-full object-cover object-center mb-4" src="{{ $series['thumbnail']['path'].'.'.$series['thumbnail']['extension'] }}" alt="{{ $series['title'] }}">
                    @endif

                    <div class="mb-4">
                        <h3 class="font-bold text-lg mb-2">Descripción:</h3>
                        <p>{{ $series['description'] ?: 'No disponible' }}</p>
                    </div>
                </div>
            </div>

            <div class="col-span-1 lg:col-span-2">
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg text-white p-4">
                        <h3 class="font-bold text-lg mb-2">Personajes:</h3>
                        <ul>
                            @if(isset($relatedCharacters) && !empty($relatedCharacters))
                                @foreach ($relatedCharacters as $character)
                                    <li><a href="{{ route('characters.show', basename($character['resourceURI'])) }}" class="hover:text-red-600 hover:underline">{{ isset($character['name']) ? $character['name'] : 'Nombre no disponible' }}</a></li>
                                @endforeach
                            @else
                                <li>No disponible</li>
                            @endif
                        </ul>
                    </div>

                    <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg text-white p-4">
                        <h3 class="font-bold text-lg mb-2">Creadores:</h3>
                        <ul>

                                @if(isset($series['creators']) && isset($series['creators']['items']))
                                    @foreach ($series['creators']['items'] as $creator)
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

