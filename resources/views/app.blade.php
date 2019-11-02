<!doctype html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @section('meta')
        <title>CheckTheChords.ru - тексты песен и аккорды для гитары</title>
        <meta name="Keywords" content="аккорды тексты песен подборы для гитары укулеле"/>
        <meta name="Description" content="Тексты песен, аккорды для гитары"/>
        @show
        <link href="/libs/materialize/css/materialize.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="/css/app.css" rel="stylesheet" type="text/css">
        @include('vendor.vendorjs')
    </head>
    <body>
        <div class="container">
            <div class="row head">
                <div class="col m12 l4">
                    <a href="/" class="title">CheckTheChords.ru</a>
                </div>
                <!-- <div class="col s12 l6 auth">
                    <div class="button brown left">Вход</div>
                    <div class="button brown left">Регистрация</div>
                </div> -->
                {{-- <div class="col s12 m6 menu">
                    <div class="menu-item button grey">Исполнители</div>
                    <div class="menu-item button grey">Аккорды</div>
                </div> --}}
            {{-- </div> --}}
                <div class="col m12 l8">
                    <div class="letters">
                        <a href="/letter/A">A</a>
                        <a href="/letter/B">B</a>
                        <a href="/letter/C">C</a>
                        <a href="/letter/D">D</a>
                        <a href="/letter/E">E</a>
                        <a href="/letter/F">F</a>
                        <a href="/letter/G">G</a>
                        <a href="/letter/H">H</a>
                        <a href="/letter/I">I</a>
                        <a href="/letter/J">J</a>
                        <a href="/letter/K">K</a>
                        <a href="/letter/L">L</a>
                        <a href="/letter/M">M</a>
                        <a href="/letter/N">N</a>
                        <a href="/letter/O">O</a>
                        <a href="/letter/P">P</a>
                        <a href="/letter/Q">Q</a>
                        <a href="/letter/R">R</a>
                        <a href="/letter/S">S</a>
                        <a href="/letter/T">T</a>
                        <a href="/letter/U">U</a>
                        <a href="/letter/V">V</a>
                        <a href="/letter/W">W</a>
                        <a href="/letter/X">X</a>
                        <a href="/letter/Y">Y</a>
                        <a href="/letter/Z">Z</a>
                        <a href="/letter/0-9">0-9</a>
                    </div>
                    <div class="letters">
                        <a href="/letter/А">А</a>
                        <a href="/letter/Б">Б</a>
                        <a href="/letter/В">В</a>
                        <a href="/letter/Г">Г</a>
                        <a href="/letter/Д">Д</a>
                        <a href="/letter/Е">Е</a>
                        <a href="/letter/Ё">Ё</a>
                        <a href="/letter/Ж">Ж</a>
                        <a href="/letter/З">З</a>
                        <a href="/letter/И">И</a>
                        <a href="/letter/Й">Й</a>
                        <a href="/letter/К">К</a>
                        <a href="/letter/Л">Л</a>
                        <a href="/letter/М">М</a>
                        <a href="/letter/Н">Н</a>
                        <a href="/letter/О">О</a>
                        <a href="/letter/П">П</a>
                        <a href="/letter/Р">Р</a>
                        <a href="/letter/С">С</a>
                        <a href="/letter/Т">Т</a>
                        <a href="/letter/У">У</a>
                        <a href="/letter/Ф">Ф</a>
                        <a href="/letter/Х">Х</a>
                        <a href="/letter/Ц">Ц</a>
                        <a href="/letter/Ч">Ч</a>
                        <a href="/letter/Ш">Ш</a>
                        <a href="/letter/Щ">Щ</a>
                        <a href="/letter/Ъ">Ъ</a>
                        <a href="/letter/Ы">Ы</a>
                        <a href="/letter/Ь">Ь</a>
                        <a href="/letter/Э">Э</a>
                        <a href="/letter/Ю">Ю</a>
                        <a href="/letter/Я">Я</a>
                        <a href="/letter/0-9">0-9</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <form class="search" action="/search">
                    <input class="browser-default" type="text" name="search" placeholder="Поиск">
                </form>
            </div>
            <div class="row">
                <div class="content">
                    @yield('content')
                    <div class="footer"><div class="grey-text text-lighten-1" align="center">© 2017–<?php echo date('Y')?>&nbsp; CheckTheChords.ru</div></div>
                </div>
            </div>
            <!-- <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div> -->
        </div>
    </body>
</html>
