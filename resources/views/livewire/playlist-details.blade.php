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

        <h4 id="totalTime">  <i class="bi bi-hourglass"></i>   </h4>
        </p>
    </div>

    <div class="AudioList">
        <h2 class="title">The list
            <span>12 songs</span>


        </h2>

        <div class="songsContainer">

            @foreach($songs as $song)

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
                            <p class="songName"> {{$song->title}}
                                <span class="songSpan">{{$song->author}}</span>
                            </p>
                            <div class="hits">
                                <p class="hit"></p>
                                <p class="duration">
                                    <i id="song_time_{{$loop->index}}">
                                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm61.8-104.4l-84.9-61.7c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v141.7l66.8 48.6c5.4 3.9 6.5 11.4 2.6 16.8L334.6 349c-3.9 5.3-11.4 6.5-16.8 2.6z"></path></svg>
                                    </i>03:04</p>
                                <div class="favourite">
                                    <i>
                                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M458.4 64.3C400.6 15.7 311.3 23 256 79.3 200.7 23 111.4 15.6 53.6 64.3-21.6 127.6-10.6 230.8 43 285.5l175.4 178.7c10 10.2 23.4 15.9 37.6 15.9 14.3 0 27.6-5.6 37.6-15.8L469 285.6c53.5-54.7 64.7-157.9-10.6-221.3zm-23.6 187.5L259.4 430.5c-2.4 2.4-4.4 2.4-6.8 0L77.2 251.8c-36.5-37.2-43.9-107.6 7.3-150.7 38.9-32.7 98.9-27.8 136.5 10.5l35 35.7 35-35.7c37.8-38.5 97.8-43.2 136.5-10.6 51.1 43.1 43.5 113.9 7.3 150.8z"></path></svg>
                                    </i>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            @endforeach


        </div>

    </div>
</div>

<script>

</script>
