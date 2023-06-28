<div class="playlist-manager">


    <form class="form-custom">


        <div class="form-custom-item">
            <div class="">
                <input type="text" wire:model="playlist_name" class="form-input" id="playlist_name" placeholder="nazwa">
            </div>
            @error('playlist_name') <span class="text-red-500"> {{$message}} </span> @enderror
        </div>

        <div class="form-custom-item">
            <div class="">
                <textarea wire:model="playlist_description" id="playlist_description" class="form-textarena" rows="1" cols="50"  > opis </textarea>
            </div>
            @error('playlist_description') <span class="text-red-500"> {{$message}} </span> @enderror
        </div>

        <div class="form-custom-item">
            <div class="form-custom-item-file">
                <div class="form-custom-item-file-label"> zdjęcie </div>
                <input type="file" wire:model="playlist_img" class="custom-input-file" id="PlaylistImg" >
            </div>
            @error('playlist_img') <span class="text-red-500"> {{$message}} </span> @enderror
        </div>


        <a wire:click.prevent="addPlaylistForm()" href="#">
            <button type="button" class="btn btn-primary" id="add-song-button">DODAJ </button>
        </a>



    </form>





</div>
