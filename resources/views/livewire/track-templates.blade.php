<div class="menu_track_template" >

    <div class="add_template_track">

        <form class="form-custom">


            <div class="form-custom-item">
                <div class="">
                    <input type="text" wire:model="template_name" class="form-input" id="template_name" placeholder="nazwa">
                </div>

                @error('template_name') <span class="text-red-500"> {{$message}} </span> @enderror
            </div>


            <div class="form-custom-item">
                <div class="">
                    <input type="number" min="1" wire:model="template_time" class="form-input" id="template_time" placeholder="czas">
                </div>
                @error('template_time') <span class="text-red-500"> {{$message}} </span> @enderror
            </div>


            <div class="form-custom-item">
                <div class="">
                    <input type="checkbox" wire:model="template_loops" class="form-input" id="template_loops" placeholder="zapętlaj">
                </div>
                <label class="form-check-label" for="flexCheckDefault"> zapetlaj
                </label>
                @error('template_loops') <span class="text-red-500"> {{$message}} </span> @enderror
            </div>

            <div class="form-custom-item">
                <a wire:click.prevent="createtemplate" href="#">
                    <button type="button" class="btn btn-secondary" id="add-tag-button">DODAJ </button>
                </a>
            </div>

        </form>


        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">NAZWA</th>
                <th scope="col">CZAS [hh:mm:ss]</th>
                <th scope="col">PIOSENKI</th>
            </tr>
            </thead>
            <tbody>


            @foreach($templates as $template)

                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$template->name}}</td>
                    <td>{{$template->max_time}}</td>
                    <td>
                        <a wire:click.prevent="showTrackTemplate({{$template->id}})">
                            <button type="button" class="btn btn-secondary">Taguj </button>
                        </a>
                    </td>
                </tr>

            @endforeach

            </tbody>
        </table>


    </div>


    <div class="menu_template_track">

        @if($templates->count()>0)

        <div id=""
             class="track_template_dropzone"
             x-data @dragover="onDragOver(event)" @drop="onDropTemplate(event)"> Upuść Tag


            <div class="TagTools">


                @forelse($template_tags as $track )


                    <span class="song_tag_item"> {{$track->name }}
                    <i class="bi bi-x-square"></i>
                    <i class="bi bi-arrow-right"></i>
                </span>

                @empty

                    <span class="song_tag_item"> puste </span>


                @endforelse

            </div>

        </div>

        @endif



    </div>







</div>
