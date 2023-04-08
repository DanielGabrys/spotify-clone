<div class="AudioList">
    <h2 class="title">The list

        <span> {{$songs->count()}} songs</span>


    </h2>

    <div wire:sortable="updateSongsOrder" class="songsContainer">

        @foreach($songs as $song)

            <div wire:sortable.item="{{ $song->pivot->id }}" wire:key="task-{{ $song->pivot->id }}" class="songs">
                <div class="count">
                    <p>{{$loop->iteration}}</p>
                </div>

                <div wire:sortable.handle class="song">
                    <audio id ="audio_{{$loop->index}}" ></audio>


                    <div class="section">

                        <div
                            class="imgBox">
                            <img src="{{$song->image}}" alt="">
                        </div>

                        <p class="songName" >
                            <span class="songSpan" >{{$song->title}}</span>
                            <span class="songSpan" >{{$song->author}}</span>
                            <span class="songSpan"><i class="bi bi-clock-history" ></i>  {{$this->calculateTime($song->duration)}} </span>
                            <span class="songSpan">

                                 @foreach($this->getSongTags($song->id) as $tag)
                                    <span class="song_tag_item"> {{$tag->name}}  <i class="bi bi-x-square"></i> </span>
                                @endforeach
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
                                    <a> Usuń z Playlisty </a>
                                </li>
                                <li class="dropdown-submenu">
                                    <a >Dodaj do Playlisty</a>
                                    <ul class="dropdown-menu">

                                        @foreach($playlists as $playlist)
                                            <li><a>{{$playlist->name}}</a></li>
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
