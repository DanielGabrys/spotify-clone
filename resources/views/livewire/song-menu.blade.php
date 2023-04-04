<div class="AudioList">


    <h2 class="title">The list
        <span>{{$allSongs->count()}} songs</span>
    </h2>




    @foreach($allSongs as $song)

        <div class="songs">
            <div class="count">
                <p>{{$loop->iteration}}</p>
            </div>

            <div class="song">
                <audio id ="audio_{{$loop->index}}" ></audio>


                <div x-data @click="PlaySong(@js($loop->index))" class="section">

                    <div class="imgBox">
                        <img src="{{$song->image}}" alt="">
                    </div>

                    <p class="songName" >
                        <span class="songSpan" id="title">{{$song->title}}</span>
                        <span class="songSpan" id="author">{{$song->author}}</span>
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
                               <a wire:click.prevent="deleteSong({{$song->id}})" href="#"> Usuń </a>
                           </li>
                           <li class="dropdown-submenu">
                               <a href="#">Dodaj do Playlisty</a>
                               <ul class="dropdown-menu">

                                   @foreach($playlists as $playlist)
                                       <li><a wire:click.prevent="addSongToPlaylist({{$song->id}},{{$playlist->id}})" href="#">{{$playlist->name}}</a></li>
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

