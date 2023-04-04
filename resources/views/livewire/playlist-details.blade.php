<div class="mainContainer">


    <div class="Banner"><img src="http://127.0.0.1:8001/storage/images/songs/image1.png" alt="" class="bannerImg">
        <div class="content">
            <div class="breadCrump">
                <i class="bi bi-three-dots"></i>
            </div>

            <div class="artist">
                <div class="left">
                    <div class="name">
                        <h2>A-ha</h2>
                    </div>
                </div>

                <div class="right">
                    <a href="#"> Play</a>
                </div>
            </div>
        </div>

        <div class="bottom"></div>

    </div>

    <div class="menuList">

        <p>
            <i>
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 640 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M96 224c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm448 0c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm32 32h-64c-17.6 0-33.5 7.1-45.1 18.6 40.3 22.1 68.9 62 75.1 109.4h66c17.7 0 32-14.3 32-32v-32c0-35.3-28.7-64-64-64zm-256 0c61.9 0 112-50.1 112-112S381.9 32 320 32 208 82.1 208 144s50.1 112 112 112zm76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C179.6 288 128 339.6 128 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2zm-223.7-13.4C161.5 263.1 145.6 256 128 256H64c-35.3 0-64 28.7-64 64v32c0 17.7 14.3 32 32 32h65.9c6.3-47.4 34.9-87.3 75.2-109.4z"></path></svg>
            </i>12.3M
            <span>Followers</span>

        <h4 id="totalTime">  <i class="bi bi-hourglass"></i> {{$this->calculatePlaylistTime()}}  </h4>
        </p>
    </div>

    <div class="AudioList">
        <h2 class="title">The list
            <span> {{$songs->count()}} songs</span>


        </h2>

        <div class="songsContainer">

            @foreach($songs as $song)


                <div  class="songs">
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
                                        <a wire:click.prevent="deleteSong({{$song->id}})" href="#"> Usuń z Playlisty </a>
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

    </div>
</div>


