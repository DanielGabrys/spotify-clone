<div class="header">
    <div class="menu_side">

        <a href="{{$user['spotify_profile']}}" target="blank" >
            <div class="user_info">

                <i class="bi bi-spotify"></i>
                <span>{{$user['name']}}</span>
                <img class="user_img" src="{{$user['image']}} " >

            </div>
        </a>
        <h1>SPOTIFY BALLROOM <i class="bi bi-device-hdd-fill"></i> </h1>



        <div class="playlist">
            <a wire:click.prevent="addPlaylist()" > <h4 class="active"> <span></span> <i class="bi bi-music-note-list"></i> Utwórz playliste</h4> </a>
            <a wire:click.prevent="SongsMenu()" >  <h4 class="active"> <span></span> <i class="bi bi-file-earmark-music-fill"></i> Piosenki </h4> </a>
            <a wire:click.prevent="generateTagPlaylist()" >  <h4 class="active"> <span></span> <i class="bi bi-boxes"></i> Generuj tagowaną playlistę</h4> </a>

        </div>

        @livewire('spotify-playlist-migrate', ['user' => $user])



        <div class="menu_song" >

            @foreach($playlists as $playlist)

                    <li class="songItem" id="song_{{$loop->index}}">

                        <a wire:click.prevent="playlist({{$playlist->id}})" >
                            <div class="song_item_info">

                                <span> {{$loop->iteration}} </span>

                                <img src="{{$playlist->image ?? asset('storage/images/toFill/emptyPlaylist.png')}}" alt="">

                                <div class="song_info">
                                    <div class="song_title">{{$playlist->name}}</div>
                                    <div class="subtitle">{{$playlist->description}}</div>
                                </div>

                            </div>
                        </a>

                            <div class="song_url">

                                <a id="{{$playlist->spotify_playlist_url}}" href="{{$playlist->spotify_playlist_url}}" target="blank">  <span> <i class="bi bi-spotify"></i> </span> </a>
                                <i data-bs-toggle="modal" data-bs-target="#PlaylistModal_{{$playlist->id}}" class="bi bi-trash-fill"></i>

                            </div>


                    </li>


                <div class="modal fade" id="PlaylistModal_{{$playlist->id}}" tabindex="-1" aria-labelledby="PlaylistModalLabel_{{$playlist->id}}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="PlaylistModalLabel_{{$playlist->id}}" style="color: black;">Usunąć playliste "{{$playlist->id}}" ?</h1>
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

        @livewire('tags',['user'=>$user])


    </div>


    <div class="song_side">

        @include($subView)

    </div>

</div>



