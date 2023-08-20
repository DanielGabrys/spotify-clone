class Player {

    requestStatus = 1;
    token;
    SongList
    currentSongId = 0;
    currentVolumeValue = 50;
    currentSpeedValue = 1
    currentSRC
    currentTime
    currentTimeLabel
    tags

    interval
    intervals = []
    interval_time

    audio
    playMusicButton
    trackSlider
    volumeSlider
    volumeIcon
    speedSlider
    duration
    duration_s
    prev
    next
    state = "pause";
    stopClassIcon = "bi bi-pause-circle-fill"
    playClassIcon = "bi bi-play-fill"
    volumeOff = "bi bi-volume-mute-fill"
    volumeOn = "bi bi-volume-down-fill"

    setPlayerProperties() {
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

    setToken(token) {
        this.token = token;
    }

    setSongList(SongList) {
        console.log(SongList);
        this.SongList = SongList
    }

    setInitialSong() {

        this.SongList = [];
        /*
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
       this.interval_time=0

        this.setTrackSliderLength(duration)

         */
    }

    setTagsInfo() {

        this.unsetTagsInfo();
        const parent = document.getElementById('played_menu_tag')

        this.tags = this.SongList.find(x => x.src === this.currentSRC);

        for (let i = 0; i < this.tags.songs_tags.length; i++) {
            let div = document.createElement("div");
            div.innerHTML = '<span>' + this.tags.songs_tags[i].name + '</span>'
            div.classList.add('played_tag')
            parent.appendChild(div);
        }

    }

    unsetTagsInfo() {
        const parent = document.getElementById('played_menu_tag')
        parent.replaceChildren();
    }


    setSliderValues() {

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
            await this.startTrack().then((data) => {
                if (!this.requestStatus) return 0;

                this.interval = setInterval(updateTrackState, 1000, player)
                this.intervals.push(this.interval)
                this.setStopIcon()
                this.state = "play"
            })




        } else if (this.state == "play") {

            await this.stopTrack()
            updateState(player)
            this.setStartIcon()
            this.state = "pause"

        }


    }

    async playMusicTrack() {

        this.clearIntervals(this.intervals)

        await this.startTrack().then((data) => {
            console.log("r", this.requestStatus);
            if (!this.requestStatus) return 0;

            this.setStopIcon()
            this.state = "play"
            this.interval = setInterval(updateTrackState, 1000, player)
            this.intervals.push(this.interval)
                // this.waveAnimation()
        });
    }


    setStopIcon() {
        this.playMusicButton.className = this.stopClassIcon
        this.state = "play"
    }

    setStartIcon() {
        this.playMusicButton.className = this.playClassIcon
        this.state = "stop"
    }

    waveAnimation() {
        if (this.state === "play")
            document.getElementById('wave').classList.add("active1")
        else
            document.getElementById('wave').classList.remove("active1")
    }

    setTrackSliderLength(time) {
        this.trackSlider.max = parseInt(time)
    }

    calculateTime(sec) {
        const minutes = Math.floor(sec / 60);
        const returnMin = minutes < 10 ? `${minutes}` : `${minutes}`;
        const seconds = Math.floor(sec % 60);
        const returnSec = seconds < 10 ? `0${seconds}` : `${seconds}`;
        return `${returnMin}:${returnSec}`;
    }

    async setTrack(id) {


        this.currentTime = 0;
        this.interval_time = 0;


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
        document.getElementById('player_href').href = this.SongList[this.currentSongId].spotify_track_url
            // document.getElementById('playerAudio').src = this.SongList[this.currentSongId].src
        this.currentSRC = this.SongList[this.currentSongId].src
        document.getElementById('duration').innerText = this.calculateTime(duration)
        this.duration_s = duration

        this.setTrackSliderLength(duration)
        this.setTagsInfo()

        this.clearIntervals(this.intervals);
        await this.playMusicTrack()



    }

    playNextSongInQueue() {
        this.setTrack(this.currentSongId + 1)
            //   this.audio.play()
    }

    calculateSpeed(val) {

        let up = 0;
        if (val == -10)
            up = -1
        else if (val == 10)
            up = 1
        else
            up = val % 10 / 10


        return 1 + up

    }

    markCurrentlyPlayed(pos) {
        let song = document.getElementById(pos)
        if (song != null)
            song.style.backgroundColor = '#373b3e';

    }

    unMarkCurrentlyPlayed(pos) {

        let song = document.getElementById(pos)
        if (song != null)
            song.style.backgroundColor = 'rgba(34, 34, 34, 0.6)';

    }


    async stopTrack() {

        let request_answer = await fetch(
            "https://api.spotify.com/v1/me/player/pause", {
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

        this.clearIntervals(this.intervals)
        console.log(this.interval, "cleaned")


    }

    async startTrack() {
        let request_answer = await fetch(
            "https://api.spotify.com/v1/me/player/play", {
                method: "PUT",
                body: JSON.stringify({
                    uris: [this.currentSRC],
                    position_ms: this.currentTime * 1000
                }),
                headers: new Headers({
                    Authorization: "Bearer " + token,
                }),
            }
        ).then((response) => {

            this.requestStatus = 1


            if (response.status >= 400 && response.status < 600) {
                alert('Nawiązanie połączenia ze Spotify nie powiodło się. Uruchom aplikację')
                this.requestStatus = 0
            }


        })
    }


    async seekTrack() {


        this.currentTime = parseInt(this.trackSlider.value)
        this.interval_time = this.currentTime
        let time = this.trackSlider.value * 1000
        let uri = 'https://api.spotify.com/v1/me/player/seek?position_ms=' + time
        let request_answer = await fetch(
            uri, {
                method: "PUT",
                body: JSON.stringify({}),
                headers: new Headers({
                    Authorization: "Bearer " + token,
                }),
            }
        )


    }


    clearIntervals() {
        for (let i = 0; i < this.intervals.length; i++) {
            clearInterval(this.intervals[i])
        }
        this.intervals = [];
    }


}

async function updateState(object) {


    object.clearIntervals(object.intervals);
    let state = await fetch("https://api.spotify.com/v1/me/player", {
        method: "GET",
        headers: new Headers({
            Authorization: "Bearer " + token,
        }),
    })

    const jsonData = await state.json();
    object.currentTime = jsonData.progress_ms / 1000;


}

function updateTrackState(object) {


    //console.log(object.interval_time)
    object.currentTime = object.interval_time
    object.currentTimeLabel.innerText = object.calculateTime(object.currentTime)
    object.trackSlider.value = player.currentTime
    object.interval_time++;

    if (object.currentTime >= object.duration_s) {
        object.playNextSongInQueue()
    }


}


player = new Player()