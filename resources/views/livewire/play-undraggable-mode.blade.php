<div class="AudioList">
    <h2 class="title">The list
        <span> {{$songs->count()}} songs</span>

    </h2>

    <div wire:sortable="updateSongsOrder" class="songsContainer">


        @foreach($songs as $song)

            <div class="songs" id="Playlist_song_{{$loop->index}}" >
                <div class="count">
                    <p>{{$loop->iteration}}</p>
                </div>

                <div class="song">
                    <audio id ="audio_{{$loop->index}}" ></audio>


                    <div x-data @click="PlaySong(@js($songs_json),@js($loop->index))" class="section">

                        <div class="imgBox">
                            <img src="{{$song->image}}" alt="">
                        </div>

                        <p class="songName">
                            <span class="titleSpan">{{$song->title}}</span>
                            <span class="authorSpan">{{$song->author}}</span>
                            <span class="durationSpan"><i class="bi bi-clock-history" style="width: 80px;" ></i>  {{$this->calculateTime($song->duration)}} </span>
                        </p>
                    </div>

                    <div class="section">

                        <div id="{{$song->id}}"
                             class="dropzone"
                        >Tagi </div>

                        <div class="TagTools">

                            @foreach($tags[$song->id] as $tag)

                                <span class="song_tag_item"> {{$tag->name ?? $tag['name']}}

                                      </span>
                            @endforeach

                        </div>

                        <div class="songTools">
                            <i class="bi bi-suit-heart"> </i>

                            <div class="dropdown">
                                <i class="bi bi-three-dots" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                </i>
                                <ul class="dropdown-menu multi-level" >
                                    <li class="dropdown-submenu">
                                        <a wire:click.prevent="removeSongFromPlaylist({{$song->id}},{{$loop->iteration}})" > Usuń </a>
                                    </li>
                                    <li class="dropdown-submenu">
                                        <a >Dodaj do Playlisty</a>
                                        <ul class="dropdown-menu">

                                            @foreach($playlists as $playlist)
                                                <li><a wire:click.prevent="addSongToPlaylist({{$song->id}},{{$playlist->id}})" >{{$playlist->name}}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </div>

                        </div>

                    </div>




                </div>

            </div>
        @endforeach


    </div>

</div>
