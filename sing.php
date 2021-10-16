<?php
ob_start();
require 'cn.php';
$me="0";
if(isset($_COOKIE['id'])){
    $me=$_COOKIE['id'];
}

if(isset($_COOKIE['userwatch'])){
    unset($_COOKIE['userwatch']);
    setcookie('userwatch', null, -1, '/');
}else{

}
if(isset($_COOKIE['status'])){
    unset($_COOKIE['status']);
    setcookie('status', null, -1, '/');
}else{

}

if(isset($_GET['id'])&&isset($_GET['name'])&&isset($_GET['img'])){
    $idvideo=$_GET['id'];
    $name=$_GET['name'];
    $img=$_GET['img'];
    setcookie("idvideo", $me."-".$idvideo, time() + 6000000, "/");
    $sql4="INSERT INTO `video`(`ID_VIDEO`, `NAME_VIDEO`, `HINHANH_VIDEO`, `HOT`) VALUES ('$idvideo','$name','$img','1')";
    if($result4=mysqli_query($link,$sql4)){
        $sql7="INSERT INTO `user_xem_video`(`ID_USER`, `ID_VIDEO`) VALUES ('$me','$idvideo')";
        if($result7=mysqli_query($link,$sql7)){

        }else{

        }
    }
    else{
        $sql5="SELECT `HOT` FROM `video` WHERE `ID_VIDEO`='$idvideo'";
        if($result5=mysqli_query($link,$sql5)){
            $rows5=mysqli_fetch_assoc($result5);
            $luotxem=$rows5['HOT'];
            $luotxem=$luotxem+1;
            $sql6="UPDATE `video` SET `HOT`='$luotxem' WHERE `ID_VIDEO`='$idvideo'";
            if($result6=mysqli_query($link,$sql6)){
                    $sql7="INSERT INTO `user_xem_video`(`ID_USER`, `ID_VIDEO`) VALUES ('$me','$idvideo')";
                    if($result7=mysqli_query($link,$sql7)){

                    }else{

                }
            }else{

            }

        }
    }
}

setcookie("idvideo", $idvideo, time() + 60000000, "/");
$mecmtvideo=$me.";".$idvideo;
function get_ten_user($iduser){

    $link=$GLOBALS['link'];
    $sql3 = "SELECT * FROM `user` WHERE id_user='$iduser'";
    $result3 = mysqli_query($link, $sql3);
    if(mysqli_num_rows($result3)>0){
        $rows3=mysqli_fetch_assoc($result3);
        $ten=$rows3['HOTEN_USER'];

        return $ten;
    }
}

function get_cmt($video){
    $me=$GLOBALS['me'];
    $link=$GLOBALS['link'];
    $video=$GLOBALS['idvideo'];
    $mecmtvideo=$me.";".$video;
    $sql1 = "SELECT * FROM `comment` WHERE id_video='$video'ORDER BY ngay_cmt ASC";
    $result1 = mysqli_query($link, $sql1);
    if(mysqli_num_rows($result1)>0){
        while ($rows1 = mysqli_fetch_array($result1)) {
            $idcmt=$rows1['ID_CMT'];
            $iduser=$rows1['ID_USER'];
            $tenuser=get_ten_user($iduser);

            echo "<div class='comment-user'>
                    <a id='username' style='text-decoration: none; font-weight: bold; color: black' href='interface_mxh.php?iduser=$iduser'>".get_ten_user($rows1['ID_USER'])."</a>
                    <p class='comment-content' id='content'>".$rows1['NOIDUNG']."</p>
                    
                    <div class='status'>
                        <p>".$rows1['NGAY_CMT']."</p>
                        <button class='rep-cmt' id='".$iduser."' value='".$tenuser."'  onclick='comment(".$idcmt.",".$iduser.",".$me.")'>Trả lời</button>
                    </div>";
                    echo get_rep_cmt($rows1['ID_CMT'],get_ten_user($rows1['ID_USER']))."
                </div>";
            
        }
    }
    echo "<div class='comment-user' id='box".$me."' style='display: none'>
                    <b id='username'><a href='#'>".get_ten_user($me)."</a></b>
                    <p class='comment-content' id='".$me."cmt'><a href='#'>@me: </a></p>
                    
                    <div class='status'>
                         <p>".date("Y-m-d H:i:s")."</p>
                    </div>
                </div>";

}
function get_rep_cmt($idcmt,$tenuser){


    $me=$GLOBALS['me'];
    $link=$GLOBALS['link'];
    $video=$GLOBALS['idvideo'];
    $sql2 = "SELECT * FROM `rep_cmt` WHERE  id_cmt='$idcmt' ORDER BY ngay_cmt ASC";
    $result2 = mysqli_query($link, $sql2);
    echo" <div class='rep-comment-user' id='box".$me."cmt".$idcmt."' style='display: none'>
                        <b id='rep-username'>".get_ten_user($me)."</b>
                        <p class='comment-content' id='".$me."cmt".$idcmt."'></p>
                         <div class='status'>
                        <p>".date("Y-m-d H:i:s")."</p>
                        </div>
                    </div>";

    if(mysqli_num_rows($result2)>0){


        while ($rows2=mysqli_fetch_assoc($result2)){
            $iduserrepcmt=$rows2['ID_USER'];
            echo" <div class='rep-comment-user'>
                        <a id='rep-username' style='text-decoration: none; font-weight: bold' href='interface_mxh.php?iduser=$iduserrepcmt'>".get_ten_user($rows2['ID_USER'])."</a>
                        <p class='comment-content' id='rep-comment'><a href='#'>@".$tenuser.": </a>".$rows2['NOIDUNG']."</p>
                         <div class='status'>
                        <p>".$rows2['NGAY_CMT']."</p>
                        </div>
                    </div>";

        }
    }


}
include 'index.php';
ob_end_flush();
?>
<!DOCTYPE html>
<div lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Karaoke</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.2.0/p5.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.2.0/addons/p5.sound.js"></script>
    <script type="text/javascript">

        function GetURLParameter(sParam) {
            var sPageURL = window.location.search.substring(1);
            var sURLVariables = sPageURL.split('&');
            for (var i = 0; i < sURLVariables.length; i++) {
                var sParameterName = sURLVariables[i].split('=');
                if (sParameterName[0] == sParam) {
                    return sParameterName[1];
                }
            }}
       var tech = GetURLParameter('id');

        // 2. This code loads the IFrame Player API code asynchronously.

        var tag = document.createElement('script');

        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        // 3. This function creates an <iframe> (and YouTube player)
        //    after the API code downloads.
        var player;
        function onYouTubeIframeAPIReady() {
            player = new YT.Player('player', {
                height: '500',
                width: '400',
                controls: '0',
                videoId: tech,
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange

                }
            });
        }

        // 4. The API will call this function when the video player is ready.
        function onPlayerReady(event) {

            event.target.playVideo();

        }

        // 5. The API calls this function when the player's state changes.
        //    The function indicates that when playing a video (state=1),
        //    the player should play for six seconds and then stop.
        var done = false;
        function onPlayerStateChange(event) {
            if (event.data == YT.PlayerState.PLAYING && !done) {
              //  setTimeout(stopVideo, 6000);
                done = true;
            }
        }



        function stopVideo() {
            player.stopVideo();
        }
        function pauseVideo() {
            player.pauseVideo();
        }
        function playVideo(speed) {


                player.playVideo();
                var i = Number(speed);
                player.setPlaybackRate(i);
                console.log("ok"+i+player.getAvailablePlaybackRates());
        }
        function reloadVideo(){
            player.loadVideoByUrl('http://www.youtube.com/v/'+tech+'?version=3',0);
        }

        // function setRateVideo(speed){
        //     player.setPlaybackRate(speed);
        // }

//---------------------------- APi AUDIO---------------------------------------------


        let mic,reconder,soundFile,fft;
        function setup(){

              let cnv = createCanvas(300,65);
            // cnv.mousePressed(userStartAudio);
            // textAlign(CENTER);
            mic = new p5.AudioIn();
            mic.start();
            fft = new p5.FFT();
            fft.setInput(mic);

            document.getElementById("stop").onclick = function(){
                mic.disconnect();

            }
            document.getElementById("start").onclick = function(){

                mic.connect();
                userStartAudio();
                // draw();

            }
            document.getElementById("record").onclick = function(){

                  userStartAudio();
                    reconder=new p5.SoundRecorder();
                    reconder.setInput();
                     reconder.setInput(mic);
                    soundFile=new p5.SoundFile();
                    reconder.record(soundFile);
                    reloadVideo();
                document.getElementById("stoprecord").style.display='block';
                document.getElementById("tenbaihat").style.display='none';


            }


            document.getElementById("stoprecord").onclick = function(){
                reconder.stop();
                pauseVideo();
                document.getElementById("playrecord").style.display='block';
                document.getElementById("boxspeed").style.display='block';

            }
            document.getElementById("playrecord").onclick = function(){
                 var speed=document.getElementById('speed').value;
                 console.log(speed);


                // soundFile.play();
                reloadVideo();
                pauseVideo();
                reverb = new p5.Reverb();
                // soundFile.disconnect(); // so we'll only hear reverb...

                // connect soundFile to reverb, process w/
                // 3 second reverbTime, decayRate of 2%
                reverb.process(soundFile, 3, 2);
                soundFile.rate(speed);

                // soundFile.play();
                soundFile.play();
          
                setTimeout(() => {
                    playVideo(speed);
                }, 500);

            }



            // function playSound() {
            //
            // }
                // soundFile.connect(nhac);



            document.getElementById("saverecord").onclick = function(){


                var cookie_save_file=document.cookie.split(";");
                var cookie_video=cookie_save_file[2].split("=");
                var cookie_me=cookie_save_file[1].split("=");
                var key = Math.random().toString(36).substr(2, 10);
                var namerecord=key+"-"+cookie_me[1]+"-"+cookie_video[1];
                // alert(namerecord);
                 saveSound(soundFile,namerecord);
            }





        }
        function draw(){

            var waveform=fft.waveform();
            stroke(255);
            strokeWeight(4);
            background(0);
           noFill();
           beginShape();
           for( var i=0; i<waveform.length;i++){
               var x= map(i,0,waveform.length,0, width);
               var y= map(waveform[i],-1,1,0,height);
               vertex(x,y)
           }
           endShape();


            // text('tap to start', width/2, 20);
            // micLevel = mic.getLevel();
            // let y = height - micLevel * height;
            // ellipse(width/2, y, 10, 10);
        }

    </script>

<script>


    function showcmt(){
        document.getElementById('choose-cmt').style.display='block';
        document.getElementById('choose-dexuat').style.display='none';
        document.getElementById('choose-cmt').style.animation="hiencontent-page ease 4s";
        document.getElementById('dexuat').style.border="0px";
        document.getElementById('cmt').style.border="1px solid blue";

       

    }
    function showdexuat() {
        document.getElementById('choose-cmt').style.display='none';
        document.getElementById('choose-dexuat').style.display='block';
        document.getElementById('dexuat').style.border="1px solid red";
        document.getElementById('cmt').style.border="0px";
    }
    var option=1;

        function hienlist_control(){
        option=option +1
        console.log(option);
        if(option%2==0){
            document.getElementById('list-play').style.marginLeft="0%";
            document.getElementById('list-play').style.animation='showcontrol ease 4s';
        }
        else{

            document.getElementById('list-play').style.animation='hidecontrol ease 4s';

            document.getElementById('list-play').style.marginLeft="-200%";



        }

    }


</script>
    <script type="text/javascript">

        var idcmt="fail";
        var me="mefail";
        var idvideo="none";
        var cmtcontent="none";

       function comment(idcmt,iduser,me) {
           idcmt=idcmt;
            me=me;

            location.href="#comment-box";
           var tenuser= document.getElementById(iduser).value;
           document.getElementById('comment-box').value='@'+tenuser+':';
           document.getElementById('tim1').onclick=function () {
               var mecmt=  document.getElementById('comment-box').value;
               var key=mecmt.indexOf(":");
               console.log(key);

               if(key != -1){
                   var processcmt=mecmt.split(':');
                   if(processcmt!=""){
                       if(processcmt[1] !=""){
                           $.ajax({
                               type: "POST",
                               url: 'insert_cmt.php',
                               data: {comment:processcmt[1],idcmt:idcmt,me:me},
                               success: function(response)
                               {

                                   console.log(response);
                                   document.getElementById('comment-box').value='';
                                   var divan=me+"cmt"+idcmt;

                                   var a="<a href='#'>@me: </a>";
                                    location.href="#"+divan;
                                   document.getElementById(divan).innerHTML=a;
                                   document.getElementById(divan).append(processcmt[1]);
                                   document.getElementById("box"+divan).style.display='block';
                                   document.getElementById("box"+divan).style.animation="doiback ease 4s";



                               }
                           });

                       }else{
                           alert("Bạn chưa nhập bình luận");

                       }
                   }else{
                       var x=document.cookie.split(";");
                       var cookie1=x[0].split("=");
                       var cookie2=x[1].split("=");

                       var mecmtvideo=cookie1[1]+";"+cookie2[1];
                       mecomment(mecmtvideo);
                   }
               }
                else {

                   var x=document.cookie.split(";");
                    var cookie1=x[1].split("=");
                   var cookie2=x[2].split("=");
                   var mecmtvideo=cookie1[1]+";"+cookie2[1];
                    mecomment(mecmtvideo);


               }



           }
       }
       function mecomment(mecmtvideo){
           cmtcontent=document.getElementById('comment-box').value;
           var processcmt=mecmtvideo.split(';');
           idvideo=processcmt[1];
           me=processcmt[0];
           $.ajax({
               type: "POST",
               url: 'insert_mecmt.php',
               data: {cmtcontent:cmtcontent,idvideo:idvideo,me:me},
               success: function(response)
               {

                   document.getElementById('comment-box').value='';
                   var divan=me+"cmt";
                   var a="<a href='#'>@me: </a>";
                    location.href="#"+divan;
                   document.getElementById(divan).innerHTML=a;
                   document.getElementById(divan).append(cmtcontent);
                   document.getElementById("box"+me).style.display='block';
                   document.getElementById("box"+me).style.animation="doiback ease 4s";


               }
           });
       }

    </script>
    <style>
        /*.video{*/
        /*    width: 100%;*/
        /*    height: 500px;*/
        /*}*/

        @media only screen and (max-width: 768px){
            /*#watch{*/
            /*    display: flex;*/
            /*    flex-direction: column;*/
            /*}*/
            /*#ssIFrame_google{*/
            /*    width: 400px;*/
            /*}*/
            /*#comment{*/
            /*    width: 100%;*/
            /*    margin: 0%;*/


            /*}*/

            #cmt-dexuat{
                display: flex;
                flex-direction: column;
                display: none;
            }

        }
        @keyframes hiencontent-page{
            from{

                background-color: silver;

            }to{
               background-color: white;
                         }
        }
        @keyframes doiback {
            from{
                background-color: black;
                display: block;
                border-radius: 20px;
            }to{
                 background-color: white;

             }

        }
        @keyframes showcontrol {
            from{

               margin-left: -200%;
            }to{
                margin-left:0%;

             }
        }
        @keyframes hidecontrol {
            from{
               margin-left: 0%;
            }to{
            margin-left:-200%;


              }
        }

        #player{
            float: left;
            width: 100%;

            position: relative;
            clear: left;
        }
        #list-play{
            margin: 0px;
            padding: 0px;
            margin-left: -200%;


        }

        #list-play #tenbaihat h1{
            font-size: 20px;
            font-style: italic;

        }
        #list-play #tenbaihat{
            width: 30%;
            color: white;

        }

        #list-play li{
            list-style: none;
            margin-left: 5%;
            width: 10%;
            float: left;
            text-align: center;
            font-weight: bold;
        }
        #list-play li:hover{
            font-size: 15px;
            text-shadow: 0.1em 0.2em 0.4em white;
        }
        #list-play li a{
            color: black;
            text-decoration: none;
            font-style: italic;
        }
        #comment{


            height: 500px;
            overflow-y: auto;
            text-align: left;
            margin-right: 1%;
        }
        #choose{
            width: 100%;

            height: 40px;
            display: flex;
            flex-direction: row;
        }
        #cmt{

            width: 50%;
            text-decoration: none;
            color: aliceblue;
            height: 40px;

        }
        #choose #dexuat{
            text-align: center;
            /*margin-left: 15%;*/
            width: 50%;
            text-decoration: none;
            border: 1px solid blue;
            font-weight: bold;



        }

        #choose-cmt{
            width: 100%;
            padding: 5px;
            border-radius: 10px;
            background-color:snow;
        }
        #choose-dexuat{
            display: flex;
            flex-direction: column;
        }
        .comment-user{
            width: 100%;
            background-color: white;
        }
        .comment-user .comment-content{

        }
        .rep-comment-user{
            margin-left: 10%;
        }
        #comment-box{
            width: 80%;
            float: left;
        }

        #control{
        width: 100%;



        }
        #watch{

        }
        #stoprecord{
            display: none;
        }
        #playrecord{
            display: none;
        }
        .dem{
            margin-top: 10px;
           padding: 0px;
            display: flex;
            flex-direction: row;

            width: 100%;



        }

        #hienlist-control{
            position: fixed;
            z-index: 100;
        }
        /*.layer{*/
        /*    background: bisque;*/

        /*    z-index: 1000;*/
        /*    position: absolute;*/
        /*}*/
        /*.layer img{*/
        /*    z-index: 1001;*/
        /*    margin-top: -140px;*/
        /*    opacity: 1;*/
        /*}*/

        .songname{
            font-size: 13px;
            color: black;
            font-weight: bold;
            text-align: center;
            font-style: italic;
            opacity: 0.4;
            text-decoration: none;
            width: 75%;
        }
        .songname:hover{
            text-decoration: none;
            opacity: 2;
            font-size: 14px;


        }
        .status{
            margin-top: -20px;
            width: 100%;
            text-align: right;

        }
        .status a{
            margin-left: 1rem;
            margin-right:1rem;
            font-weight: bold;
            color: silver;
            font-size: 14px;
        }
        .status p{
            font-size: 10px;
            color: burlywood;
            margin-bottom: 0px;
        }
        .comment-content{
            font-size: 13px;
            color: black;
            font-style: italic;
        }
        #tim1{
            margin-left: 2px;
            width: 15%;

        }
        .rep-cmt{
            border: none;
            background-color: white;
            font-size: 10px;
            font-weight: bold;
            color: gainsboro;

        }

        .imgvideo {
            width: 25%;
            background-color: red;


        }
        .imgvideo img{
              width: 100%;
            image-rendering: pixelated;
            object-fit: contain;


          }

        ::-webkit-scrollbar{
            width: 10px;
            background: silver;

        }
        main{
            text-align: center;
            background-color: black;
        }
        #cmt-dexuat{
            display: flex;
            flex-direction: column;
        }

    </style>



</head>

<?php ob_start(); $id=$_GET['id']; ob_end_flush()?>
<body id="content-page">
    <div class="container-flex" >
        <div id="control">
            <a href="#" id="hienlist-control" onclick="hienlist_control();"><span class="material-icons">
mic_none
</span>
            </a>

            <ul id="list-play">
                <li style="background: bisque"><a href="#" id="start"><span class="material-icons">
hearing
</span>
                    </a></li>
                <li style="background: cornflowerblue"><a href="#" id="stop"><span class="material-icons">
hearing_disabled
</span>
                    </a></li>
                <li style="background: lightcyan;color: red"><a href="#" id="record"><span style="color: red" class="material-icons">
radio_button_checked
</span>
                    </a></li>
                <li style="background: tomato"><a href="#" id="stoprecord"><span class="material-icons">
stop
</span>
                    </a></li>
                <li  id="boxspeed" style="display: none;color: white"><input type="number" id="speed"  max="2" value="1" min="0.25" step="0.25">X <span style="color: white" class="material-icons">
speed
</span>
                </li>

                <li style="background: black"><a style="color: aliceblue" href="#" id="playrecord"><span class="material-icons">
play_circle_filled
</span>
                    </a></li>
                <li style="background: lightgreen"><a href="#" id="saverecord"><span class="material-icons">
save
</span>
                    </a></li>

                <li id="tenbaihat"><h1><?php ob_start(); echo"$name"; ob_end_flush();?></h1></li>
            </ul>


        </div>
      <div id="watch">
          <div id="player"></div>
          <main></main>
      </div>
        <hr>
        <div id="cmt-dexuat" >
            <div id="comment">
                <!--            <div id="choose">-->
                <!--                <a id="cmt" href="#" onclick="showcmt();"><img src="img/icon-comment.png" width=50" height="35" style="border-radius: 20px"></a>-->
                <!--                <a id="dexuat" href="#" onclick="showdexuat();"><img src="img/icon-youtube.png" width=60" height="35" style="border-radius: 20px"></a>-->
                <!--            </div>-->
               <div style="text-align: center; width: 100%; background-color: lightcoral; padding: 10px">
                   <b>
                   <span class="material-icons">
                    try
                    </span>

                       Bài hát yêu thích
                   </b>
               </div>

                <hr>
                <div id="choose-dexuat">
                    <?php
                    ob_start();
                    $sql99 = "SELECT * FROM video as a , user_xem_video as b 
                    where a.ID_VIDEO=b.ID_VIDEO and b.ID_USER='$me' and a.ID_VIDEO<>'$idvideo'
                    ORDER BY HOT ASC";
                    if($result99=mysqli_query($link,$sql99)){
                        if(mysqli_num_rows($result99)>0){
                            while ($rows99=mysqli_fetch_assoc($result99)){
                                $hinhanh_dexuat=$rows99['HINHANH_VIDEO'];
                                $idvideo_dexuat=$rows99['ID_VIDEO'];
                                $tenvideo_dexuat=$rows99['NAME_VIDEO'];
                                echo "<div class='dem'>
                              
                                <a class='imgvideo'  href='sing.php?id=$idvideo_dexuat&&name=$tenvideo_dexuat&&img=$hinhanh_dexuat'><img  src='$hinhanh_dexuat'></a>
                                <a class='songname' href='sing.php?id=$idvideo_dexuat&&name=$tenvideo_dexuat&&img=$hinhanh_dexuat'>$tenvideo_dexuat</a>
                              
                                </div>";
                            }
                        }
                    }else{

                    }
                    ob_end_flush();
                    ?>

                </div>
            </div>
            <br>

            <div id="choose-cmt" >
                <div style="text-align: center; width: 100%; background-color: lightskyblue; padding: 10px">
                    <b>
                          <span class="material-icons">
                            comment
                          </span>
                        Comment
                    </b>
                </div>

                <div style="display: flex;flex-direction: row">
                    <input type="text" id="comment-box" class="form-control rounded" placeholder="Comment stay here" aria-label="Search"
                           aria-describedby="search-addon" />
                    <button type="button" id="tim1" class="btn btn-outline-primary" onclick="<?php echo"mecomment('$mecmtvideo')"; ?>" ><span style="color: blue" class="material-icons">
send
</span>
                    </button>

                </div>
                <?php
                ob_start();
                get_cmt($idvideo);
                ob_end_flush();
                ?>
                <hr>


            </div>

        </div>


    </div>

</body>

</div>

</html>
