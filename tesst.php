<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.4.0/p5.min.js"></script>-->
    <!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.4.0/p5.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.2.0/p5.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.2.0/addons/p5.sound.js"></script>

    <!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.2.0/p5.js"></script>-->
    <!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.2.0/addons/p5.sound.js"></script>-->
    <script>
        /*
 * @name Playback Rate
 * @description <p>Load a SoundFile and map its playback rate to
 * mouseY, volume to mouseX. Playback rate is the speed with
 * which the web audio context processings the sound file information.
 * Slower rates not only increase the duration of the sound, but also
 * decrease the pitch because it is being played back at a slower frequency.</p>
 * <p><em><span class="small"> To run this example locally, you will need the
 * <a href="http://p5js.org/reference/#/libraries/p5.sound">p5.sound library</a>
 * a sound file, and a running <a href="https://github.com/processing/p5.js/wiki/Local-server">local server</a>.</span></em></p>
 */
        // A sound file object
        // let mic;
        //
        // function setup() {
        //     createCanvas(710, 200);
        //
        //     // Create an Audio input
        //     mic = new p5.AudioIn();
        //
        //     // start the Audio Input.
        //     // By default, it does not .connect() (to the computer speakers)
        //     mic.start();
        // }
        //
        // function draw() {
        //     background(200);
        //
        //     // Get the overall volume (between 0 and 1.0)
        //     let vol = mic.getLevel();
        //     fill(127);
        //     stroke(0);
        //
        //     // Draw an ellipse with height based on volume
        //     let h = map(vol, 0, 1, height, 0);
        //     ellipse(width / 2, h - 25, 50, 50);
        // }

        let mySound;
        function preload() {
            soundFormats('mp3', 'ogg');
            mySound = loadSound('huyhat.wav');
        }

        function setup() {
            let cnv = createCanvas(100, 100);
            cnv.mousePressed(canvasPressed);
            background(220);
            text('tap here to play', 10, 20);
        }

        function canvasPressed() {
            // playing a sound file on a user gesture
            // is equivalent to `userStartAudio()`

            reverb = new p5.Reverb();
            // soundFile.disconnect(); // so we'll only hear reverb...

            // connect soundFile to reverb, process w/
            // 3 second reverbTime, decayRate of 2%
            reverb.process(mySound, 3, 2);
            mySound.play();
        }
        // function preload() {
        //     soundFormats('mp3', 'ogg');
        //     mySound = loadSound('re.mp3');
        //     mySound.play();
        // }
        // function play_sound() {
        //     mySound.play();
        // }
        //
        // function setup() {
        //     let cnv = createCanvas(100, 100);
        //     cnv.mousePressed(canvasPressed);
        //     background(220);
        //     text('tap here to play', 10, 20);
        // }
        //
        // function canvasPressed() {
        //     // playing a sound file on a user gesture
        //     // is equivalent to `userStartAudio()`
        //     mySound.play();
        // }

        // let song;
        //
        // function preload() {
        //     // Load a sound file
        //     song = loadSound('FILE_20210901_234224_recording-20210901-234018.mp3');
        // }
        //
        // function setup() {
        //     createCanvas(710, 400);
        //
        //     // Loop the sound forever
        //     // (well, at least until stop() is called)
        //     song.loop();
        // }
        //
        // function draw() {
        //     background(200);
        //
        //     // Set the volume to a range between 0 and 1.0
        //     let volume = map(mouseX, 0, width, 0, 1);
        //     volume = constrain(volume, 0, 1);
        //     song.amp(volume);
        //
        //     // Set the rate to a range between 0.1 and 4
        //     // Changing the rate alters the pitch
        //     let speed = map(mouseY, 0.1, height, 0, 2);
        //     speed = constrain(speed, 0.01, 4);
        //     song.rate(speed);
        //
        //     // Draw some circles to show what is going on
        //     stroke(0);
        //     fill(51, 100);
        //     ellipse(mouseX, 100, 48, 48);
        //     stroke(0);
        //     fill(51, 100);
        //     ellipse(100, mouseY, 48, 48);
        // }
    </script>
</head>
<body>
    <button onclick="play_sound()">ok</button>
<!--    <source src="users/video/1176460198/ncgb.mp4" type="video/mp4">-->
    <!--    <source src="users/video/1176460198/ncgb.mp4" type="video/ogg">-->
<!--    <track src="users/video/1176460198/ncgb.mp4" kind="subtitles" srclang="en" label="English">-->
    <!--    <track src="users/video/1176460198/ncgb.mp4" kind="subtitles" srclang="no" label="Norwegian">-->

</body>
</html>
