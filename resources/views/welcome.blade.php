<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>


        <link href="{{asset('css/App.css')}}" rel="stylesheet" />




    </head>
    <body>

    <header>
        <div class="menu_side">

            <h1>Playlist</h1>
            <div class="playlist">
                <h4 class="active"> <span></span> <i class="bi bi-music-note-beamed"></i> Playlist</h4>
                <h4> <span></span> <i class="bi bi-music-note-beamed"></i> dsdsdsds </h4>
                <h4> <span></span> <i class="bi bi-music-note-beamed"></i> sdsdsdsd </h4>

            </div>

            <div class="menu_song">
                <li class="songItem">
                    <span> 01 </span>
                    <img src="" alt="">
                    <div class="song_info">
                        <div class="song_title">sasasas</div>
                        <div class="subtitle">sasasas</div>
                    </div>
                    <i class="bi playlistPlay bi-play-circle-fill" id="1"></i>
                </li>
            </div>

        </div>


        <div class="song_side"></div>
        <div class="master_play"></div>
        </header>
    </body>
</html>
