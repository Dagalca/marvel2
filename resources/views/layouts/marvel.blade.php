<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MARVEL UNIVERSE</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-*********" crossorigin="anonymous" />
    <link href="https://unpkg.com/swiper/swiper-bundle.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #000000; /* Fondo negro */
            color: #FFFFFF; /* Texto blanco */
        }

        .nav-link {
            font-size: 1.2rem;
            color: #FFFFFF; /* Texto blanco */
            font-weight: bold;
            padding: 0.5rem 1rem;
            transition: color 0.3s ease, text-decoration 0.3s ease;
        }

        .nav-link:hover, .nav-link:focus {
            color: #FF0000; /* Rojo Marvel en hover */
            text-decoration: underline;
        }

        nav {
            background-color: rgba(0, 0, 0, 0.5); /* Fondo negro con un 50% de transparencia */
        }


        footer {
            background-color: #000000; /* Fondo negro para el pie de página */
            color: #FFFFFF; /* Texto blanco en el pie de página */
        }

        h1, h2, .menu-item {
            font-family: 'Nunito', sans-serif;
        }

    </style>
</head>
<body>
<nav class="relative px-4 py-4 flex justify-between items-center">
    <a href="{{ route('marvel.home') }}" class="flex items-center">
        <img src="{{ asset('storage/Marvel_Logo.svg') }}" alt="Logo Marvel" class="h-10">
        <span class="text-3xl font-bold leading-none ml-4">UNIVERSE</span>
    </a>
    <ul class="lg:flex lg:space-x-6">
        <li><a href="{{ route('marvel.home') }}" class="nav-link">HOME</a></li>
        <li><a href="{{ route('characters.index') }}" class="nav-link">PERSONAJES</a></li>
        <li><a href="{{ route('creators.index') }}" class="nav-link">CREADORES</a></li>
        <li><a href="{{ route('comics.index') }}" class="nav-link">CÓMICS</a></li>
        <li><a href="{{ route('series.index') }}" class="nav-link">SERIES</a></li>
        <li><a href="{{ route('stories.index') }}" class="nav-link">HISTORIAS</a></li>
        @auth
            <li><a href="{{ route('favorites.index') }}" class="nav-link">MIS FAVORITOS</a></li>
        @endauth
    </ul>
    @auth
        <div class="hidden lg:flex items-center">
            <span class="text-lg text-white mr-4">¡Hola, {{ Auth::user()->name }}!</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="py-2 px-6 bg-gray-50 hover:bg-gray-100 text-sm text-gray-900 font-bold  rounded-xl transition duration-200">Cerrar Sesión</button>
            </form>
        </div>
    @endauth
    @guest
        <div class="hidden lg:flex">
            <a href="{{ route('login') }}" class="py-2 mr-2 px-6 bg-gray-50 hover:bg-gray-100 text-sm text-red-700 font-bold  rounded-xl transition duration-200">Login</a>
            <a href="{{ route('register') }}" class="py-2 px-6 bg-red-500 hover:bg-red-700 text-sm text-white font-bold rounded-xl transition duration-200">Registro</a>
        </div>
    @endguest
</nav>

<div class="  mt-4">
    @yield('content')
</div>

<footer class="bg-black text-white py-8 mt-5 ">
    <div class="container mx-auto my-4 md:w-2/2 "><!-- Div centrado con línea -->
        <hr class="border-white border-2">
    </div>
    <div class="container mx-auto flex flex-col md:flex-row items-center justify-between ">
        <div class="mb-4 md:mb-0 flex flex-col items-center ml-12">
            <a href="{{ route('marvel.home') }}" class="flex items-center">
                <img src="{{ asset('storage/Marvel_Logo.svg') }}" alt="Logo Marvel" class="h-12">
                <span class="text-3xl font-semibold mt-2">UNIVERSE</span>
            </a>
            <p class="text-sm text-center mt-2">Datos proporcionados por Marvel. © 2014 Marvel</p>
            <span class="text-sm text-white">Marvel Universe es el mejor lugar para descubrir el vasto universo de Marvel.</span>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-8">
            <div>
                <h2 class="text-sm font-semibold mb-4 uppercase">Menu</h2>
                <ul>
                    <li><a href="{{ route('marvel.home') }}" class="hover:text-red-500">HOME</a></li>
                    <li><a href="{{ route('characters.index') }}" class="hover:text-red-500">PERSONAJES</a></li>
                    <li><a href="{{ route('creators.index') }}" class="hover:text-red-500">CREADORES</a></li>
                    <li><a href="{{ route('comics.index') }}" class="hover:text-red-500">CÓMICS</a></li>
                    <li><a href="{{ route('series.index') }}" class="hover:text-red-500">SERIES</a></li>
                    <li><a href="{{ route('stories.index') }}" class="hover:text-red-500">HISTORIAS</a></li>
                </ul>
            </div>
            <div>
                <h2 class="text-sm font-semibold mb-4 uppercase">Legal</h2>
                <ul>
                    <li><a href="#" class="hover:text-red-500">Aviso Legal</a></li>
                    <li><a href="#" class="hover:text-red-500">Política de privacidad</a></li>
                    <li><a href="#" class="hover:text-red-500">Política de cookies</a></li>
                    <li><a href="#" class="hover:text-red-500">Términos y condiciones</a></li>
                </ul>
            </div>
        </div>
    </div>
    <hr class="my-6 border-white border-2">
    <div class="container mx-auto flex flex-col md:flex-row items-center justify-between">
        <span class="text-sm text-white">&copy; 2024 Marvel Universe by David Galindo 2ºDAW</span>
        <div class="flex mt-4 md:mt-0">
            <a href="#" class="text-gray-500 hover:text-red-500 mx-2"><i class="fab fa-facebook"></i></a>
            <a href="#" class="text-gray-500 hover:text-red-500 mx-2"><i class="fab fa-discord"></i></a>
            <a href="#" class="text-gray-500 hover:text-red-500 mx-2"><i class="fab fa-twitter"></i></a>
            <a href="#" class="text-gray-500 hover:text-red-500 mx-2"><i class="fab fa-github"></i></a>
            <a href="#" class="text-gray-500 hover:text-red-500 mx-2"><i class="fab fa-dribbble"></i></a>
        </div>
    </div>
</footer>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

@yield('scripts')
</body>
</html>

