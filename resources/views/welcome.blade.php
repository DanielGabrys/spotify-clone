<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>


        <link href="{{asset('css/App.css')}}" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">




    </head>
    <body>

    <header>
        <div class="menu_side">

            <h1>Playlist</h1>
            <div class="playlist">
                <h4 class="active"> <span></span> <i class="bi bi-music-note-beamed"></i> Playlist</h4>
                <h4> <span></span> <i class="bi bi bi-music-note-beamed"></i> dsdsdsds </h4>
                <h4> <span></span> <i class="bi bi-music-note-beamed"></i> sdsdsdsd </h4>

            </div>

            <div class="menu_song">

                @foreach($songs as $song)
                <li class="songItem" id="song_{{$loop->index}}">
                    <span> {{$loop->iteration}} </span>
                    <img src="{{$song->image}}" alt="">
                    <div class="song_info">
                        <div class="song_title">{{$song->title}}</div>
                        <div class="subtitle">{{$song->author}}</div>
                    </div>
                    <input type="hidden" id="song__{{$song->id}}" value="{{$song->id}}">

                </li>

                @endforeach
            </div>

        </div>


        <div class="song_side"></div>


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

            <div class="icon">
                <i id="playPrev" class="bi bi-skip-start-fill"> </i>
                <i id="playMusic" class="bi bi-play-fill"></i>
                <i id="playNext" class="bi bi-skip-end-fill"></i>
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
        </header>
    </body>
</html>


<script>

    let SongList = {!! $songs_json !!};

    let currentSongId = 0;
    let currentVolumeValue = 50;

    let audio = document.getElementById('playerAudio')
    let playMusicButton = document.getElementById('playMusic')
    let trackSlider = document.getElementById('seek-slider')
    let volumeSlider = document.getElementById('vol-slider')
    let volumeIcon = document.getElementById('vol-icon')
    let speedSlider = document.getElementById('speed-slider')
    let duration = document.getElementById("duration")
    let currentTime = document.getElementById("current-time")
    let prev = document.getElementById('playPrev');
    let next = document.getElementById('playNext');
    let state = "pause";
    let stopClassIcon = "bi bi-pause-circle-fill"
    let playClassIcon = "bi bi-play-fill"
    let volumeOff = "bi bi-volume-mute-fill"
    let volumeOn = "bi bi-volume-down-fill"

    /*
    let playerTitle = document.getElementById('playerTitle').innerText
    let playerSubtitle= document.getElementById('playerSubtitle').innerText
    let playerImg= document.getElementById('playerImg').src
    let playerSrc = document.getElementById('playerAudio').src

     */


    setInitialSong()
    setDurationTime()
    addSongListeners()

    function setInitialSong()
    {
        let title = SongList[0].title;
        let author = SongList[0].author;
        let img = SongList[0].image;
        let src = SongList[0].src;

        document.getElementById('playerTitle').innerText=title
        document.getElementById('playerSubtitle').innerText=author
        document.getElementById('playerImg').src = img
        document.getElementById('playerAudio').src = src

        document.getElementById("song_"+currentSongId).style.backgroundColor = "#4c5262";

        trackSlider.value=0
        volumeSlider.value=50
        speedSlider.value=0
    }

    function PlayMusic()
    {
        if(state==="pause")
        {
            audio.play()
            setStopIcon()
            state = "play"
        }
        else
        {
            audio.pause()
            setStartIcon()
            state = "pause"
        }

    }


    function setStopIcon()
    {
        playMusicButton.className=stopClassIcon
        state = "play"
    }

    function setStartIcon()
    {
        playMusicButton.className=playClassIcon
        state = "stop"
    }


    function setDurationTime()
    {

        if (audio.readyState > 0)
        {
            duration.innerText = calculateTime(audio.duration)
            setTrackSliderLength(audio.duration)
        }
        else
        {
            audio.addEventListener('loadedmetadata', () =>
            {
                duration.innerText = calculateTime(audio.duration)
                setTrackSliderLength(audio.duration)
            });
        }

    }

    function setTrackSliderLength(time)
    {
        trackSlider.max = parseInt(time)
    }

    function setTrack(id)
    {

        //console.log(currentSongId,id)


            if(id>=SongList.length)
            {
                document.getElementById("song_"+(currentSongId)).style.backgroundColor = "#111727";
                currentSongId=0;
            }

            else if(id<=0)
            {
                document.getElementById("song_"+(currentSongId)).style.backgroundColor = "#111727";
                currentSongId=0;
            }

            else
            {

                document.getElementById("song_"+(currentSongId)).style.backgroundColor = "#111727";
                currentSongId=id

            }

        document.getElementById('playerTitle').innerText = SongList[currentSongId].title
        document.getElementById('playerSubtitle').innerText = SongList[currentSongId].author
        document.getElementById('playerImg').src = SongList[currentSongId].image
        document.getElementById('playerAudio').src = SongList[currentSongId].src

        document.getElementById("song_"+currentSongId).style.backgroundColor = "#4c5262";

        setStopIcon()
        audio.play()

        waveAnimation()

    }

    function calculateTime(sec)
    {
        const minutes = Math.floor(sec / 60);
        const returnMin = minutes < 10 ? `${minutes}`:`${minutes}`;
        const seconds = Math.floor(sec % 60);
        const returnSec = seconds < 10 ? `0${seconds}`:`${seconds}`;
        return `${returnMin}:${returnSec}`;
    };

    function addSongListeners()
    {

        for(let i=0;i<SongList.length;i++)
        {
            name="song_"+i
            document.getElementById(name).addEventListener('click', function ()
            {
                setTrack(i)
                setStopIcon()
                audio.play()

            })
        }
    }

    function playNextSongInQueue()
    {
        setTrack(currentSongId+1)
        audio.play()
    }

    function waveAnimation()
    {
        if(state==="play")
            document.getElementById('wave').classList.add("active1")
        else
            document.getElementById('wave').classList.remove("active1")
    }


    playMusicButton.addEventListener('click',function ()
    {
        PlayMusic()
        waveAnimation()
    })

    audio.addEventListener('timeupdate', function ()
    {
        let curr_time = parseInt(audio.currentTime)
        let duration = parseInt(audio.duration)


        currentTime.innerText = calculateTime(curr_time)
        trackSlider.value = curr_time

        if(curr_time>=duration )
            playNextSongInQueue()

    })

    trackSlider.addEventListener('change', function ()
    {
        audio.currentTime = trackSlider.value
    })

    next.addEventListener('click',function ()
    {

        setTrack(currentSongId+1)

    })

    prev.addEventListener('click',function ()
    {
        setTrack(currentSongId-1)

    })

    volumeIcon.addEventListener("click",function ()
    {
        if(volumeIcon.className === volumeOn)
        {
            audio.volume = 0
            volumeIcon.className = volumeOff
            currentVolumeValue = document.getElementById('vol-slider').value
            document.getElementById('vol-slider').value=0

        }
        else
        {
            audio.volume = currentVolumeValue/100
            volumeIcon.className = volumeOn
            document.getElementById('vol-slider').value= currentVolumeValue
        }
    })

    volumeSlider.addEventListener('change',function ()
    {
        let volume = document.getElementById('vol-slider')
        //console.log(volume.value)
        if(volume.value==0)
        {
            volumeIcon.className = volumeOff
            audio.volume = volume.value =0
        }

        else
        {
            if(volumeIcon.className === volumeOff)
                volumeIcon.className = volumeOn

            currentVolumeValue = volume.value
            audio.volume = volume.value/volume.max

        }
    })

    speedSlider.addEventListener('change',function ()
    {
        let volume = document.getElementById('speed-slider').value
        let speed = calculateSpeed(volume)
        document.getElementById("speed").innerText = speed.toString()
        audio.playbackRate = speed
        console.log(audio.playbackRate,speed)
    })

    function calculateSpeed(val)
    {

        let up =0;
        if(val == -10)
            up= -1
        else if(val == 10)
            up= 1
        else
            up = val%10/10


        return 1+up

    }






</script>
