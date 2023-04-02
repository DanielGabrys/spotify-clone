<div class="header">

    <div class="menu_side">

        <h1>Playlist</h1>
        <div class="playlist">
            <h4 class="active"> <span></span> <i class="bi bi-music-note-beamed"></i> Utwórz playliste</h4>
            <a wire:click.prevent="test()" href="#">  <h4 class="active"> <span></span> <i class="bi bi-music-note-beamed"></i> Dodaj piosenki</h4> </a>
        </div>

        <div class="menu_song">

            <h4 id="totalTime">  <i class="bi bi-hourglass"></i>   </h4>
            @foreach($songs as $song)
                <li class="songItem" id="song_{{$loop->index}}">
                    <span> {{$loop->iteration}} </span>
                    <img src="{{$song->image}}" alt="">
                    <div class="song_info">
                        <div class="song_title">{{$song->title}}</div>
                        <div class="subtitle">{{$song->author}}</div>
                    </div>
                    <h6 id="song_time_{{$loop->index}}"> 0:00 </h6>
                    <audio id ="audio_{{$loop->index}}" ></audio>
                    <input type="hidden" id="song__{{$song->id}}" value="{{$song->id}}">

                </li>

            @endforeach
        </div>

    </div>


    <div class="song_side">
       {{$subView}}
    </div>


    <div class="master_play">
        <div class="wave" id="wave">
            <div class="wave1"> </div>
            <div class="wave1"> </div>
            <div class="wave1"> </div>
        </div>

        <audio id="playerAudio" src=""> </audio>

        <img src="" alt="" id="playerImg">
        <div class="song_info">
            <div id="playerTitle" class="song_title"></div>
            <div id="playerSubtitle" class="subtitle"></div>
        </div>

        <div class="icon">
            <i id="playPrev" class="bi bi-skip-start-fill"> </i>
            <i id="playMusic" class="bi bi-play-fill"></i>
            <i id="playNext" class="bi bi-skip-end-fill"></i>
        </div>
        <span id="current-time"> 0:00 </span>

        <div class="bar">
            <input type="range" id="seek-slider" min="0"; max="100"; value="0">
        </div>

        <span id="duration"> </span>

        <div class="vol">
            <i class="bi bi-volume-down-fill" id="vol-icon"></i>
            <input type="range" id="vol-slider" min="0"; max="100"; value="50">
        </div>

        <span id="volume"> 50 </span>


        <div class="vol">
            <i class="bi bi-speedometer"></i>
            <input type="range" id="speed-slider" min="-10"; max="10"; value="0">
        </div>

        <span id="speed"> 1.0 </span>


    </div>

</div>
