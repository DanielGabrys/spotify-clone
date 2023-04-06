<div class="AudioList">
    <h2 class="title">The list
        <span> {{$songs->count()}} songs</span>

    </h2>

    <div wire:sortable="updateSongsOrder" class="songsContainer">


        @foreach($songs as $song)


            <div class="songs">
                <div class="count">
                    <p>{{$loop->iteration}}</p>
                </div>

                <div class="song">
                    <audio id ="audio_{{$loop->index}}" ></audio>


                    <div x-data @click="PlaySong(@js($songs_json),@js($loop->index))" class="section">

                        <div
                            class="imgBox">
                            <img src="{{$song->image}}" alt="">
                        </div>

                        <p class="songName" >
                            <span class="songSpan" >{{$song->title}}</span>
                            <span class="songSpan" >{{$song->author}}</span>
                            <span class="songSpan"><i class="bi bi-clock-history" ></i>  {{$this->calculateTime($song->duration)}} </span>
                            <span class="songSpan">
                           <span class="song_tag_item"> jive <i class="bi bi-x-square"></i> </span>
                           <span class="song_tag_item"> jivesd <i class="bi bi-x-square"></i> </span>

                        </span>


                        </p>
                    </div>

                    <div class="section">

                        <p class="songName">
                            <i class="bi bi-suit-heart"> </i>
                        <div class="dropdown">
                            <i class=" bi bi-three-dots " id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </i>
                            <ul class="dropdown-menu multi-level" aria-labelledby="dLabel">
                                <li class="dropdown-submenu">
                                    <a wire:click.prevent="removeSongFromPlaylist({{$song->id}},{{$loop->iteration}})" > Usuń z Playlisty </a>
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
                        </p>

                    </div>


                </div>

            </div>


        @endforeach

    </div>

</div>
