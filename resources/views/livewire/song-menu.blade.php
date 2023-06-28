<div class="AudioList">


    <form class="form-custom">


        <div class="form-custom-item">
            <div class="">
                <input type="text" wire:model="search" class="form-input" id="search" placeholder="Szukaj" style="width: 300px">
            </div>
            @error('search') <span class="text-red-500"> {{$message}} </span> @enderror
        </div>

        <a wire:click.prevent="setSearchParameters()" href="#">
            <div class="form-custom-item" >
                    <i class="bi bi-search"></i>
            </div>
        </a>



        <div class="form-check form-check-inline">

            <input wire:model="search_type_track" type="checkbox" class="btn-check" name="options" id="option2" autocomplete="off">
            <label class="btn btn-primary" for="option2">UTWÓR</label>

            <input wire:model="search_type_author" type="checkbox" class="btn-check" name="options" id="option3" autocomplete="off">
            <label class="btn btn-primary" for="option3">AUDIO</label>
        </div>



    </form>


    <div class="songsContainer_SongMenu">

    @foreach($songs as $song)

        <div class="songs">
            <div class="count">
                <p>{{$loop->iteration + $songs->firstItem() - 1}}</p>
            </div>

            <div class="song">
                <audio id ="audio_{{$loop->iteration + $songs->firstItem() - 2}}" ></audio>


                <div x-data @click="PlaySong(@js($songs_json),@js($loop->iteration + $songs->firstItem() - 2))" class="section">

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
                         x-data @dragover="onDragOver(event)" @drop="onDrop(event)"
                    >Upuść Tag </div>

                    <div class="TagTools">


                             @foreach($song->songsTags as $tag )



                                 <span class="song_tag_item"> {{$tag->name }}
                                          <i wire:click.prevent="deleteTagFromSong({{$song->id}},{{$tag->id }})" class="bi bi-x-square"></i>
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
                                    <a wire:click.prevent="deleteSong({{$song->id}})" > Usuń </a>
                                </li>
                                <li class="dropdown-submenu">
                                    <a >Dodaj do Playlisty</a>
                                    <ul class="dropdown-menu">


                                        @foreach($playlists as $playlist)
                                            <li>
                                                <a wire:click.prevent="addSongToPlaylist({{$song->id}},{{$playlist->id}})" >{{$playlist->name}}</a>
                                            </li>
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

    {{$songs->links()}}

</div>

