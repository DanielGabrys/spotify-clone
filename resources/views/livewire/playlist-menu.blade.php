<div>

    <a wire:click.prevent="playlist()" href="#">  <img src="{{$playlist->image ?? null}}" alt=""> </a>

        <div class="song_info">
            <div class="song_title">{{$playlist->name}}</div>
            <div class="subtitle">{{$playlist->description}}</div>
        </div>

    </li>
</div>
