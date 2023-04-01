
/*
class AudioPlayer
{

    audioPlayerContainer
    playIconContainer
    playState
    muteState
    audio
    stopOrPlay
    seekSlider
    durationContainer
    currentTimeContainer
    raf

    constructor()
    {
        this.audioPlayerContainer = document.getElementById('bar');
        this.playIconContainer = document.getElementById('play');
        this.playState = 'play';
        this.muteState = 'unmute';
        this.audio = document.getElementById('audio_src');
        this.seekSlider = document.getElementById('seek-slider');
        this.durationContainer = document.getElementById('duration');
        this.currentTimeContainer = document.getElementById('current-time');
        this.raf = null;


    }

    calculateTime(secs)
    {
        const minutes = Math.floor(secs / 60);
        const seconds = Math.floor(secs % 60);
        const returnedSeconds = seconds < 10 ? `0${seconds}` : `${seconds}`;
        return `${minutes}:${returnedSeconds}`;
    }

    displayDuration()
    {
        this.durationContainer.textContent = this.calculateTime(this.audio.duration);
    }

    setSliderMax()
    {
      this.seekSlider.max = Math.floor(this.audio.duration);
    }



    startMusic(object)
    {
       this.playStopSwitch(object)
    }

    playStopSwitch(object)
    {
        if(object.playState === 'play')
        {
            object.audio.currentTime =60
            object.audio.play();
            object.playState = 'pause';
            object.playIconContainer.className = "bi bi-pause-circle-fill"
        }
        else
        {
            object.audio.pause();
            object.playState = 'play';
            object.playIconContainer.className = "bi bi-play-fill"
        }

    }

    addPlayStopListener(object)
    {
        this.playIconContainer.addEventListener('click', function ()
        {
          object.startMusic(object)
        });
    }



}

const songs =[]



*/




















