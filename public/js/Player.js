class Player
{

    SongList

    currentSongId = 0;
    currentVolumeValue = 50;
    currentSpeedValue =0

    audio
    playMusicButton
    trackSlider
    volumeSlider
    volumeIcon
    speedSlider
    duration
    currentTime
    prev
    next
    state = "pause";
    stopClassIcon = "bi bi-pause-circle-fill"
    playClassIcon = "bi bi-play-fill"
    volumeOff = "bi bi-volume-mute-fill"
    volumeOn = "bi bi-volume-down-fill"

    setPlayerProperties()
    {
        this.audio = document.getElementById('playerAudio')
        this.playMusicButton = document.getElementById('playMusic')
        this.trackSlider = document.getElementById('seek-slider')
        this.volumeSlider = document.getElementById('vol-slider')
        this.volumeIcon = document.getElementById('vol-icon')
        this.speedSlider = document.getElementById('speed-slider')
        this.duration = document.getElementById("duration")
        this.currentTime = document.getElementById("current-time")
        this.prev = document.getElementById('playPrev');
        this.next = document.getElementById('playNext');
    }

    setSongList(SongList)
    {
        this.SongList = SongList
    }

    setInitialSong()
    {
        let title = this.SongList[0].title;
        let author = this.SongList[0].author;
        let img = this.SongList[0].image;
        let src = this.SongList[0].src;
        let duration =this.SongList[0].duration


        document.getElementById('playerTitle').innerText=title
        document.getElementById('playerSubtitle').innerText=author
        document.getElementById('playerImg').src = img
        document.getElementById('playerAudio').src = src
        document.getElementById('duration').innerText = this.calculateTime(duration)

        // document.getElementById("song_"+currentSongId).style.backgroundColor = "#4c5262";

       this.trackSlider.value=0
       this.volumeSlider.value=50
       this.speedSlider.value=0

        this.setTrackSliderLength(duration)
    }

    setSliderValues()
    {


        let vol=1

        this.audio.playbackRate = this.currentSpeedValue

        if (this.volumeIcon.className === this.volumeOn)
            this.audio.volume = this.currentVolumeValue / this.volumeSlider.max

    }
    playMusic()
    {

        //this.setSliderValues()
        if(this.state==="pause")
        {
            this.audio.play()
            this.setStopIcon()
            this.state = "play"
        }
        else
        {
            this.audio.pause()
            this.setStartIcon()
            this.state = "pause"
        }

    }

    setStopIcon()
    {
        this.playMusicButton.className=this.stopClassIcon
        this.state = "play"
    }

    setStartIcon()
    {
        this.playMusicButton.className=this.playClassIcon
        this.state = "stop"
    }

    waveAnimation()
    {
        if(this.state==="play")
            document.getElementById('wave').classList.add("active1")
        else
            document.getElementById('wave').classList.remove("active1")
    }

    setTrackSliderLength(time)
    {
        this.trackSlider.max = parseInt(time)
    }

    calculateTime(sec)
    {
        const minutes = Math.floor(sec / 60);
        const returnMin = minutes < 10 ? `${minutes}`:`${minutes}`;
        const seconds = Math.floor(sec % 60);
        const returnSec = seconds < 10 ? `0${seconds}`:`${seconds}`;
        return `${returnMin}:${returnSec}`;
    }

    setTrack(id)
    {


        if(id>=this.SongList.length)
        {
            // document.getElementById("song_"+(currentSongId)).style.backgroundColor = "#111727";
            this.currentSongId=0;
        }

        else if(id<=0)
        {
            // document.getElementById("song_"+(currentSongId)).style.backgroundColor = "#111727";
            this.currentSongId=0;
        }

        else
        {

            //document.getElementById("song_"+(currentSongId)).style.backgroundColor = "#111727";
            this.currentSongId=id

        }

        let duration = this.SongList[this.currentSongId].duration

        document.getElementById('playerTitle').innerText = this.SongList[this.currentSongId].title
        document.getElementById('playerSubtitle').innerText = this.SongList[this.currentSongId].author
        document.getElementById('playerImg').src = this.SongList[this.currentSongId].image
        document.getElementById('playerAudio').src = this.SongList[this.currentSongId].src
        document.getElementById('duration').innerText = this.calculateTime(duration)

        // document.getElementById("song_"+currentSongId).style.backgroundColor = "#4c5262";

        this.setStopIcon()
        this.setTrackSliderLength(duration)
       // this.setSliderValues()

        this.audio.play()
        this.waveAnimation()

    }

    playNextSongInQueue()
    {

        this.setTrack(this.currentSongId+1)
        this.audio.play()
    }

    calculateSpeed(val)
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




}

player = new Player()


