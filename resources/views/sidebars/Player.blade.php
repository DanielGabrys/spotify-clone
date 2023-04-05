<div class="master_play">
        <div class="wave" id="wave">
            <div class="wave1"> </div>
            <div class="wave1"> </div>
            <div class="wave1"> </div>
        </div>

        <audio id="playerAudio" src=""> </audio>

        <img src="{{asset('storage/images/toFill/playlist.png')}}" alt="" id="playerImg">
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

        <div x-data class="bar">
            <input @change="TrackSliderChange" type="range" id="seek-slider" min="0"; max="100"; value="0">
        </div>
        <span id="duration"> </span>


        <div x-data class="vol">
            <i @click="VolumeIconChange" class="bi bi-volume-down-fill" id="vol-icon"></i>
            <input @change="VolumeChange" type="range" id="vol-slider" min="0"; max="100"; value="50">
            <span id="volume"> 50 </span>
        </div>



        <div x-data class="vol">
            <i class="bi bi-speedometer"></i>
            <input @change="SpeedChange" type="range" id="speed-slider" min="-10"; max="10"; value="0">
            <span id="speed"> 1.0 </span>
        </div>



</div>

<script>

    player.setSongList({!! $songs_json !!})
    player.setPlayerProperties()
    player.setInitialSong()

    console.log(player)
    console.log(player.SongList)

    player.audio.addEventListener('timeupdate', function ()
    {
        let curr_time = parseInt(player.audio.currentTime)
        let duration = parseInt(player.audio.duration)


        player.currentTime.innerText = player.calculateTime(curr_time)
        player.trackSlider.value = curr_time

        if(curr_time>=duration )
            player.playNextSongInQueue()

    })




    function handlePlayClick()
    {

         player.playMusic()
         player.waveAnimation()
    }


    function PlaySong(songList,start_song_id)
    {

      let songs = JSON.parse(songList);
       player.setSongList(songs)

       player.setTrack(start_song_id)
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

    function TrackSliderChange()
    {
        player.audio.currentTime = player.trackSlider.value
    }


    function VolumeIconChange()
    {

        if(player.volumeIcon.className === player.volumeOn)
        {
            player.audio.volume = 0
            player.volumeIcon.className = player.volumeOff
            player.currentVolumeValue = document.getElementById('vol-slider').value
            document.getElementById('vol-slider').value=0

        }
        else
        {
            player.audio.volume = player.currentVolumeValue/100
            player.volumeIcon.className = player.volumeOn
            document.getElementById('vol-slider').value= player.currentVolumeValue
        }

        document.getElementById("volume").innerText = parseInt(player.audio.volume*100)

    }

    function VolumeChange()
    {
        let volume = document.getElementById('vol-slider')
        //console.log(volume.value)
        if(volume.value==0)
        {
            player.volumeIcon.className = player.volumeOff
            player.audio.volume = volume.value =0
        }

        else
        {
            if(player.volumeIcon.className === player.volumeOff)
                player.volumeIcon.className = player.volumeOn

            player.currentVolumeValue = volume.value
            player.audio.volume = volume.value/volume.max
        }

        document.getElementById("volume").innerText = parseInt(player.audio.volume*100)

    }

    function SpeedChange()
    {
        let volume = document.getElementById('speed-slider').value
        let speed = player.calculateSpeed(volume)
        document.getElementById("speed").innerText = speed.toString()
        player.audio.playbackRate = speed
        player.currentSpeedValue = speed
        //console.log(audio.playbackRate,speed)
    }





</script>

