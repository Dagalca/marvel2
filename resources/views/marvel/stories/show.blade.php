@extends('layouts.marvel')

@section('content')
    <div class="container mx-auto px-4">
        <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg text-white p-4">
            <h2 class="font-bold text-2xl mb-4 text-red-600">{{ $story['title'] }}</h2>
            <p>{{ $story['description'] ?: 'No disponible' }}</p>
            <div class="mt-4">
                <p class="text-gray-400"><strong>Creadores:</strong></p>
                <ul>
                    @foreach($story['creators']['items'] as $creator)
                        <li>{{ $creator['name'] }} ({{ $creator['role'] }})</li>
                    @endforeach
                </ul>
            </div>
            <div class="mt-4">
                <p class="text-gray-400"><strong>Serie:</strong></p>
                <ul>
                    @foreach($story['series']['items'] as $serie)
                        <li>{{ $serie['name'] }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="mt-4">
                <p class="text-gray-400"><strong>Cómics:</strong></p>
                <ul>
                    @foreach($story['comics']['items'] as $comic)
                        <li>{{ $comic['name'] }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="flex justify-content-center items-center mb-4">
                <a href="{{ route('stories.index') }}" class="mt-5 bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-red-700 transition-colors duration-300">Volver</a>
            </div>
        </div>
    </div>
@endsection
