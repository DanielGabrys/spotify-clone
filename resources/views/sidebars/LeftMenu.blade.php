<div class="menu_side">

        <h1>Playlist</h1>
        <div class="playlist">
            <h4 class="active"> <span></span> <i class="bi bi-music-note-beamed"></i> Playlist</h4>
            <h4> <span></span> <i class="bi bi bi-music-note-beamed"></i> dsdsdsds </h4>

            <h4 id="totalTime" class="active">  <i class="bi bi-hourglass"></i>   </h4>

        </div>

        <div class="menu_song">

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

