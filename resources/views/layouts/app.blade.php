<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    @stack('styles')
    <title>getCode - @yield('titulo')</title>
    @vite('resources/js/app.js')
    @livewireStyles

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

        .descripcion-scroll {
            max-height: 200px;
            overflow-y: auto;
            white-space: pre-wrap;
        }

        .descripcion-popup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .descripcion-popup .contenido {
            max-width: 80%;
            max-height: 80%;
            overflow-y: auto;
            background-color: white;
            padding: 20px;
        }

        .descripcion-popup .volver {
            text-align: right;
        }

        .overflow-auto {
            overflow: auto;
            max-height: 200px;
        }

        .navigation {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 70px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        .navigation ul {
            display: flex;
            width: 350px;
        }

        .navigation ul li {
            position: relative;
            list-style: none;
            width: 70px;
            height: 70px;
            z-index: 1;
        }

        .navigation ul li a {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            width: 100%;
            text-align: center;
            font-weight: 500;
        }

        .navigation ul li a .icon {
            position: relative;
            display: block;
            line-height: 75px;
            font-size: 1.5rem;
            text-align: center;
            transition: 0.5s;
            color: var(--clr);
        }

        .navigation ul li.active a .icon {
            transform: translateY(-32px);
        }

        .navigation ul li a .text {
            position: absolute;
            color: var(--clr);
            font-weight: 400;
            font-size: 0.75em;
            letter-spacing: 0.05em;
            transition: opacity 0.5s;
            opacity: 0;
            transform: translateY(10px);
        }

        .navigation ul li.active a .text {
            opacity: 1;
        }

        .indicator {
            position: absolute;
            top: -50%;
            width: 70px;
            height: 70px;
            background: #e28000;
            border-radius: 50%;
            border: 6px solid white;
            transition: 0.5s;
        }

        .indicator::before {
            content: '';
            position: absolute;
            top: 50%;
            left: -22px;
            width: 20px;
            height: 20px;
            background: transparent;
            border-top-right-radius: 20px;
            box-shadow: 1px -10px 0 0 var(--clr);
        }

        .indicator::after {
            content: '';
            position: absolute;
            top: 50%;
            right: -22px;
            width: 20px;
            height: 20px;
            background: transparent;
            border-top-left-radius: 20px;
            box-shadow: -1px -10px 0 0 var(--clr);
        }

        .navigation ul li:nth-child(1).active~.indicator {
            transform: translateX(calc(70px * 0));
        }

        .navigation ul li:nth-child(2).active~.indicator {
            transform: translateX(calc(70px * 1));
        }

        .navigation ul li:nth-child(3).active~.indicator {
            transform: translateX(calc(70px * 2));
        }

        .navigation ul li:nth-child(4).active~.indicator {
            transform: translateX(calc(70px * 3));
        }

        .navigation ul li:nth-child(5).active~.indicator {
            transform: translateX(calc(70px * 4));
        }

        @media screen and (min-width: 770px) {
            .navigation {
                display: none;
            }
        }

        .centradoPerfil{
            display: flex;
            align-items: center;
            margin-top: 10px;
        }
    </style>


</head>

<body class="bg-gray-100">
    <header class="p-5 border-b bg-white shadow">
        <div class="container mx-auto flex flex-wrap justify-between items-center">
            <a href="{{ route('home') }}" class="text-3xl font-black">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class=" h-10 w-30 md:h-20 md:w-40">
            </a>



            @auth
                <nav class="flex gap-2 items-center flex-wrap">
                    <a class="font-bold uppercase text-gray-600 text-lg md:block hidden"
                        href="{{ route('posts.friends') }}">Amigos</a>

                    <a class="items-center gap-2 bg-white border p-2 md:block hidden hover:bg-gray-200 text-gray-600 rounded text-lg uppercase font-bold cursor-pointer"
                        href="{{ route('posts.create') }}">


                        Crear
                    </a>
                    @php
                        $user = auth()->user();
                        $profileImage = $user->imagen ? asset('perfiles') . '/' . $user->imagen : asset('img/usuario.svg');
                    @endphp

                    <a class="font-bold text-gray-600 text-lg" href="{{ route('posts.index', auth()->user()->username) }}">

                        <span class="font-normal">
                            {{ auth()->user()->username }}
                        </span>
                    </a>
                    <img src="{{ $profileImage }}" alt="Imagen de perfil" class="h-8 w-8 rounded-full">

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="font-bold uppercase text-grey-600  text-lg">
                            Log out
                        </button>
                    </form>
                </nav>
            @endauth

            @guest
                <nav class="flex gap-2 items-center">
                    <a class="font-bold uppercase text-gray-600 text-lg" href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}" class="font-bold uppercase text-gray-600 text-lg">
                        Crear Cuenta
                    </a>
                </nav>
            @endguest



        </div>
    </header>

    <main class="container mx-auto mt-10 mb-20">
        <h2 class="font-black text-center  text-3xl mb-10">
            <form id="search-form" class="text-2xl mb-8">
                <input class=" w-80 border-2 p-3 ml-2" type="text" id="search-input" placeholder="search user">
                <button class=" mr-2 border-2 p-3 hover:bg-gray-200" type="submit"><ion-icon name="search-outline"></ion-icon></button>
            </form>
            @yield('titulo')
        </h2>

        @yield('contenido')
    </main>
    <div class="navigation">
        <ul>
            <li class="list{{ Request::is('/') ? ' active' : '' }}">
                <a href="{{ route('home') }}">
                    <span class="icon">
                        <ion-icon name="home-outline"></ion-icon>
                    </span>
                    <span class="text">Home</span>
                </a>
            </li>

            @php
                $profileRoute = auth()->check() ? route('posts.index', auth()->user()->username) : null;
                $createPostRoute = route('posts.create');
            @endphp



            <li class="list{{ Request::is('friends') ? ' active' : '' }}">
                <a href="{{ route('friends') }}">
                    <span class="icon">
                        <ion-icon name="people-outline"></ion-icon>
                    </span>
                    <span class="text">Friends</span>
                </a>
            </li>
            <li class="list{{ Request::url() === $createPostRoute ? ' active' : '' }}">
                <a href="{{ $createPostRoute }}">
                    <span class="icon">
                        <ion-icon name="add-outline"></ion-icon>
                    </span>
                    <span class="text">Post</span>
                </a>
            </li>

            <li class="list{{ Request::url() === $profileRoute || Request::is('login') ? ' active' : '' }}">
                @auth

                    <a href="{{ route('posts.index', auth()->user()->username) }}">
                        <span class="icon">
                            <ion-icon name="person-outline"></ion-icon>
                        </span>
                        <span class="text">Profile</span>
                    </a>
                @else
                    <a href="{{ route('login') }}">
                        <span class="icon">
                            <ion-icon name="person-outline"></ion-icon>
                        </span>
                        <span class="text">Login</span>
                    </a>
                @endauth
            </li>
            <li class="list{{ Request::is('search') ? ' active' : '' }}">
                <a href="#">
                    <span class="icon">
                        <ion-icon name="settings-outline"></ion-icon>
                    </span>
                    <span class="text">Settings</span>
                </a>
            </li>
            <div class="indicator"></div>
        </ul>
    </div>

    <!-- partial -->
    <script src='https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js'></script>
    <script src='https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js'></script>
    <script src="./script.js"></script>


    @livewireScripts
</body>

<script>
    const form = document.getElementById('search-form');
    const input = document.getElementById('search-input');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const username = input.value.trim();
        if (username !== '') {
            window.location.href = '/' + username;
        }
    });


    const list = document.querySelectorAll('.list');

    function activeLink() {
        list.forEach((item) =>
            item.classList.remove('active'));
        this.classList.add('active');
    }
    list.forEach((item) =>
        item.addEventListener('click', activeLink));

    /**/

    window.addEventListener('DOMContentLoaded', function() {
        const contentContainer = document.getElementById('content-container');
        const navigation = document.querySelector('.navigation');

        function adjustContentHeight() {
            const windowHeight = window.innerHeight;
            const navigationHeight = navigation.offsetHeight;
            const contentContainerHeight = windowHeight - navigationHeight;

            contentContainer.style.minHeight = contentContainerHeight + 'px';
        }

        adjustContentHeight();

        window.addEventListener('resize', adjustContentHeight);
    });
</script>



</html>
