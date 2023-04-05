<div class="header">
    <div class="menu_side">

        <h1>SPOTIFY BALLROOM <i class="bi bi-device-hdd-fill"></i> </h1>
        <div class="playlist">
            <h4 class="active"> <span></span> <i class="bi bi-music-note-list"></i> Utwórz playliste</h4>
            <a wire:click.prevent="songs()" >  <h4 class="active"> <span></span> <i class="bi bi-file-earmark-music-fill"></i> Piosenki </h4> </a>
            <a wire:click.prevent="tags()" >  <h4 class="active"> <span></span> <i class="bi bi-bookmark"></i> Tagi </h4> </a>
            <a wire:click.prevent="generateTagPlaylist()" >  <h4 class="active"> <span></span> <i class="bi bi-boxes"></i> Generuj tagowaną playlistę</h4> </a>


        </div>

        <h3 id="playlist-menu"> <i class="bi bi-music-note-list"></i> <span> Playlisty  </span> </h3>

        <div class="menu_song" >

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

        <h3 id="playlist-menu"> <i class="bi bi-music-note-list"></i> <span> Tagi  </span> </h3>

        <div class="menu_tag" >
            <span class="song_tag_item"> jive <i class="bi bi-x-square"></i> </span>
            <span class="song_tag_item"> wiedeński <i class="bi bi-x-square"></i> </span>
            <span class="song_tag_item"> angielski <i class="bi bi-x-square"></i> </span>
            <span class="song_tag_item"> pasadoble <i class="bi bi-x-square"></i> </span>
            <span class="song_tag_item"> foxtrot <i class="bi bi-x-square"></i> </span>
            <span class="song_tag_item"> quicstep <i class="bi bi-x-square"></i> </span>
            <span class="song_tag_item"> disco <i class="bi bi-x-square"></i> </span>

        </div>


    </div>

    <div class="song_side">
        @include($subView)
    </div>

    <script>

    </script>

</div>

