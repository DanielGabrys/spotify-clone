class Player
{

    token;
    SongList
    currentSongId = 0;
    currentVolumeValue = 50;
    currentSpeedValue =1
    currentSRC
    currentTime
    currentTimeLabel

    interval

    audio
    playMusicButton
    trackSlider
    volumeSlider
    volumeIcon
    speedSlider
    duration
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
        this.currentTimeLabel = document.getElementById("current-time")
        this.currentTime = 0;
        this.prev = document.getElementById('playPrev');
        this.next = document.getElementById('playNext');
    }

    setToken(token)
    {
        this.token=token;
    }

    setSongList(SongList)
    {
        console.log(SongList);
        this.SongList = SongList
    }

    setInitialSong()
    {
        if(this.SongList.length===0)
            return 0;

        let title = this.SongList[0].title;
        let author = this.SongList[0].author;
        let img = this.SongList[0].image;
        let src = this.SongList[0].src;
        let duration =this.SongList[0].duration


        document.getElementById('playerTitle').innerText=title
        document.getElementById('playerSubtitle').innerText=author
        document.getElementById('playerImg').src = img
        this.currentSRC = src
        document.getElementById('duration').innerText = this.calculateTime(duration)

       // this.markCurrentlyPlayed("Playlist_song_"+(this.currentSongId))

       this.trackSlider.value=0
       this.volumeSlider.value=50
       this.speedSlider.value=0

        this.setTrackSliderLength(duration)
    }

    setSliderValues()
    {

        this.audio.playbackRate = this.currentSpeedValue

        if (this.volumeIcon.className === this.volumeOn)
            this.audio.volume = this.currentVolumeValue / this.volumeSlider.max

    }
     async playMusic() {


         console.log("state:" + this.state)

         if (this.SongList.length === 0) {
             return alert("Playlista jest pusta")
         }


         if (this.state == "pause") {
             await this.startTrack()

             this.interval = setInterval(updateState,1000,player)
             this.setStopIcon()
             this.state = "play"

         } else if (this.state == "play") {

             await this.stopTrack()
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

    async setTrack(id) {


        this.currentTime=0;
        if (id >= this.SongList.length) {
            this.unMarkCurrentlyPlayed("Playlist_song_" + (this.currentSongId))
            this.currentSongId = 0;
            this.markCurrentlyPlayed("Playlist_song_" + (this.currentSongId))
        } else if (id <= 0) {

            this.unMarkCurrentlyPlayed("Playlist_song_" + (this.currentSongId))
            this.currentSongId = 0;
            this.markCurrentlyPlayed("Playlist_song_" + (this.currentSongId))
        } else {

            this.unMarkCurrentlyPlayed("Playlist_song_" + (this.currentSongId))

            this.currentSongId = id
            this.markCurrentlyPlayed("Playlist_song_" + (this.currentSongId))

        }

        let duration = this.SongList[this.currentSongId].duration

        document.getElementById('playerTitle').innerText = this.SongList[this.currentSongId].title
        document.getElementById('playerSubtitle').innerText = this.SongList[this.currentSongId].author
        document.getElementById('playerImg').src = this.SongList[this.currentSongId].image
        // document.getElementById('playerAudio').src = this.SongList[this.currentSongId].src
        this.currentSRC = this.SongList[this.currentSongId].src
        document.getElementById('duration').innerText = this.calculateTime(duration)

        this.setTrackSliderLength(duration)
        await this.startTrack()
        this.setStopIcon()
        this.state = "play"
        // this.setSliderValues()

        //this.waveAnimation()

    }

    playNextSongInQueue()
    {
        this.setTrack(this.currentSongId+1)
        this.currentTime=0;
     //   this.audio.play()
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

    markCurrentlyPlayed(pos)
    {
        let song = document.getElementById(pos)
        if(song!=null)
            song.style.backgroundColor='#373b3e';

    }

    unMarkCurrentlyPlayed(pos)
    {

        let song = document.getElementById(pos)
        if(song!=null)
           song.style.backgroundColor='rgba(34, 34, 34, 0.6)';

    }


    async stopTrack()
    {
        let request_answer = await fetch(
            "https://api.spotify.com/v1/me/player/pause",
            {
                method: "PUT",
                body: JSON.stringify({
                    uris: [this.currentSRC],
                }),
                headers: new Headers({
                    Authorization: "Bearer " + token,
                }),
            }
        ).then(
            (data) => console.log("")
        );

        clearInterval(this.interval)
    }

    async startTrack()
    {
        console.log(this.currentTime)
        let request_answer = await fetch(
            "https://api.spotify.com/v1/me/player/play",
            {
                method: "PUT",
                body: JSON.stringify({
                    uris: [this.currentSRC],
                    position_ms: this.currentTime*1000
                }),
                headers: new Headers({
                    Authorization: "Bearer " + token,
                }),
            }
        )
    }

    async seekTrack()
    {

        let request_answer = await fetch(
            "https://api.spotify.com/v1/me/player/seek",
            {
                method: "PUT",
                body: JSON.stringify({
                    position_ms: parseInt(this.trackSlider.value)*1000
                }),
                headers: new Headers({
                    Authorization: "Bearer " + token,
                }),
            }
        )
    }





}

async function updateState(object)
{

    let state = await fetch("https://api.spotify.com/v1/me/player",
        {
            method: "GET",
            headers: new Headers({
                Authorization: "Bearer " + token,
            }),
        })

    const jsonData = await state.json();
    object.currentTime = jsonData.progress_ms/1000;


    object.currentTimeLabel.innerText = object.calculateTime(object.currentTime)
    object.trackSlider.value=player.currentTime

    if(object.currentTime>=this.duration )
        object.playNextSongInQueue()

}


player = new Player()


