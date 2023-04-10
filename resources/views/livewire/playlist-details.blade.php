<div class="mainContainer">

    <div class="Banner"><img src="{{$currentPlaylist->image}}" class="bannerImg">
        <div class="content">
            <div class="breadCrump">
                <i class="bi bi-three-dots"></i>
            </div>

            <div class="artist">
                <div class="left">
                    <div class="name">
                        {{$currentPlaylist->name}}
                    </div>

                    <div class="description">
                        {{$currentPlaylist->description}}
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

        <h4 id="totalTime">  <i class="bi bi-hourglass"></i> {{$this->calculatePlaylistTime()}}  </h4>

        <div
             wire:click="ActivateDraggableModule(document.getElementById('flexSwitchCheckDefault').checked,@js($currentPlaylist->id))"
             x-data @click="updateTrack(@js($songs_json))"
             class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
            <label class="form-check-label" for="flexSwitchCheckDefault">Drag and Drop module</label>
        </div>

    </div>

    @include($dragableSubView)

</div>



