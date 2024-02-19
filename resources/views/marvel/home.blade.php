@extends('layouts.marvel')

@section('content')
    <div class="relative w-full h-screen overflow-hidden">
        <div class="absolute inset-0 bg-center bg-cover z-0" style="background-image: url('{{ asset('storage/marvel_universe.jpg') }}');">
        </div>
        <div class="absolute inset-0 bg-gray-900 bg-opacity-40 z-10 flex items-center justify-center">
            <div class="text-center text-white px-6 lg:px-0">
                <h1 class="text-4xl font-bold uppercase lg:text-5xl">Bienvenido al Universo Marvel</h1>
                <p class="text-lg mt-2">Marvel Comics es una de las principales editoriales de cómics en el mundo, creadora de algunos de los superhéroes y supervillanos más icónicos de la historia.</p>
                <p class="text-lg mt-2">Explora nuestro sitio para descubrir más sobre tus personajes, cómics y series favoritas del Universo Marvel.</p>
                <div class="flex flex-col items-center justify-center mt-5">
                    <p class="text-white text-xl mb-4">Inicia sesión o regístrate para crear tu propio Universo Marvel</p>
                    <div class="flex justify-center">
                        <a href="{{ route('login') }}" class="py-2 mr-2 px-6 bg-gray-50 hover:bg-gray-100 text-sm text-red-700 font-bold  rounded-xl transition duration-200">Iniciar sesión</a>
                        <a href="{{ route('register') }}" class="py-2 px-6 ml-4 bg-red-500 hover:bg-red-700 text-sm text-white font-bold rounded-xl transition duration-200">Registro</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 mt-12">
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg text-white">
            <h2 class="text-3xl font-bold mb-4">Explora el Dinámico Universo Marvel</h2>
            <p class="text-xl">¡Bienvenido a la asombrosa experiencia Marvel! Sumérgete en un mundo donde los superhéroes y supervillanos trascienden las páginas de cómics para convertirse en íconos de la cultura pop. Desde las calles de Nueva York con Spider-Man hasta las vastas extensiones del espacio con los Guardianes de la Galaxia, cada historia es una aventura épica.
                Marvel Comics, hogar de algunos de los personajes más icónicos y queridos del mundo, te invita a unirse a un viaje emocionante a través de relatos de valentía, sacrificio, y la lucha eterna entre el bien y el mal. Experimenta narrativas cautivadoras, llenas de acción y emoción, que han cautivado a millones alrededor del globo.</p>
        </div>
    </div>

    <!-- Sección de Personajes Destacados -->
    <div class="container mx-auto px-4 mt-12 relative">
        <a href="{{ route('characters.index') }}" class="text-white">
            <h2 class="text-3xl font-semibold mb-4">Personajes Destacados</h2>
        </a>
        <div class="scroll-container">
            <div class="horizontal-scroll">
                @foreach ($characters as $character)
                    <div class="scroll-item">
                        <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300 text-white flex flex-col h-full">
                            <img class="w-full h-64 object-cover" src="{{ $character['thumbnail']['path'].'.'.$character['thumbnail']['extension'] }}" alt="{{ $character['name'] }}">
                            <div class="p-4 h-48">
                                <h2 class="text-xl font-bold mb-2 text-red-600">
                                    <a href="{{ route('characters.show', $character['id']) }}" class="hover:underline">{{ $character['name'] }}</a>
                                </h2>

                                <p class="text-gray-300">{{ strlen($character['description'] ?: 'Descripción no disponible') > 100 ? substr($character['description'], 0, 100) . '...' : ($character['description'] ?: 'Descripción no disponible') }}</p>
                            </div>
                            <a href="{{ route('characters.show', $character['id']) }}" class="bg-red-600 text-white py-2 px-4 text-center hover:bg-red-700 transition-colors duration-300 mt-auto">Más Detalles</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="scroll-arrow left-arrow absolute top-1/2 transform -translate-y-1/2 left-0"><</button>
            <button class="scroll-arrow right-arrow absolute top-1/2 transform -translate-y-1/2 right-0">></button>
        </div>
    </div>

    <!-- Sección de Cómics Destacados -->
    <div class="container mx-auto px-4 mt-12 relative">
        <a href="{{ route('comics.index') }}" class="text-white">
            <h2 class="text-3xl font-semibold mb-4">Cómics Destacados</h2>
        </a>
        <div class="scroll-container">
            <div class="horizontal-scroll">
                @foreach ($comics as $comic)
                    <div class="scroll-item">
                        <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300 text-white flex flex-col h-full">
                            <img class="w-full h-64 object-cover" src="{{ $comic['thumbnail']['path'].'.'.$comic['thumbnail']['extension'] }}" alt="{{ $comic['title'] }}">
                            <div class="p-4 h-48">
                                <h2 class="text-xl font-bold mb-2 text-red-600">
                                    <a href="{{ route('comics.show', $comic['id']) }}" class="hover:underline">{{ $comic['title'] }}</a>
                                </h2>
                                <p class="text-gray-300">{{ strlen($comic['description'] ?: 'Descripción no disponible') > 100 ? substr($comic['description'], 0, 100) . '...' : ($comic['description'] ?: 'Descripción no disponible') }}</p>
                            </div>
                            <a href="{{ route('comics.show', $comic['id']) }}" class="bg-red-600 text-white py-2 px-4 text-center hover:bg-red-700 transition-colors duration-300 mt-auto">Más Detalles</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="scroll-arrow left-arrow absolute top-1/2 transform -translate-y-1/2 left-0"><</button>
            <button class="scroll-arrow right-arrow absolute top-1/2 transform -translate-y-1/2 right-0">></button>
        </div>
    </div>

    <!-- Sección de Series Destacadas -->
    <div class="container mx-auto px-4 mt-12 relative">
        <a href="{{ route('series.index') }}" class="text-white">
            <h2 class="text-3xl font-semibold mb-4">Series Destacadas</h2>
        </a>
        <div class="scroll-container">
            <div class="horizontal-scroll">
                @foreach ($series as $serie)
                    <div class="scroll-item">
                        <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300 text-white flex flex-col h-full">
                            <img class="w-full h-64 object-cover" src="{{ $serie['thumbnail']['path'].'.'.$serie['thumbnail']['extension'] }}" alt="{{ $serie['title'] }}">
                            <div class="p-4 h-48">
                                <h2 class="text-xl font-bold mb-2 text-red-600">
                                    <a href="{{ route('series.show', $serie['id']) }}" class="hover:underline">{{ $serie['title'] }}</a>
                                </h2>
                                <p class="text-gray-300">{{ strlen($serie['description'] ?: 'Descripción no disponible') > 100 ? substr($serie['description'], 0, 100) . '...' : ($serie['description'] ?: 'Descripción no disponible') }}</p>
                            </div>
                            <a href="{{ route('series.show', $serie['id']) }}" class="bg-red-600 text-white py-2 px-4 text-center hover:bg-red-700 transition-colors duration-300 mt-auto">Más Detalles</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="scroll-arrow left-arrow absolute top-1/2 transform -translate-y-1/2 left-0"><</button>
            <button class="scroll-arrow right-arrow absolute top-1/2 transform -translate-y-1/2 right-0">></button>
        </div>
    </div>

    <style>
        .scroll-container {
            position: relative;
            overflow: hidden;
        }

        .horizontal-scroll {
            display: flex;
            overflow-x: auto;
            scroll-behavior: smooth;
            margin-bottom: -15px;
        }

        .scroll-item {
            flex: 0 0 auto;
            width: calc(20% - 1rem);
            margin-right: 1rem;
        }

        .scroll-arrow {
            background-color: #ff0000;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 50%;
            font-size: 24px;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 20;
        }

        .left-arrow {
            transform: translate(-50%, -50%);
            left: 26px;
        }

        .right-arrow {
            transform: translate(50%, -50%);
            right: 26px;
        }
    </style>

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const scrollContainers = document.querySelectorAll('.scroll-container');

            scrollContainers.forEach(container => {
                const leftArrow = container.querySelector('.left-arrow');
                const rightArrow = container.querySelector('.right-arrow');
                const scrollContent = container.querySelector('.horizontal-scroll');

                if (leftArrow) {
                    leftArrow.addEventListener('click', function() {
                        scrollContent.scrollLeft -= 200;
                    });
                }

                if (rightArrow) {
                    rightArrow.addEventListener('click', function() {
                        scrollContent.scrollLeft += 200;
                    });
                }
            });
        });
    </script>
@endsection
