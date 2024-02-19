@extends('layouts.marvel')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="font-bold text-5xl text-center mb-4 text-red-600">{{ $creator['fullName'] }}</h1>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-1">
                <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg text-white p-4">
                    <div class="flex justify-between items-center mb-4">
                    <h1 class="font-bold text-2xl text-center mb-4 text-red-600">{{ $creator['fullName'] }}</h1>
                    <a href="{{ route('creators.index') }}" class="inline-block bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-red-700 transition-colors duration-300">Volver</a>
                   </div>
                    @if (isset($creator['thumbnail']) && isset($creator['thumbnail']['path']) && isset($creator['thumbnail']['extension']))
                        <img class="w-full object-cover object-center mb-4" src="{{ $creator['thumbnail']['path'].'.'.$creator['thumbnail']['extension'] }}" alt="{{ $creator['fullName'] }}">
                    @endif
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg text-white p-4">
                    <h3 class="font-bold text-lg mb-2">Comics:</h3>
                    <ul>
                        @if(isset($relatedComics) && !empty($relatedComics))
                            @foreach ($relatedComics as $comic)
                                <li><a href="{{ route('comics.show', $comic['id']) }}" class="text-gray-300 hover:text-red-600">{{ $comic['title'] }}</a></li>
                            @endforeach
                        @else
                            <li>No disponible</li>
                        @endif
                    </ul>
                </div>

                <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg text-white p-4 mt-6">
                    <h3 class="font-bold text-lg mb-2">Series:</h3>
                    <ul>
                        @if(isset($relatedSeries) && !empty($relatedSeries))
                            @foreach ($relatedSeries as $serie)
                                <li><a href="{{ route('series.show', $serie['id']) }}" class="text-gray-300 hover:text-red-600">{{ $serie['title'] }}</a></li>
                            @endforeach
                        @else
                            <li>No disponible</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
