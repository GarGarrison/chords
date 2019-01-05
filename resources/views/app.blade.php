<!doctype html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CheckTheChords.ru</title>
        <link href="libs/materialize/css/materialize.min.css" rel="stylesheet" type="text/css">
        <link href="css/app.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="head">
                    <span class="title">CheckTheChords.ru</span>
                    <div class="auth">
                        <div class="button brown left">Вход</div>
                        <div class="button brown left">Регистрация</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="menu">
                    <div class="menu-item button grey">Аккорды</div>
                    <div class="menu-item button grey">Исполнители</div>
                </div>
            </div>
            <div class="row">
                <div class="letters">
                    <a href="/letters/A">A</a>
                    <a href="/letters/B">B</a>
                    <a href="/letters/C">C</a>
                    <a href="/letters/D">D</a>
                    <a href="/letters/E">E</a>
                    <a href="/letters/F">F</a>
                    <a href="/letters/G">G</a>
                    <a href="/letters/H">H</a>
                    <a href="/letters/I">I</a>
                    <a href="/letters/J">J</a>
                    <a href="/letters/K">K</a>
                    <a href="/letters/L">L</a>
                    <a href="/letters/M">M</a>
                    <a href="/letters/N">N</a>
                    <a href="/letters/O">O</a>
                    <a href="/letters/P">P</a>
                    <a href="/letters/Q">Q</a>
                    <a href="/letters/R">R</a>
                    <a href="/letters/S">S</a>
                    <a href="/letters/T">T</a>
                    <a href="/letters/U">U</a>
                    <a href="/letters/V">V</a>
                    <a href="/letters/W">W</a>
                    <a href="/letters/X">X</a>
                    <a href="/letters/Y">Y</a>
                    <a href="/letters/Z">Z</a>
                </div>
            </div>
            <div class="row">
                <div class="search">
                    <input class="browser-default" type="text" name="search" placeholder="Поиск">
                </div>
            </div>
            <div class="row">
                <div class="content">
                    @yield('content')
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
