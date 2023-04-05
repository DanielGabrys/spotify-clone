<div class="header">
    <div class="menu_side">

        <h1>Playlist</h1>
        <div class="playlist">
            <h4 class="active"> <span></span> <i class="bi bi-music-note-list"></i> Utwórz playliste</h4>
            <a wire:click.prevent="songs()" >  <h4 class="active"> <span></span> <i class="bi bi-file-earmark-music-fill"></i> Piosenki </h4> </a>
            <a wire:click.prevent="tags()" >  <h4 class="active"> <span></span> <i class="bi bi-bookmark"></i> Tagi </h4> </a>
            <a wire:click.prevent="generateTagPlaylist()" >  <h4 class="active"> <span></span> <i class="bi bi-boxes"></i> Generuj tagowaną playlistę</h4> </a>


        </div>

        <div class="menu_song">


            <h4 class="active"> <span></span> <i class="bi bi-music-note-list"></i> Playlisty </h4>
            @foreach($playlists as $playlist)

                <a wire:click.prevent="playlist({{$playlist->id}})" >
                    <li class="songItem" id="song_{{$loop->index}}">
                        <span> {{$loop->iteration}} </span>

                            <img src="{{$playlist->image ?? asset('storage/images/toFill/emptyPlaylist.png')}}" alt="">

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

