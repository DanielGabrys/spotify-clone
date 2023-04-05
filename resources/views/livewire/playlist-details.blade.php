<div class="mainContainer">

    <div class="Banner"><img src="{{asset('storage/images/toFill/emptyPlaylist.png')}}" class="bannerImg">
        <div class="content">
            <div class="breadCrump">
                <i class="bi bi-three-dots"></i>
            </div>

            <div class="artist">
                <div class="left">
                    <div class="name">
                        <h2>{{$playlists->find($currentPlaylist)->name}}</h2>
                    </div>

                    <div class="description">
                        <h2>{{$playlists->find($currentPlaylist)->description}}</h2>
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

        <div wire:click="ActivateDraggableModule(document.getElementById('flexSwitchCheckDefault').checked,@js($currentPlaylist))" class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
            <label class="form-check-label" for="flexSwitchCheckDefault">Drag and Drop module</label>
        </div>

    </div>

    @include($dragableSubView)

</div>



