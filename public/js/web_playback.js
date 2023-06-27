

let token=Token
let device;

console.log("token",token)


// Wait for player to be ready
window.onSpotifyWebPlaybackSDKReady = () => {
    const player = new Spotify.Player({
        name: "Ballroom Spotify",
        getOAuthToken: (cb) => {
            cb(token);
        },
        volume: 0.5,
    });

    // Player Ready
    player.addListener("ready", ({ device_id }) => {
        console.log("Ready with Device ID", device_id);


        // After player is ready, change current device to this player
        const connect_to_device = () => {
            console.log("Changing to device: ", device_id);


            let change_device = fetch("https://api.spotify.com/v1/me/player", {
                method: "PUT",
                body: JSON.stringify({
                    device_ids: [device],
                    play: false,
                }),
                headers: new Headers({
                    Authorization: "Bearer " + token,
                }),
            }).then((response) => console.log(response));

        };
        connect_to_device();


    });

    // Not Ready
    player.addListener("not_ready", ({ device_id }) => {
        console.log("Device ID has gone offline", device_id);
    });

    // Error Handling
    player.addListener("initialization_error", ({ message }) => {
        console.error(message);
    });
    player.addListener("authentication_error", ({ message }) => {
        console.error(message);
    });
    player.addListener("account_error", ({ message }) => {
        console.error(message);
    });

    // Start device connection
    player.connect().then((success) => {
        if (success) {
            console.log("The Web Playback SDK successfully connected to Spotify!");
        }
    });



};

function setDevice(Device)
{
    device = Device
}
