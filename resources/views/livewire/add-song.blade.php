<div>



    <form class="form-custom">
        <div class="form-custom-item">
            <div class="">
                <input type="text" wire:model="title" class="form-input" id="FormTitle" placeholder="tytuł">
            </div>
        </div>

        <div class="form-custom-item">
            <div class="">
                <input type="text" wire:model="author" class="form-input" id="FormAuthor" placeholder="autor">
            </div>
        </div>


        <div class="form-custom-item">
            <div class="form-custom-item-file">
                <div class="form-custom-item-file-label"> zdjęcie </div>
                <input type="file" wire:model="img" class="form-input" id="FormAuthor" >
            </div>
        </div>

        <div class="form-custom-item">
            <div class="form-custom-item-file">
                <div class="form-custom-item-file-label"> utwór </div>
                <input type="file" wire:model="songSrc" class="form-input" id="FormAuthor" >
            </div>
        </div>


        <a wire:click.prevent="addSongForm()" href="#">
            <button type="button" class="btn btn-primary" id="add-song-button">DODAJ </button>
        </a>




    </form>


</div>
