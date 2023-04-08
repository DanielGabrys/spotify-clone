<div class="AudioList">

    <div>
        <form class="form-custom">
            <div class="form-custom-item">
                <div class="">
                    <input type="text" wire:model="title" class="form-input" id="FormTitle" placeholder="tytuł">
                </div>
                @error('title') <span class="text-red-500"> {{$message}} </span> @enderror
            </div>

            <div class="form-custom-item">
                <div class="">
                    <input type="text" wire:model="author" class="form-input" id="FormAuthor" placeholder="autor">
                </div>
                @error('author') <span class="text-red-500"> {{$message}} </span> @enderror
            </div>


            <div class="form-custom-item">
                <div class="form-custom-item-file">
                    <div class="form-custom-item-file-label"> zdjęcie </div>
                    <input type="file" wire:model="img" class="custom-input-file" id="FormAuthor" >
                </div>

                @error('img') <span class="text-red-500"> {{$message}} </span> @enderror

            </div>

            <div class="form-custom-item">
                <div class="form-custom-item-file">
                    <div class="form-custom-item-file-label"> utwór </div>
                    <input type="file" wire:model="songSrc" class="custom-input-file"  id="FormAuthor" >
                </div>

                @error('songSrc') <span class="text-red-500"> {{$message}} </span> @enderror

            </div>


            <a wire:click.prevent="addSongForm()" href="#">
                <button type="button" class="btn btn-primary" id="add-song-button">DODAJ </button>
            </a>




        </form>
    </div>

    <h2 class="title">The list
        <span>{{$Songs->count()}} songs</span>
    </h2>



    @foreach($Songs as $song)

        <div class="songs">
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
                        <span class="songSpan">{{$song->title}}</span>
                        <span class="songSpan">{{$song->author}}</span>
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
                        <i class=" bi bi-three-dots" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </i>
                        <ul class="dropdown-menu multi-level" >
                            <li class="dropdown-submenu">
                                <a wire:click.prevent="deleteSong({{$song->id}})" > Usuń </a>
                            </li>
                            <li class="dropdown-submenu">
                                <a >Dodaj do Playlisty</a>
                                <ul class="dropdown-menu">

                                    @foreach($Playlists as $playlist)
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

