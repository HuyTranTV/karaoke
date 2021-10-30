<?php
require 'cn.php';
session_start();
if($id=$_SESSION['id']){


$id=$_SESSION['id'];
$get_name="SELECT `ID_USER`, `HOTEN_USER`, `SDT_USER`, `EMAIL_USER`, `hinhanh` FROM `user` WHERE ID_USER='$id'";
$result_name=mysqli_query($link,$get_name);
if(mysqli_num_rows($result_name)){
    $rows1=mysqli_fetch_assoc($result_name);
    $name=$rows1['HOTEN_USER'];
    $img=$rows1['hinhanh'];
}

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My_Record</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.2.0/p5.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.2.0/addons/p5.sound.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="my_record.css">
    <!-- Font Awesome JS -->
<!--    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>-->
<!--    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>-->

<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<script>


    let mySound;

    function preload() {
        mySound = loadSound('huyhat.wav');
    }
    // function get_song(mys) {
    //     mySound = loadSound(mys);
    //     reverb = new p5.Reverb();
    //     // soundFile.disconnect(); // so we'll only hear reverb...
    //
    //     // connect soundFile to reverb, process w/
    //     // 3 second reverbTime, decayRate of 2%
    //     reverb.process(mySound, 3, 2);
    //     mySound.play();
    // }





</script>
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
    <script type="module">
        // Import the functions you need from the SDKs you need
        import { initializeApp } from "https://www.gstatic.com/firebasejs/9.0.0/firebase-app.js";

        // TODO: Add SDKs for Firebase products that you want to use
        // https://firebase.google.com/docs/web/setup#available-libraries

        // Your web app's Firebase configuration
        const firebaseConfig = {
            apiKey: "AIzaSyA8-UUMvVAU4eCTOCV7EH_L1vHbzMimHqw",
            authDomain: "karaoke-project-59267.firebaseapp.com",
            databaseURL: "https://karaoke-project-59267-default-rtdb.asia-southeast1.firebasedatabase.app",
            projectId: "karaoke-project-59267",
            storageBucket: "karaoke-project-59267.appspot.com",
            messagingSenderId: "801453998869",
            appId: "1:801453998869:web:a7f63e28fd44bb0cfadf1c"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);

        import { getDatabase,remove,push,update, ref,onValue, set, child, get,onChildAdded,limitToFirst, onChildChanged, onChildRemoved } from "https://www.gstatic.com/firebasejs/9.0.0/firebase-database.js";
        function getmyid() {
            var a= document.cookie.split(';');
            for(var i=0; i<a.length;i++){
                if(a[i].indexOf("id")==1){
                    var iduser=a[i].split("=");

                    return iduser[1];
                }else{

                }
            }
        }
        function isset(_var){
            return !!_var; // converting to boolean.
        }
        function get_record_mxh(){

            var myid=<?php echo"$id" ?>;
            const dbRef = ref(getDatabase());
            get(child(dbRef, `users/`+myid)).then((snapshot) => {
                if (snapshot.exists()) {
                    var str="";
                    snapshot.forEach(function (childkey){
                        var key_baiviet=childkey.key;

                        get(child(dbRef, `users/`+myid+'/'+key_baiviet)).then((snapshot1) => {
                            if (snapshot1.val().record_url!='no_link_record') {
                                var record_url=snapshot1.val().record_url;
                                var name_record=record_url.slice(record_url.lastIndexOf('/')+1,record_url.length);
                                var date=" ";
                                if(isset(snapshot1.val().date)){
                                    date= "<p style=\"text-align: center\"> "+snapshot1.val().date+"</p>\n";


                                }
                                console.log(snapshot1.val());
                                var strhtml=" <div class=\"record\" >\n" +date+
                                    // "        <p style=\"text-align: center\"> "+date1+"</p>\n" +
                                    "        <h5 style=\"text-align: center\">"+name_record+"</h5>\n" +
                                    "        <audio controls style=\"width: 90%\">\n" +
                                    "            <source src="+record_url+">\n" +
                                    "        </audio>\n" +
                                    "        <button type=\"button\" class=\"btn btn-danger \" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">\n" +
                                    "            Auto tune\n" +
                                    "        </button>\n" +
                                    "    </div>";
                                str=str+strhtml;
                                document.getElementById('hien-thi-san-pham').innerHTML=str;


                            } else {
                                console.log("No record");
                            }
                        }).catch((error) => {
                            console.error(error);
                        });
                    })



                } else {
                    console.log("No data available");
                }
            }).catch((error) => {
                console.error(error);
            });
        }
        window.get_record_mxh=get_record_mxh;
        function get_record_chat(){

            var myid=<?php echo"$id" ?>;
            const dbRef = ref(getDatabase());
            get(child(dbRef, `chat`)).then((snapshot) => {
                if (snapshot.exists()) {
                    var str="";

                    snapshot.forEach(function (childkey){
                        var room_chat=childkey.key;
                        if(childkey.key.search(myid) > 0){

                            get(child(dbRef, `chat/`+room_chat)).then((snapshot1) => {

                                snapshot1.forEach(function (childkey1){
                                    var idchat=childkey1.key;
                                        get(child(dbRef, `chat/`+room_chat+'/'+idchat)).then((snapshot2) =>{
                                            console.log(snapshot2.val().audio);
                                            if (snapshot2.val().audio!='') {
                                                var record_url=snapshot2.val().audio;
                                                var name_record=record_url.slice(record_url.lastIndexOf('/')+1,record_url.length);
                                                var date=" ";
                                                if(isset(snapshot2.val().date)){
                                                    date= "<p style=\"text-align: center\"> "+snapshot1.val().date+"</p>\n";


                                                }
                                                // console.log(snapshot2.val());
                                                var strhtml=" <div class=\"record\" >\n" +date+
                                                    // "        <p style=\"text-align: center\"> "+date1+"</p>\n" +
                                                    "        <h5 style=\"text-align: center\">"+name_record+"</h5>\n" +
                                                    "        <audio controls style=\"width: 90%\">\n" +
                                                    "            <source src="+record_url+">\n" +
                                                    "        </audio>\n" +
                                                    "        <button type=\"button\" class=\"btn btn-danger \" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">\n" +
                                                    "            Auto tune\n" +
                                                    "        </button>\n" +
                                                    "    </div>";
                                                str=str+strhtml;
                                                document.getElementById('hien-thi-san-pham').innerHTML=str;


                                            } else {
                                                console.log("No record");
                                            }
                                        })


                                })

                            }).catch((error) => {
                                console.error(error);
                            });

                        }else {

                        }


                    })



                } else {
                    console.log("No data available");
                }
            }).catch((error) => {
                console.error(error);
            });
        }
        window.get_record_chat=get_record_chat;
        
        // function get_record_upload(){
        //     location.reload()
        // }
        document.getElementById('opendel').onclick=function () {
        // document.getElementById('btn-delete').style.display='block';
        // document.getElementById('opendel').style.dislay='none';
            var str="<input id='btn-delete' class='btn btn-dark' type='submit' value='Xác nhận xóa' style=' font-style: italic;' >";

            document.getElementById('box-btn-delete').innerHTML=str;
            var elems = document.getElementsByClassName('container');
            for (var i=0;i<elems.length;i+=1){
                elems[i].style.display = 'block';
            }

        }
        function autotune(id,name) {
            alert("Đợi mình xíu...");
            var tone=document.getElementById('tone').value;
            var b=name.indexOf(".");
            var song=name.substring(0,b);
            $.ajax({
                url: 'autotune.php', // point to server-side PHP script
                type: 'post',
                data:{
                    id:id,
                    name:song,
                    tone:tone
                },
                success: function(php_script_response){

                    document.getElementById(name).innerHTML=php_script_response;


                }
            });


        }
        window.autotune=autotune;



    </script>
</head>

<body>

<div class="wrapper" id="danhmucluachon">
    <!-- Sidebar Holder -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <a href="interface_mxh.php?iduser=<?php echo $_SESSION['id'] ?>"><img src="<?php echo"$img" ?>" style="width: 100px; height: 100px; border-radius: 50px; text-align: center"></a>
            <h3><?php echo "$name" ?> </h3>
        </div>

        <ul class="list-unstyled components">
            <p>Tất cả ghi âm</p>

            <li>
                <a href="my_record.php" >Đã tải lên</a>
            </li>
            <li>
                <a href="#" onclick="get_record_mxh();">Trong Dòng Thời Gian</a>
            </li>
            <li>
                <a href="#" onclick="get_record_chat();">Trong đoạn tin nhắn </a>
            </li>

        </ul>

        <ul class="list-unstyled CTAs">
            <li>
                <a href="index.php" class="download">Trang chủ</a>
            </li>
            <li>
                <a href="interface_mxh.php?iduser=<?php echo $_SESSION['id'] ?>" class="article">Home</a>
            </li>
        </ul>
    </nav>

    <!-- Page Content Holder -->
    <div id="content">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="navbar-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-align-justify"></i>
                </button>

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
                            <form action="record_upload.php" method="post" enctype='multipart/form-data'>
                                <input type="file" name="file[]" id="file" aria-label="File browser example"  accept=".mp3, .wav " multiple="multiple">
                                <input type="submit" value="send">
                            </form>

                            <span class="file-custom"></span>
                        </label>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="hien-thi-san-pham">
<!--            <div class="record" >-->
<!--                <p style="text-align: center"> 10/5/2021</p>-->
<!--                <h5 style="text-align: center">name</h5>-->
<!--                <audio controls style="width: 90%">-->
<!--                    <source src="yeumotnguoikara.mp3">-->
<!--                </audio>-->
<!--                <button type="button" class="btn btn-danger " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
<!--                    Auto tune-->
<!--                </button>-->
<!--            </div>-->
            <?php

            $sql="SELECT `ID_RECORD`, `ID_USER`, `LINK`, `Name`, `NGAY_DANG` FROM `record` WHERE ID_USER='$id' ORDER BY NGAY_DANG";
            $result=mysqli_query($link,$sql);
            echo "<form action='delete_my_record.php' method='post'>";
            echo "<div id='box-btn-delete'>
                    <button id='opendel' >Xóa</button>
                    <input id='btn-delete' class='btn btn-dark' type='submit' value='Xác nhận xóa' style='font-style: italic; display: none' ></div>";
            if(mysqli_num_rows($result)>0)
            {
                while ($rows=mysqli_fetch_assoc($result)){
                    $date=$rows['NGAY_DANG'];
                    $id_record=$rows['ID_RECORD'];
                    $link_record=$rows['LINK'];
                    $name=$rows['Name'];

                    echo " <div class=\"record\" >
                <p style=\"text-align: center\"> ".$date."</p>
                <h5 style=\"text-align: center\">".$name."</h5>
                <div class='info-record' style='display: flex; flex-direction: row;margin-bottom: 10px'>
                        <audio controls style=\"width: 90%\">
                            <source src=".$link_record.">
                        </audio>
                        <label class=\"container\"  >
                              <input type=\"checkbox\" value='$id_record' name=\"checkbox[]\">
                              <span class=\"checkmark\"></span>
                        </label>
                </div>
                 <a class='eff' style=\"margin: 5px; border-radius: 10px ;background:url('img/bg_play.jpg');color: whitesmoke;text-decoration: none; width: 200px; height: 100px;padding: 7px\" href='play_sound.php?link=$link_record' >
               <span class=\"material-icons\">
            face_retouching_natural
            </span>
                Effect
                </a>
                ";
                    if(strpos($name,".wav")==true){
                        echo "
                    
            
                <button onclick=\"autotune('$id_record','$name')\" type=\"button\" class=\"btn btn-danger \" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                    Auto tune
                </button>
                <select id='tone'>        
                    <option>Amin</option>
                    <option>A#min</option>
                    <option>Bmin</option>
                    <option>Bbmin</option>
                    <option>Cmin</option>
                    <option>C#min</option> 
                    <option>Dmin</option>
                    <option>Dbmin</option>
                    <option>D#min</option>
                    <option>Emin</option>
                    <option>F#min</option>
                    <option>Fmin</option>
                    <option>Gmin</option>
                    <option>Gbmin</option>
                    <option>G#min</option>
                    <option>------</option>
                    <option>Amaj</option>
                    <option>Abmaj</option>
                    <option>A#maj</option>
                    <option>Bmaj</option>
                    <option>Bbmaj</option>
                    <option>Cmaj</option>
                    <option>C#maj</option>             
                    <option>Dmaj</option>
                    <option>D#maj</option>
                    <option>Emaj</option>
                    <option>Ebmaj</option>
                    <option>Fmaj</option>
                    <option>F#maj</option>
                    <option>Gmaj</option>
                    <option>Gbmaj</option>
                    <option>G#maj</option>
                </select>
                <div class='show_auto' id='$name'></div>
            </div>";
                }
                }
            }
            echo "</form>";
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





