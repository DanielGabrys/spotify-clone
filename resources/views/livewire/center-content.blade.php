<div class="header">
    <div class="menu_side">

        <h1>Playlist</h1>
        <div class="playlist">
            <h4 class="active"> <span></span> <i class="bi bi-music-note-beamed"></i> Utwórz playliste</h4>
            <a wire:click.prevent="songs()" href="#">  <h4 class="active"> <span></span> <i class="bi bi-music-note-beamed"></i> Piosenki </h4> </a>
            <a wire:click.prevent="addSong()" href="#">  <h4 class="active"> <span></span> <i class="bi bi-music-note-beamed"></i> Dodaj utwór</h4> </a>
            <a wire:click.prevent="tags()" href="#">  <h4 class="active"> <span></span> <i class="bi bi-music-note-beamed"></i> Tagi </h4> </a>
            <a wire:click.prevent="generateTagPlaylist()" href="#">  <h4 class="active"> <span></span> <i class="bi bi-music-note-beamed"></i> Generuj tagowaną playlistę</h4> </a>


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

    <script>

    </script>

</div>

