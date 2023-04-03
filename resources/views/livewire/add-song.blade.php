<div>

    <form class="form-inline">

        <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
                <div class="input-group-text">TYTUŁ</div>
            </div>
            <input type="text" wire:model="title" class="form-control" id="title" >
        </div>

        <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
                <div class="input-group-text">AUTOR</div>
            </div>

            <input type="text" wire:model="author" class="form-control" id="author" >
        </div>

        <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
                <div class="input-group-text">ZDJECIE</div>
            </div>

            <input type="file" wire:model="img" class="form-control" id="img" >
        </div>

        <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
                <div class="input-group-text">UTWÓR</div>
            </div>

            <input type="file" wire:model="songSrc" class="form-control" id="img" >
        </div>


        <a wire:click.prevent="addSongForm()" href="#">
            <button type="button" class="btn btn-primary mb-2" >DODAJ </button>
        </a>
    </form>
</div>
