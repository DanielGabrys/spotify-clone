<div class="master_play">
        <div class="wave" id="wave">
            <div class="wave1"> </div>
            <div class="wave1"> </div>
            <div class="wave1"> </div>
        </div>

        <audio id="playerAudio" src=""> </audio>

        <img src="" alt="" id="playerImg">
        <div class="song_info">
            <div id="playerTitle" class="song_title"></div>
            <div id="playerSubtitle" class="subtitle"></div>
        </div>

        <div x-data class="icon">
            <i @click="PlayPrevSong" id="playPrev" class="bi bi-skip-start-fill"> </i>
            <i @click="handlePlayClick" id="playMusic" class="bi bi-play-fill"></i>
            <i @click="PlayNextSong" id="playNext" class="bi bi-skip-end-fill"></i>
        </div>
        <span id="current-time"> 0:00 </span>

        <div class="bar">
            <input type="range" id="seek-slider" min="0"; max="100"; value="0">
        </div>

        <span id="duration"> </span>

        <div class="vol">
            <i class="bi bi-volume-down-fill" id="vol-icon"></i>
            <input type="range" id="vol-slider" min="0"; max="100"; value="50">
        </div>

        <span id="volume"> 50 </span>


        <div class="vol">
            <i class="bi bi-speedometer"></i>
            <input type="range" id="speed-slider" min="-10"; max="10"; value="0">
        </div>

        <span id="speed"> 1.0 </span>


</div>

<script>

    player.setSongList({!! $songs_json !!})
    player.setPlayerProperties()
    player.setInitialSong()

    console.log(player)

    player.audio.addEventListener('timeupdate', function ()
    {
        let curr_time = parseInt(player.audio.currentTime)
        let duration = parseInt(player.audio.duration)


        player.currentTime.innerText = player.calculateTime(curr_time)
        player.trackSlider.value = curr_time

        if(curr_time>=duration )
            player.playNextSongInQueue()

    })

    player.trackSlider.addEventListener('change', function ()
    {
        player.audio.currentTime = player.trackSlider.value
    })



    function handlePlayClick()
    {

         player.playMusic()
         player.waveAnimation()
    }


    function PlaySong(id)
    {
        console.log(id)
       player.setTrack(id)
       player.setStopIcon()
       player.audio.play()
    }

    function PlayNextSong(id)
    {
        player.setTrack(player.currentSongId+1)
    }

    function PlayPrevSong(id)
    {
        player.setTrack(player.currentSongId+-1)
    }



</script>

