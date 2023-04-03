<div class="AudioList">


    <h2 class="title">The list
        <span>{{$allSongs->count()}} songs</span>
    </h2>




    @foreach($allSongs as $song)

        <div class="songs">
            <div class="count">
                <p>{{$loop->iteration}}</p>
            </div>

            <div  x-data="{ init() {
                                console.log(@js($song->src))}}"
                  class="song">
                <audio id ="audio_{{$loop->index}}" ></audio>
                <div class="imgBox">
                    <img src="{{$song->image}}" alt="">
                </div>
                <div class="section">
                    <p class="songName">
                        <span class="songSpan" id="title">{{$song->title}}</span>
                        <span class="songSpan" id="author">{{$song->author}}</span>
                        <span class="songSpan"><i class="bi bi-clock-history" ></i>  03:00 </span>
                        <span class="songSpan"> <i class="bi bi-suit-heart"></i> </span>
                    </p>


                    <div class="hits">
                        <p class="hit"></p>

                        <p class="hit">
                            <i class="bi bi-three-dots"></i>
                        </p>
                    </div>



                </div>
            </div>

        </div>


    @endforeach
</div>
