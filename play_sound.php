<?php

$link_song='upload_my_record/'.$_GET['link'];

require 'cn.php';
session_start();
if ($id = $_SESSION['id']){


$id = $_SESSION['id'];
$get_name = "SELECT `ID_USER`, `HOTEN_USER`, `SDT_USER`, `EMAIL_USER`, `hinhanh` FROM `user` WHERE ID_USER='$id'";
$result_name = mysqli_query($link, $get_name);
if (mysqli_num_rows($result_name)) {
    $rows1 = mysqli_fetch_assoc($result_name);
    $name = $rows1['HOTEN_USER'];
    $img = $rows1['hinhanh'];
}


//$link_song="upload_my_record/huyhat.wav";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PLAY</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.2.0/p5.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.2.0/addons/p5.sound.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">

    <script>
    window.play=play;

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
    <link rel="stylesheet" href="my_record.css">

    <style>
        #sidebar{
            background-color: black;
            color: white;
        }

        #sidebar .list-unstyled .active li a{
            background-color: white;
            color: black;
            text-decoration: none;
        }
        #sidebar .list-unstyled .active .dropdown-toggle{
            background-color: yellow;
            color: black;

        }
        #sidebar .list-unstyled .active #homeSubmenu{
            background-color: yellow;
            color: white;
            text-decoration: none;
        }
        #sidebar .list-unstyled li .dropdown-toggle{
            background-color:yellow;
            color: black;
            text-decoration: none;
        }
        #sidebar .list-unstyled  li #pageSubmenu li a{
            background-color: white;
            color: black;
            text-decoration: none;
        }
        #sidebar .list-unstyled  li a{
            background-color: yellow;
            color: black;
            text-decoration: none;
        }
        #price-level .dropdown-item:hover{
            background-color: red;
            font-weight:bold ;
            color: white;
        }
        .nav-item{
            margin-right: 70px;
        }
        #hien-thi-san-pham .card{
            float: left;
            width: 24%;
            margin-left: 1%;
            margin-bottom: 2%;
        }
        @media (max-width: 1200px) {
            #hien-thi-san-pham .card{
                width: 48%;
                margin-left: 1%;
                margin-bottom: 2%;

            }
        }
        #hien-thi-san-pham{
            display: flex;
            flex-direction: column;
        }
        .record{
            width: 100%;
            min-height: 10px;
            border-bottom: 1px solid yellow;
            border-radius: 20px;
            margin-bottom: 10px;
        }
        .container {

            position: relative;
            font-style: italic;
            display: none;
            margin-top: 12px;
            cursor: pointer;
            font-size: 22px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            width: 10%;
        }

        /* Hide the browser's default checkbox */
        .container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        /* Create a custom checkbox */
        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: red;
            opacity: 1;
        }

        /* On mouse-over, add a grey background color */
        .container:hover input ~ .checkmark {
            background-color: #ccc;
        }

        /* When the checkbox is checked, add a blue background */
        .container input:checked ~ .checkmark {
            background-color: #2196F3;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the checkmark when checked */
        .container input:checked ~ .checkmark:after {
            display: block;
        }


        /* Style the checkmark/indicator */
        .container .checkmark:after {
            left: 9px;
            top: 5px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }
        #opendel {
            background-color: white;
            color: black;
            border: 2px solid red;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
        }

        #opendel:hover {
            background-color:black; /* Green */
            color: white;
        }
        .show_auto{
            display: flex;
            text-align: center;
            flex-direction: row;
        }
        .eff:hover{
            font-size: 30px;
        }


    </style>
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



<!--    <source src="users/video/1176460198/ncgb.mp4" type="video/mp4">-->
<!--    <source src="users/video/1176460198/ncgb.mp4" type="video/ogg">-->
<!--    <track src="users/video/1176460198/ncgb.mp4" kind="subtitles" srclang="en" label="English">-->
<!--    <track src="users/video/1176460198/ncgb.mp4" kind="subtitles" srclang="no" label="Norwegian">-->





<div class="wrapper" id="danhmucluachon">
    <!-- Sidebar Holder -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <a href="interface_mxh.php?iduser=<?php echo $_SESSION['id'] ?>"><img src="<?php echo"$img" ?>" style="width: 100px; height: 100px; border-radius: 50px; text-align: center"></a>
            <h3><?php echo "$name" ?> </h3>
        </div>

        <ul class="list-unstyled components">
            <p style="color: #5A83BC"><span class="material-icons">
menu_open
</span></p>

            <li>
                <a href="my_record.php" ><span class="material-icons">
library_music
</span>
                    Danh sách bài hát</a>
            </li>
<!--            <li>-->
<!--                <a href="#" onclick="get_record_mxh();">Trong Dòng Thời Gian</a>-->
<!--            </li>-->
<!--            <li>-->
<!--                <a href="#" onclick="get_record_chat();">Trong đoạn tin nhắn </a>-->
<!--            </li>-->

        </ul>

        <ul class="list-unstyled CTAs">
            <li>
                <a href="index.php" class="download"><span class="material-icons">
home
</span>
                </a>
            </li>
            <li>
                <a href="interface_mxh.php?iduser=<?php echo $_SESSION['id'] ?>" class="article"><span class="material-icons">
account_circle
</span></a>
            </li>
        </ul>
    </nav>

    <!-- Page Content Holder -->
    <div id="content">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid" style="display: flex; flex-direction: row">

                <button type="button" id="sidebarCollapse" class="navbar-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
<!--                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">-->
<!--                    <i class="fas fa-align-justify"></i>-->
<!--                </button>-->

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                        <!--                        <li class="nav-item active">-->
                        <!--                            <div class="btn-group">-->
                        <!--                                <button type="button" class="btn btn-danger " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                        <!--                                    Lọc theo tháng-->
                        <!--                                </button>-->
                        <!--                                <div class="dropdown-menu" id="price-level">-->
                        <!--                                    <a class="dropdown-item" href="#"> Tháng này </a>-->
                        <!--                                    <a class="dropdown-item" href="#"> 1 </a>-->
                        <!--                                    <a class="dropdown-item" href="#"> 2 </a>-->
                        <!--                                    <a class="dropdown-item" href="#"> 3 </a>-->
                        <!--                                    <a class="dropdown-item" href="#"> 4 </a>-->
                        <!--                                    <a class="dropdown-item" href="#"> 5 </a>-->
                        <!--                                    <a class="dropdown-item" href="#"> 6 </a>-->
                        <!--                                    <a class="dropdown-item" href="#"> 7 </a>-->
                        <!--                                    <a class="dropdown-item" href="#"> 8 </a>-->
                        <!--                                    <a class="dropdown-item" href="#"> 9 </a>-->
                        <!--                                    <a class="dropdown-item" href="#"> 10 </a>-->
                        <!--                                    <a class="dropdown-item" href="#"> 11 </a>-->
                        <!--                                    <a class="dropdown-item" href="#"> 12 </a>-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                        </li>-->
                        <!--                        <li class="nav-item active">-->
                        <!--                            <div class="btn-group">-->
                        <!--                                <button type="button" class="btn btn-danger " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                        <!--                                   2021-->
                        <!--                                </button>-->
                        <!--                                <div class="dropdown-menu" id="thuonghieu">-->
                        <!--                                    <a class="dropdown-item" href="#"> 2020</a>-->
                        <!--                                    <a class="dropdown-item" href="#"> Thuong hieu A </a>-->
                        <!--                                    <a class="dropdown-item" href="#"> Thuong hieu A </a>-->
                        <!--                                    <a class="dropdown-item" href="#"> Thuong hieu A </a>-->
                        <!---->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                        </li>-->
                        <label class="file">
                            <?php echo "<b><span class=\"material-icons\">
library_music
</span>
".$_GET['link']. "</b>" ;?>
                        </label>
                    </ul>
                </div>
            </div>
        </nav>


        <?php
        if(isset($_GET['link'])==true){
            echo " <div id=\"hien-thi-san-pham\">";
?>
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

            <?php
            echo "</div>";
        }

        else{
            echo " <div id=\"hien-thi-san-pham\">";
            echo "no";
            echo"</div>";
        }
        }
        ?>

    </div>

</div>
</div>

<!-- jQuery CDN - Slim version (=without AJAX) -->
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
            $(this).toggleClass('active');
        });
    });
</script>
</body>
</html>
