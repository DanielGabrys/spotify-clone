<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>


        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

        <!-- Bootstrap CSS -->
        <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

        <!-- Bootstrap Bundle with Popper -->
        <script src="{{asset('bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


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

    </body>
</html>

