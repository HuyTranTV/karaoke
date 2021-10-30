<?php

$link_song=$_GET['link'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PLAY</title>
    <!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.4.0/p5.min.js"></script>-->
    <!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.4.0/p5.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.2.0/p5.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.2.0/addons/p5.sound.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
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
        var fft;
        var particles=[];
        var img;
        function preload() {

            var link='<?php echo "$link_song" ?>';

            mySound = loadSound(link);
            img = loadImage('img/bg_play.jpg');

        }

        function setup() {


            fft=new p5.FFT();
            createCanvas(1200,500);
            angleMode(DEGREES);
            imageMode(CENTER);
            draw();
            document.getElementById("reate_verb").onclick = function(){

                vang();
            }

            document.getElementById("reate_cat").onclick = function(){
                cat();


            }

            document.getElementById("reate_dog").onclick = function() {
                dog();
            }

            document.getElementById("stop_ef").onclick = function(){
                stop_effect();

            }

        }

        let reverb = new p5.Reverb();
        function play() {
        mySound.play();
            document.getElementById("play_sound").innerHTML="<button onclick='stop()' id=\"none-play\" style=\"background-color: #00A1D3;border: 0px; height: 30px;width: 200px;color: whitesmoke\"><span class=\"material-icons\">\n" +
                "pause_circle_filled\n" +
                "</span>Play</button>";
        }
        function stop() {
          mySound.pause();
            document.getElementById("play_sound").innerHTML="<button onclick='play()' id=\"play\" style=\"background-color: #00A1D3;border: 0px; height: 30px;width: 200px;color: whitesmoke\"><span class=\"material-icons\">\n" +
                "play_circle_filled\n" +
                "</span>Play</button>";


        }
        function vang() {
            // playing a sound file on a user gesture
            // is equivalent to `userStartAudio()`


            // soundFile.disconnect(); // so we'll only hear reverb...

            // connect soundFile to reverb, process w/
            // 3 second reverbTime, decayRate of 2%
            reverb.process(mySound, 3, 2);

        }
        function khongvang() {
            reverb.process(mySound, 1, 1);

        }
        function cat() {
            mySound.rate(1.5);


        }
        function stop_cat() {
            mySound.rate(1);

        }
        function dog() {
            mySound.rate(0.75);


        }
        function stop_effect() {
            mySound.rate(1);
            reverb.process(mySound, 1, 1);

        }

        function draw(){
           // background(0);
           // stroke(255)
           //  var wave=fft.waveform();
           //  for(var i=0; i< 400;i++){
           //      var index=floor(map(i,0,400,wave.length-1));
           //
           //      var x=i;
           //      var y=wave[index]*150*300;
           //      point(x,y);
           //  }

            var waveform=fft.waveform();
            stroke(255);
            strokeWeight(3);
            background(0);
            noFill();
            translate(600,250);
            fft.analyze();
            amp=fft.getEnergy(20,200);
            image(img,0,0,1400,500);
            for(var t=-1;t<=1;t+=2){
                beginShape();
                for(var i=0; i<=180;i+=0.5){
                    var index=floor(map(i,0,180,0,waveform.length-1));
                    var r= map(waveform[index],-1,1,100,300);
                    var x=r*sin(i)*t;
                    var y=r*cos(i);
                    vertex(x,y);
                }
                // for( var i=0; i<waveform.length;i++){
                //     var x= map(i,0,waveform.length,0, width)*sin(i);
                //     var y= map(waveform[i],-1,1,0,height)*cos(i);
                //     vertex(x,y)
                // }
                endShape();
            }
            var p=new Particle();
            particles.push(p);
            console.log(p);
            console.log(particles.length);
            for(var i=0;i<particles.length;i++){
                if(!particles[i].edges()){
                    particles[i].update(amp>230);
                    particles[i].show();
                }else{
                    particles.splice(i,1);
                }

            }


        }
        class Particle{
            constructor() {
                this.pos=p5.Vector.random2D().mult(200);
                this.vel=createVector(0,0);
                this.acc=this.pos.copy().mult(random(0.0001,0.00001));
                this.w=random(3,5);
                this.color=[random(200,255),random(200,255),random(200,255),]
            }
            update(cond){
                this.vel.add(this.acc);
                this.pos.add(this.vel);
                if(cond){
                    this.pos.add(this.vel);
                    this.pos.add(this.vel);
                    this.pos.add(this.vel);
                }
            }
            edges(){
                if(this.pos.x <= -600 || this.pos.x >= 600 || this.pos.y <= -250|| this.pos.y >= 250){
                    return true;
                }else{
                    return false;
                }
            }
            show(){
                    noStroke();
                    fill(this.color);

                    ellipse(this.pos.x,this.pos.y,4);

            }
        }

    </script>
    <style>
      #play_sound,#verb_sound,#cat_sound,#dog_sound,normal_sound{
          width: 25%;
          height: 40px;
      }
        #effect{
            display: flex;
            flex-direction: row;
        }
    </style>
</head>
<body style="background: url('img/bg_play.jpg'); text-align: center"; >
<div id="play_sound" >
      <button id="play" onclick="play()" style="background-color: #00A1D3;border: 0px; height: 30px;width: 200px;color: whitesmoke"><span class="material-icons">
        play_circle_filled
        </span>Play</button>
</div>
<div id="effect">

    <div id="verb_sound">
        <button id="reate_verb" style="background-color: red;border: 0px; height: 30px;width: 200px;color: whitesmoke" ><span class="material-icons">
monitor_heart
</span>Verb</button>
    </div>
    <div id="cat_sound">
        <button id="reate_cat" style="background-color: orange;border: 0px; height: 30px;width: 200px;color: whitesmoke"><span class="material-icons">
pets
</span>Cat</button>
    </div>
    <div id="dog_sound">
        <button id="reate_dog" style="background-color: yellow;border: 0px; height: 30px;width: 200px;color: black"><span class="material-icons">
            pets</span>Dog</button>
    </div>
    <div id="normal_sound">
        <button id="stop_ef" style="background-color: greenyellow;border: 0px; height: 30px;width: 200px;color: black"><span class="material-icons">
gpp_bad
</span>Normal</button>
    </div>
</div>
<main ></main>


<!--    <source src="users/video/1176460198/ncgb.mp4" type="video/mp4">-->
<!--    <source src="users/video/1176460198/ncgb.mp4" type="video/ogg">-->
<!--    <track src="users/video/1176460198/ncgb.mp4" kind="subtitles" srclang="en" label="English">-->
<!--    <track src="users/video/1176460198/ncgb.mp4" kind="subtitles" srclang="no" label="Norwegian">-->

</body>
</html>
