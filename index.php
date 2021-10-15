<?php

session_start();
require 'cn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Title</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <style>
        @media only screen and (max-width: 768px) {
            #list{
               text-align: center;

            }
            .videos{
                margin-left: 40px;
            }
            .logo1 #img1{
                display: none;
            }
            #logo{
                margin-bottom: 20px;
            }

            
        }

        @keyframes hienlogo2{
           from{
                visibility: hidden;
               width: 0%;
           }
            to{
                visibility: visible;
                width: 48%;
            }
        }
        @keyframes hienlogo1{
            from{
               margin-left: -250px;

            }
            to{
               margin-left: 0px;

            }
        }
        @keyframes doimau{
            from{
                background-color: red;

            }
            to{
                background-color: white;

            }
        }
        @keyframes hienbutton{
            from{
                visibility: hidden;
                margin-right: 0%;

            }
            to{
                visibility: visible;
                margin-right: 20%;
            }
        }
        #logo{
            animation: hienlogo1 ease 2s;

           height: auto;
        }
        #logo .logo1{

        }
        #logo .logo1 #img1{
            image-rendering: pixelated;
            width: 200px;
            height: 100px;
            border-radius: 40px;
            float: left;

        }
        #logo .logo1 #img2{
            image-rendering: pixelated;
           width: 48%;
            height:100px ;
            border-radius: 40px;
            animation:hienlogo2 ease 4s;


        }
       #list{


           width: 100%;
       }
       .videos{

            margin-right: 10px;
            margin-top: 7px;
            height: 390px;
            width: 16rem;
            float: left;
        }

        #imgvideo img{
            image-rendering: pixelated;
            width: 16rem;
        }
        .videos:hover{
            background-color: silver;
        }

        #hinhanh{

        }
        #ketqua{
            text-align: center;
            opacity: 0.5;
            font-size: 17px;
            font-style: italic;

            width: 80%;
        }
        #titile{
        text-decoration: none;
        color: black;
        font-weight: bold;
        font-style: italic;

        }
        #search{
           animation: doimau ease 4s;
            margin-right: 1%;

            margin-left: 10%;

        }
        #tim{
            margin-right: 20%;

            animation: hienbutton ease 4s;

        }
        .input-group{
            width: 80%;



        }
        .container{

            text-align: center;
            width: 100%;
            display: flex;
            flex-direction: column;
        }
        .row{
            padding: 1px;
            margin: 0px;

            width: 100%;
        }
    </style>
    <script type="text/javascript">
        var HttpClient = function() {
            this.get = function(aUrl, aCallback) {
                var anHttpRequest = new XMLHttpRequest();
                anHttpRequest.onreadystatechange = function() {
                    if (anHttpRequest.readyState == 4 && anHttpRequest.status == 200)
                        aCallback(anHttpRequest.responseText);
                }

                anHttpRequest.open( "GET", aUrl, true );
                anHttpRequest.send( null );
            }
        }
        function tim() {
            // var key="AIzaSyBFcSQJYDgpYU6CkX4hu3ZtPv_6Y3xpTOE";

            // var url="https://www.googleapis.com/youtube/v3/search?";
            var search = document.getElementById("search").value;
            var karaoke=search+' karaoke';
            document.getElementById("ketqua").innerHTML=karaoke;
            var client = new HttpClient();
            var key=new Array();
            key[0]="AIzaSyBQbOO3y1eiEZY6l3eywfrloe5WkU5IRWU&q=";
            key[1]="AIzaSyCi2wGceAJg8SK5GZPwd-bK1qJZkUzzQco&q=";
            key[2]="AIzaSyCjIaAVLQDWHgOm2SmzNbaeK7s2_2mSwtE&q=";
            key[3]="AIzaSyD-9XRDBtpbeoh2bcCy5u4rrH532aqqJJ0&q=";
            var idkey=Math.floor(Math.random() * 4);
            client.get('https://www.googleapis.com/youtube/v3/search?part=snippet&&maxResults=10&&key='+key[idkey]+karaoke, function(response) {
                // do something with response
                // console.log(response);
               response=JSON.parse(response);
                 $("#list").html(" ");

                response.items.forEach( item => {
                    // var video = `<iframe class="video" width="300" height="250" src="https://www.youtube.com/embed/${item.id.videoId}" frameborder="1" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
                    // console.log(item.snippet.thumbnails.default.url);

                    var img=`<a id="imgvideo" href="sing.php?id=${item.id.videoId}&&name=${item.snippet.title}&&img=${item.snippet.thumbnails.high.url}"><img  height="250" src="${item.snippet.thumbnails.high.url}"></a>`;
                    // $("#videos").append(img)
                    var title=`<a id="titile" href="sing.php?id=${item.id.videoId}&&name=${item.snippet.title}&&img=${item.snippet.thumbnails.high.url}">${item.snippet.title}</a>`;

                    // $("#videos").append(title);
                    var str='<div class="videos">'+img+title+'</div>';
                    $("#list").append(str);
                    // console.log(str);
                    // $("list").html+=str;
                    // $("#videos").append(video);
            })
            });



        }
        function video_save() {
            var content=document.getElementById("search").value;

            $.ajax({
                url: 'list_video.php', // point to server-side PHP script
                type: 'post',
                data:'content=' + content,
                success: function(php_script_response){
                    document.getElementById('list').innerHTML=php_script_response;

                    // console.log(php_script_response);


                }
            });


        }

    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<div class="container">
    <div id="logo">
    <a href="index.php" class="logo1"><img id="img1" src="img/logokaraoke.jpg"></a>
    <a href="index.php" class="logo1"><img id="img2" src="img/logoyoutube.gif"></a>
        <?php
        include "login.html";
        ?>

    </div>
    <!--<input type="search" id="search"/>-->
    <!--<button id="tim" onclick="tim()">Search</button>-->
    <div class="input-group">
        <input type="search" id="search" class="form-control rounded" placeholder="Search" width="500" aria-label="Search"
               aria-describedby="search-addon" onkeyup="video_save()" />
        <button type="button" id="tim" class="btn btn-outline-primary" onclick="tim()">search</button>
    </div>
    <p id="ketqua">Result</p>
    <div class=row>
        <div class="col-md-12" id="list">
<!--            --><?php
//            echo "<i> Video đã xem</i>";
//            if(isset($_SESSION['id'])){
//               $iduser=$_SESSION['id'];
//                $sql="SELECT * FROM user_xem_video as a ,video as b WHERE a.ID_VIDEO=b.ID_VIDEO and a.ID_USER='$iduser' ";
//                $result=mysqli_query($link,$sql);
//                if(mysqli_num_rows($result)>0){
//                    while ($rows=mysqli_fetch_assoc($result)){
//                        $img=$rows['HINHANH_VIDEO'];
//                        $id=$rows['ID_VIDEO'];
//                        $name=$rows['NAME_VIDEO'];
//                        $str_img="<a id=\"imgvideo\" href=\"sing.php?id=$id&&name=$name&&img=$img\"><img  height=\"250\" src=\"$img\"></a>";
//                        $str_name="<a id=\"titile\" href=\"sing.php?id=$id&&name=$name&&img==$img\">$name</a>";
//                        echo "<div class=\"videos\">'.$str_img.$str_name.'</div>";
//                    }
//                }
//
//            }
//            else{
//                echo"<h5>Đăng nhập để chúng tôi hiểu bạn hơn</h5>";
//            }
//            ?>

        </div>
    </div>
</div>
</body>
</html>
