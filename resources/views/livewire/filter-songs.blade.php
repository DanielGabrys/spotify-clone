<div>

    <form class="form-custom">


        <div class="form-custom-item">
            <div class="">
                <input type="text" wire:model="search" class="form-input" id="search" placeholder="Szukaj" style="width: 300px">
            </div>
            @error('search') <span class="text-red-500"> {{$message}} </span> @enderror
        </div>

        <a wire:click.prevent="search()" href="#">
            <div class="form-custom-item">
                <i class="bi bi-search"></i>

            </div>
        </a>

    </form>

</div>
