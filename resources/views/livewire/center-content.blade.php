<div class="header">
    <div class="menu_side">

        <h1>Playlist</h1>
        <div class="playlist">
            <h4 class="active"> <span></span> <i class="bi bi-music-note-beamed"></i> Utwórz playliste</h4>
            <a wire:click.prevent="view()" href="#">  <h4 class="active"> <span></span> <i class="bi bi-music-note-beamed"></i> Dodaj piosenki</h4> </a>
        </div>

        <div class="menu_song">

            <h4 class="active"> <span></span> <i class="bi bi-music-note-beamed"></i> Playlisty </h4>
            @foreach($playlists as $playlist)

                <a wire:click.prevent="playlist({{$playlist->id}})" href="#">
                    <li class="songItem" id="song_{{$loop->index}}">
                        <span> {{$loop->iteration}} </span>
                        <img src="{{$playlist->image ?? null}}" alt="">
                        <div class="song_info">
                            <div class="song_title">{{$playlist->name}}</div>
                            <div class="subtitle">{{$playlist->description}}</div>
                        </div>
                    </li>
                </a>

            @endforeach
        </div>

    </div>

    <div class="song_side">
        @include($subView)
    </div>
</div>

