<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
        <script src="{{asset('bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
        <!-- Bootstrap CSS -->
        <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>


        <script src="{{asset('js/Player.js')}}" ></script>
        <link href="{{asset('css/App.css')}}" rel="stylesheet" />
        <link href="{{asset('css/SongContainer.css')}}" rel="stylesheet" />
        <link href="{{asset('css/DropDownMenu.css')}}" rel="stylesheet" />

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">


        <link href="{{asset('css/DropDownMenu.css')}}" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

        <!-- Bootstrap CSS -->
        <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

        <!-- Bootstrap Bundle with Popper -->
        <script src="{{asset('bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>


    </head>
    <body>

    <div class="example-parent">
        <h1>To-do list</h1>
        <div class="example-origin">
            To-do
            <div
                id="draggable-1"
                class="example-draggable"
                draggable="true"
                ondragstart="onDragStart(event);"
            >
                thing 1
            </div>
            <div
                id="draggable-2"
                class="example-draggable"
                draggable="true"
                ondragstart="onDragStart(event);"
            >
                thing 2
            </div>
            <div
                id="draggable-3"
                class="example-draggable"
                draggable="true"
                ondragstart="onDragStart(event);"
            >
                thing 3
            </div>
            <div
                id="draggable-4"
                class="example-draggable"
                draggable="true"
                ondragstart="onDragStart(event);"
            >
                thing 4
            </div>
        </div>

        <div
            class="example-dropzone"
            ondragover="onDragOver(event);"
            ondrop="onDrop(event);"
        >
            Done
        </div>
    </div>


    </body>
</html>



<style>
    .example-parent {
        border: 2px solid #DFA612;
        color: black;
        display: flex;
        font-family: sans-serif;
        font-weight: bold;
    }

    .example-origin {
        flex-basis: 100%;
        flex-grow: 1;
        padding: 10px;
    }

    .example-draggable {
        background-color: #4AAE9B;
        font-weight: normal;
        margin-bottom: 10px;
        margin-top: 10px;
        padding: 10px;
    }

    .example-dropzone {
        background-color: #6DB65B;
        flex-basis: 100%;
        flex-grow: 1;
        padding: 10px;
    }
</style>

<script>


    function onDragStart(event) {
        event
            .dataTransfer
            .setData('text/plain', event.target.id);

        event
            .currentTarget
            .style
            .backgroundColor = 'yellow';
    }

    function onDragOver(event) {
        event.preventDefault();
        console.log("test")
    }

    function onDrop(event) {

        const id = event
            .dataTransfer
            .getData('text');

        const draggableElement = document.getElementById(id);

        console.log(draggableElement.innerText)

    }
</script>
