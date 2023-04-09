<div class="header">
    <div class="menu_side">

        <h1>SPOTIFY BALLROOM <i class="bi bi-device-hdd-fill"></i> </h1>
        <div class="playlist">
            <a wire:click.prevent="addPlaylist" > <h4 class="active"> <span></span> <i class="bi bi-music-note-list"></i> Utwórz playliste</h4> </a>
            <a wire:click.prevent="SongsMenu()" >  <h4 class="active"> <span></span> <i class="bi bi-file-earmark-music-fill"></i> Piosenki </h4> </a>
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

                        <i data-bs-toggle="modal" data-bs-target="#PlaylistModal_{{$playlist->id}}" class="bi bi-trash-fill"></i>
                    </li>
                </a>

                <div class="modal fade" id="PlaylistModal_{{$playlist->id}}" tabindex="-1" aria-labelledby="PlaylistModalLabel_{{$playlist->id}}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="PlaylistModalLabel_{{$playlist->id}}" style="color: black;">Usunąć playliste "{{$playlist->name}}" ?</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="background: #0b5ed7;">
                                Playlista wraz z utworami zostanie zostanie całkowiecie usunięta
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">NIE</button>
                                <a wire:click.prevent="deletePlaylist({{$playlist->id}})"> <button type="button"  class="btn btn-primary" data-bs-dismiss="modal">TAK</button> </a>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>

        <h3 id="playlist-menu"> <i class="bi bi-music-note-list"></i> <span> Tagi  </span> </h3>

        @livewire('tags')


    </div>


    <div class="song_side">

        @include($subView)

    </div>

</div>



