<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>


    <link href="{{asset('css/App.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="{{asset('js/App.js')}}" type="module"></script>

    @livewireStyles



</head>
<body>

<header>
    @include('sidebars.LeftMenu')
    @yield('Center')
    @include('sidebars.Player')
</header>

@livewireScripts
<script>
    let SongList = {!! $songs_json !!};
</script>




