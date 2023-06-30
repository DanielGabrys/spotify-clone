<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ball&Room</title>

    <!--ajax-->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <!-- alpine -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>


    <!-- Bootstrap Dropdown menu -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>

    <!-- Bootstrap Bundle with Popper -->
    <script src="{{asset('bootstrap/js/bootstrap.bundle.min.js')}}"></script>



    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">





    <script src="https://sdk.scdn.co/spotify-player.js"></script>



    <script src="{{asset('js/Player.js')}}"></script>

    <link href="{{asset('css/App.css')}}" rel="stylesheet" />
    <link href="{{asset('css/SongContainer.css')}}" rel="stylesheet" />
    <link href="{{asset('css/DropDownMenu.css')}}" rel="stylesheet" />
    <link href="{{asset('css/trackTemplate.css')}}" rel="stylesheet" />


    <!-- Bootstrap CSS -->
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">


    <!-- icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">


    <script>
        const Token = '@php echo \App\Models\SpotifyApi\SpotifyApi::$token @endphp';
    </script>

    <script src="{{asset('js/web_playback.js')}}" ></script>


    @livewireStyles



</head>
<body>

<div class="header">


    @include('sidebars.LeftMenu')
    @include('sidebars.Player')

</div>

<script>

    function onDragStart(event) {
        event
            .dataTransfer
            .setData('text/plain', event.target.id);

        event
            .currentTarget
            .style
            .backgroundColor = '#00FFFF';
    }

    function onDragOver(event) {
        console.log("onDrag")
        event.preventDefault();
    }

    function onDrop(event) {


        const id = event
            .dataTransfer
            .getData('text');

        const draggableElement = document.getElementById(id).innerText;
        const draggable_id = event.target.id

        console.log(draggableElement,draggable_id)

        Livewire.emit('addSongTag',draggableElement,draggable_id);

    }

    function onDropTemplate(event) {


        const id = event
            .dataTransfer
            .getData('text');

        const draggableElement = document.getElementById(id).innerText;
        const draggable_id = event.target.id

        Livewire.emit('addTemplateTag',draggableElement);

    }

</script>


@livewireScripts
<!-- Livewire sortable -->
<script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>






