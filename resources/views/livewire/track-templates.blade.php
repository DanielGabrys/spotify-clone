<div class="menu_track_template" >

    <div class="add_template_track">

        <form class="form-custom">

            @csrf

            <div class="form-custom-item">
                <div class="">
                    <input type="text" wire:model="template_name" class="form-input" id="template_name" placeholder="nazwa" >
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
                    <input type="checkbox" wire:model="template_loops" class="form-input" id="template_loops_edit" placeholder="zapętlaj">
                </div>
                <label class="form-check-label" for="flexCheckDefault"> zapetlaj
                </label>
                @error('template_loops') <span class="text-red-500"> {{$message}} </span> @enderror
            </div>

            <div class="form-custom-item">
                <a wire:click.prevent="createTemplate" href="#">
                    <button type="button" class="btn btn-secondary" id="add-tag-button">DODAJ </button>
                </a>
            </div>

        </form>


        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">NAZWA</th>
                <th scope="col"> <span style="font-size: 12px"> <i class="bi bi-hourglass"></i> [mm] </span></th>
                <th scope="col"> <span style="font-size: 12px"> <i class="bi bi-arrow-repeat"></i> </span></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>


            @foreach($templates as $template)

                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$template->name}}</td>
                    <td>{{$template->max_time}}</td>
                    <td>

                        @if($template->loop)
                        <i class="bi bi-check-lg"></i></td>
                         @endif
                    <td>
                        <a wire:click.prevent="showTrackTemplate({{$template->id}})">
                            <button type="button" class="btn btn-secondary">Taguj </button>
                        </a>
                    </td>

                    <td>
                        <a wire:click.prevent="deleteTemplate({{$template->id}})">
                            <i class="bi bi-trash3-fill" style="cursor: pointer"></i>
                        </a>
                    </td>
                </tr>

            @endforeach

            </tbody>
        </table>


    </div>

    <div class="menu_template_track">

        @if($templates->count()>0)

        <div id="dropzone"
             class="track_template_dropzone"
             x-data @dragover="onDragOver(event)" @drop="onDropTemplate(event)"> Upuść Tag


            <div class="TagTools">


                @if($template_tags)

                @forelse($template_tags as $track )


                    <span class="song_tag_item"> {{$track->name }}

                    <a wire:click.prevent="deleteTemplateTag({{$track->pivot->id ?? null}})">
                        <i class="bi bi-x-square" style="cursor: pointer"></i>
                    </a>
                    <i class="bi bi-arrow-right"></i>
                </span>

                @empty

                    <span class="song_tag_item"> puste </span>


                @endforelse

                @endif
            </div>

        </div>

        <div class="generate_template_playlist">

                <form class="form-custom">


                    <div class="form-custom-item">
                        <input type="text" wire:model="template_playlist_name"  class="form-input" id="template_playlist_name" placeholder="playlista">
                        @error('template_playlist_name') <span class="text-red-500"> {{$message}} </span> @enderror
                    </div>

                    <div class="form-custom-item">
                        <a wire:click.prevent="generateTemplatePlaylist" href="#">
                            <button type="button" class="btn btn-secondary" id="add-tag-button">Generuj </button>
                        </a>
                    </div>

                    <div class="form-custom-item">
                        <input type="checkbox" wire:model="template_playlist_export" class="form-input" id="export_spotify"  >
                        <label class="form-check-label" for="flexCheckDefault"> Eksportuj do Spotify
                    </div>




                </form>

            </div>

        <div class="edit_template_track">

                <form class="form-custom">


                    <div class="form-custom-item">
                            <input type="text" wire:model="template_name_edit"  class="form-input" id="template_name_edit" value="{{$selected_template->name}}">
                        @error('template_name_edit') <span class="text-red-500"> {{$message}} </span> @enderror
                    </div>

                        <div class="form-custom-item">
                            <input type="number" min="1" wire:model="template_time_edit" class="form-input" id="template_time_edit" value="{{$selected_template->max_time}}">

                        @error('template_time_edit') <span class="text-red-500"> {{$message}} </span> @enderror
                    </div>


                    <div class="form-custom-item">

                            <input type="checkbox" wire:model="template_loops_edit" class="form-input" id="template_loops_edit"   >

                         <label class="form-check-label" for="flexCheckDefault"> zapetlaj
                        </label>
                        @error('template_loops_edit') <span class="text-red-500"> {{$message}} </span> @enderror
                    </div>

                    <div class="form-custom-item">
                        <a wire:click.prevent="editTemplate" href="#">
                            <button type="button" class="btn btn-secondary" id="add-tag-button">AKTUALIZUJ </button>
                        </a>
                    </div>

                </form>

            </div>

        @endif



    </div>







</div>
