<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>

    <div class="container" id="home_container">
        <p><img src="{{asset('storage/images/toFill/logo.jpeg')}}" alt="Balllroom Music Generator"></p>
        <p><button onclick="userLogInRequest();">Log In User</button></p>
    </div>

    <script>

        function userLogInRequest()
        {
            let logInUri = 'https://accounts.spotify.com/authorize' +
                '?client_id={{\App\Models\SpotifyApi\SpotifyApi:: $api_client_id}}' +
                '&response_type=code' +
                '&redirect_uri={{\App\Models\SpotifyApi\SpotifyApi:: $redirect_url}}' +
                '&scope=app-remote-control user-top-read user-read-currently-playing user-read-recently-played streaming app-remote-control user-read-playback-state user-modify-playback-state playlist-modify-public'  +
                '&show_dialog=true';
            // Debug
//
            console.log(logInUri);
            // Open URL to request user log in from Spotify
           window.open(logInUri, '_self');
        }
    </script>


    </body>
</html>

<style>
    body {
        background-color: #1C2120;
        color: #CCC;
    }

    header {
        margin-bottom: 3rem;
    }

    .container button {
        padding: 0.5rem 1rem;
        border-radius: 3px;
        cursor: pointer;
    }

    #home_container {
        display: grid;
        place-items: center;
    }

    #home_container button {
        padding: 1rem 2rem;
        border-radius: 5px;
        cursor: pointer;
    }

    .header_logo {
        width: 125px;
        height: 125px;
    }

    .grid_container {
        display: grid;
        grid-template-columns: auto auto auto auto;
    }
</style>

