<div class="menu_tag" >

    @foreach($tags as $tag)
        <span class="song_tag_item"> {{$tag->name}} <i wire:click.prevent="deleteTag({{$tag->id}})" class="bi bi-x" style="cursor: pointer;"> </i> </span>
    @endforeach

        <form class="form-custom">


            <div class="form-custom-item-tag">
                <div class="">
                    <input type="text" wire:model="tag_name" class="form-input" id="tag_name" placeholder="nazwa tagu">
                </div>

            </div>


            <a wire:click.prevent="addTag" href="#">
                <button type="button" class="btn btn-secondary" id="add-tag-button">DODAJ </button>
            </a>

        </form>

        @error('tag_name') <span class="text-red-500"> {{$message}} </span> @enderror


</div>
