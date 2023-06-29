<div class="menu_tag" >

    @foreach($tags as $tag)
        <span id="tag_{{$tag->name}}"
              class="drag-drop"
              draggable="true"

              x-data @dragstart="onDragStart(event)"

        > {{$tag->name}} <i wire:click.prevent="deleteTag({{$tag->id}})" class="bi bi-x" style="cursor: pointer;"> </i> </span>
    @endforeach

        <div class="form-custom">


            <div class="form-custom-item-tag">
                <div class="">
                    <input type="text" wire:model="name" class="form-input" id="name" placeholder="nazwa tagu">
                </div>

            </div>


            <a wire:click.prevent="addTag" href="#">
                <button type="button" class="btn btn-secondary" id="add-tag-button">DODAJ </button>
            </a>

        </div>

        @error('name') <span class="text-red-500"> {{$message}} </span> @enderror




</div>
