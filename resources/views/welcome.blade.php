<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>


        <link href="{{asset('css/App.css')}}" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">




    </head>
    <body>

    <header>
        <div class="menu_side">

            <h1>Playlist</h1>
            <div class="playlist">
                <h4 class="active"> <span></span> <i class="bi bi-music-note-beamed"></i> Playlist</h4>
                <h4> <span></span> <i class="bi bi bi-music-note-beamed"></i> dsdsdsds </h4>
                <h4> <span></span> <i class="bi bi-music-note-beamed"></i> sdsdsdsd </h4>

            </div>

            <div class="menu_song">

                @foreach($songs as $song)
                <li class="songItem">
                    <span> {{$loop->iteration}} </span>
                    <img src="{{$song->image}}" alt="">
                    <div class="song_info">
                        <div class="song_title">{{$song->title}}</div>
                        <div class="subtitle">{{$song->author}}</div>
                    </div>
                    <i class="bi playlistPlay bi-play-circle-fill" id="1"></i>
                    <input type="hidden" id="song_{{$song->id}}">

                </li>

                @endforeach
            </div>

        </div>


        <div class="song_side"></div>


        <div class="master_play">
            <div class="wave">
                <div class="wave1"> </div>
                <div class="wave1"> </div>
                <div class="wave1"> </div>
            </div>

            <audio id="playerAudio" src=""> </audio>

            <img src="" alt="" id="playerImg">
            <div class="song_info">
                <div id="playerTitle" class="song_title">ssss</div>
                <div id="playerSubtitle" class="subtitle">ssss</div>
            </div>

            <div class="icon">
                <i class="bi bi-skip-start-fill"> </i>
                <i id="playMusic" class="bi bi-play-fill"></i>
                <i class="bi bi-skip-end-fill"></i>
            </div>
            <span id="current-time"> 0:00 </span>

            <div class="bar">
                <input type="range" id="seek-slider" min="0"; max="100"; value="0">
            </div>

            <span id="duration"> 0:00 </span>

            <div class="vol">
                <i class="bi bi-volume-down-fill" id="vol_icon"></i>
                <input type="range" id="vol-slider" min="0"; max="100"; value="0">
            </div>


        </div>
        </header>
    </body>
</html>


<script>

    let SongList = {!! $songs_json !!}
    console.log(SongList)

    setInitialSong()

    function setInitialSong()
    {
        let title = SongList[0].title;
        let author = SongList[0].author;
        let img = SongList[0].image;
        let src = SongList[0].src;

        document.getElementById('playerTitle').innerText=title
        document.getElementById('playerSubtitle').innerText=author
        console.log(document.getElementById('playerImg').src)
        document.getElementById('playerImg').src = img
        document.getElementById('playerAudio').src = src
    }


</script>
