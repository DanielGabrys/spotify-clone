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

                            @foreach($song->songsTags as $tag )

                                @if($tag->name!='-')
                                    <span class="song_tag_item"> {{$tag->name }}</span>
                                @endif

                            @endforeach

                        </div>

                        <div class="songTools">
                            <i class="bi bi-suit-heart"> </i>

                            <div class="dropdown">
                                <i class="bi bi-three-dots" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                </i>
                            </div>

                        </div>

                    </div>



                </div>

            </div>


        @endforeach

    </div>

</div>
