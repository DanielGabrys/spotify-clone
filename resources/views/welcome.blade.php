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

    <div class="container-fluid d-flex justify-content-center">

        <form class="form-inline">

            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">WIERSZE</div>
                </div>
                <input type="number" class="form-control" id="x" placeholder="1-50" min="1" max="50">
            </div>

            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">COLUMNY</div>
                </div>
                <input type="number" class="form-control" id="y" placeholder="1-50" min="1" max="50">
            </div>

            <button type="button" class="btn btn-primary mb-2"
                    onclick="
                        createGrid.clearGrid();
                        createGrid.addRow(document.getElementById('x').value,document.getElementById('y').value);

               ">STWORZ SIATKE</button>
        </form>

    </div>



    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
    </button>

    <div class="song_side">
        <div id="no-drop" class="drag-drop"> #no-drop </div>

        <div id="yes-drop" class="drag-drop"> #yes-drop </div>

        <div id="outer-dropzone" class="dropzone">
            #outer-dropzone
            <div id="inner-dropzone" class="dropzone">#inner-dropzone</div>
        </div>
    </div>


    </body>
</html>

<script type="module">

    import 'https://cdn.interactjs.io/v1.9.20/auto-start/index.js'
    import 'https://cdn.interactjs.io/v1.9.20/actions/drag/index.js'
    import 'https://cdn.interactjs.io/v1.9.20/actions/resize/index.js'
    import 'https://cdn.interactjs.io/v1.9.20/modifiers/index.js'
    import 'https://cdn.interactjs.io/v1.9.20/dev-tools/index.js'
    import interact from 'https://cdn.interactjs.io/v1.9.20/interactjs/index.js'

    interact('.dropzone').dropzone({
        // only accept elements matching this CSS selector
        accept: '#yes-drop',
        // Require a 75% element overlap for a drop to be possible
        overlap: 0.75,

        // listen for drop related events:

        ondropactivate: function (event) {
            // add active dropzone feedback
            event.target.classList.add('drop-active')
        },
        ondragenter: function (event) {
            var draggableElement = event.relatedTarget
            var dropzoneElement = event.target

            // feedback the possibility of a drop
            dropzoneElement.classList.add('drop-target')
            draggableElement.classList.add('can-drop')
            draggableElement.textContent = 'Dragged in'
        },
        ondragleave: function (event) {
            // remove the drop feedback style
            event.target.classList.remove('drop-target')
            event.relatedTarget.classList.remove('can-drop')
            event.relatedTarget.textContent = 'Dragged out'
        },
        ondrop: function (event) {
            event.relatedTarget.textContent = 'Dropped'
            console.log("drooped")
        },
        ondropdeactivate: function (event) {
            // remove active dropzone feedback
            event.target.classList.remove('drop-active')
            event.target.classList.remove('drop-target')
        }
    })

    interact('.drag-drop')
        .draggable({
            inertia: true,
            modifiers: [
                interact.modifiers.restrictRect({
                    restriction: 'parent',
                    endOnly: true
                })
            ],
            autoScroll: true,
            // dragMoveListener from the dragging demo above
            listeners: { move: dragMoveListener }
        })

    function dragMoveListener (event) {
        var target = event.target
        // keep the dragged position in the data-x/data-y attributes
        var x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx
        var y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy

        // translate the element
        target.style.transform = 'translate(' + x + 'px, ' + y + 'px)'

        // update the posiion attributes
        target.setAttribute('data-x', x)
        target.setAttribute('data-y', y)
        console.log(x,y)
    }

</script>



<style>
    #outer-dropzone {
        height: 140px;
    }

    #inner-dropzone {
        height: 80px;
    }

    .dropzone {
        background-color: #bfe4ff;
        border: dashed 4px transparent;
        border-radius: 4px;
        margin: 10px auto 30px;
        padding: 10px;
        width: 80%;
        transition: background-color 0.3s;
    }

    .drop-active {
        border-color: #aaa;
    }

    .drop-target {
        background-color: #29e;
        border-color: #fff;
        border-style: solid;
    }

    .drag-drop {
        display: inline-block;
        min-width: 40px;
        padding: 2em 0.5em;
        margin: 1rem 0 0 1rem;

        color: #fff;
        background-color: #29e;
        border: solid 2px #fff;

        touch-action: none;
        transform: translate(0px, 0px);

        transition: background-color 0.3s;
    }

    .drag-drop.can-drop {
        color: #000;
        background-color: #4e4;
    }
</style>


