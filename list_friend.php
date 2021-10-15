<?php
require 'cn.php';
session_start();
//if(isset($_GET['myid'])){
//    $userwatch=$_GET['myid'];
//
//    echo"$userwatch";
//
//
//
//
//}else{
//    echo "";
//
//}
if(isset($_SESSION['id']))
{
    $id=$_SESSION['id'];
    $sql="SELECT * FROM `user` WHERE ID_USER=$id";
    if($result=mysqli_query($link,$sql)){
        if(mysqli_num_rows($result)>0){
            while($rows=mysqli_fetch_assoc($result)){
                $name=$rows['HOTEN_USER'];
                $img=$rows['hinhanh'];

            }
        }else{
            $name="No name";
        }
    }else{
        echo"<script>alert('ID dono exist)</script>";
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
    #box-mess{
        width: 100%;
        display: flex;
        flex-direction: row;
    }
    #opt-mess-leff{
        width:10%;
        display: flex;
        flex-direction: column;

        background-color: lightskyblue;
    }
        #list-opt-mess-left{

            list-style: none;
            margin: 0px;
            padding: 0px;
            width: 100%;

        }
        #list-opt-mess-left li{
            margin: 0px;
            text-align: center;
            list-style: none;

            padding: 0px;
            min-height: 40px;

        }
        #list-opt-mess-left li:hover{

            background-color: white;
        }
        #avarta img{
            border-radius: 40px;
        }
        #kinhlup{
            background-color: #00A1D3;
        }
        #list-opt-mess-left li a{
            text-align: center;
            text-decoration: none;
            margin: 1px;
            padding: 1px;
            min-height: 40px;
        }
    #opt-mess-right{
        width: 90%;
        display: flex;
        flex-direction: column;
    }
        #top-opt-mess-right{
            height: 40px;
            border: 1px solid #b3d4fc;
            display: flex;
            flex-direction: row;
        }
            #top-left-opt-mess-right{
                width: 60%;
                padding: 2px;
                margin: 1px;
                background-color: whitesmoke;
            }
            #top-right-opt-mess-right{
                border-left: 1px solid silver;
                width: 40%;
                padding: 3px;
                display: flex;
                flex-direction: row;
            }
            #top-right-opt-mess-right ul{
                list-style: none;
                display: flex;
                flex-direction: row;
                padding: 0px;
                margin: 0px;
                margin-left: 10%;
              }
                #top-right-opt-mess-right ul li{
                    padding: 1px;
                    margin: 10px;
                    width: 100px;
                    
                }
        #bottom-opt-mess-right{
            min-height: 300px;

            display: flex;
            flex-direction: row;
        }
            #div1{
                display: flex;
                flex-direction: column;
                border-right: 1px solid #b3d4fc;
                padding-right: 6px;
                padding-top: 20px;
                width: 25%;
            }
                #search{
                    width: 100%;
                    min-height: 30px;
                    margin-bottom: 20px;


                }
                    #search input{
                        border-radius: 20px;
                        border: 0px;
                        width: 100%;
                        height: 25px;
                        background-color: lightgrey;
                    }
                    /*#search botton{*/
                    /*    background-color: lightskyblue;*/
                    /*    border-radius: 5px;*/
                    /*    font-weight: bold;*/

                    /*}*/
                #list-mess{
                    padding: 1px;

                    height: 520px;
                    list-style: none;
                }
                    #list-mess ul{
                        margin: 0px;
                        padding: 1px;
                        list-style: none;
                    }
                    #list-mess ul li{
                        display: flex;
                        flex-direction: row;
                        margin-bottom: 20px;
                        border-top: 1px solid silver;
                        border-bottom: 1px solid silver;
                        border-radius: 10px;
                    }
                    #list-mess ul li a{
                       text-decoration: none;
                        text-align: center;
                        font-weight: bold;
                        font-size: 20px;
                    }
                    #list-mess ul li a img{
                        width: 70px;
                        height: 70px;
                        border-radius: 20px
                    }
                    #list-mess ul li:hover{
                        background-color: salmon;

                    }

            #div2{
                display: flex;
                flex-direction: column;

                width: 75%;
            }
                #name-user{
                border-right: 1px solid lightskyblue;
                    display: flex;
                    flex-direction: row;
                    height: 60px;
                    border-bottom: 1px solid lightskyblue;

                }
                #name-user p{
                    margin-left: 20px;
                    font-weight: bold;
                    font-size: 20px;
                }

                #mess-box{
                    background: lightblue url("img/bg-chat.jpg")  ;


                }
                ::-webkit-scrollbar{
                    width: 10px;

                }
                    #show-mess{
                        display: flex;
                        flex-direction: column;
                        width: 100%;
                        height: 460px;
                        overflow-y: scroll;

                    }
                        #toi{
                            background-color: #b3d4fc;
                            padding: 2px;
                            width: 40%;
                            display: flex;
                            flex-direction: column;
                            margin-left: 55%;
                            border-radius: 10px;
                            margin-bottom: 10px;
                            text-align: center;
                            
                        }
                        #khach{
                            border-radius: 20px;
                            padding: 2px;
                            width: 40%;
                            display: flex;
                            flex-direction: column;
                            margin-top: 1px;
                            margin-left: 0px;
                            border: 1px solid silver;
                            background-color: white;
                            text-align: center;

                        }
                            .video-in-mess{
                                width: 100%;

                            }
                            .img-in-mess{
                                width: 100%;

                            }
                            .audio-in-mess{

                                
                            }
                            .content-in-mess{
                                width: 100%;

                            }
                #my-send-mess-box{
                    display: flex;
                    flex-direction: column;

                }
                    #opt-send-mess{
                        display: flex;
                        flex-direction: column;

                    }
                        #opt-send-mess ul{
                            list-style: none;
                            padding: 1px;
                            margin: 1px;

                        }
                            #opt-send-mess ul li{
                                width: 100%;

                            }
                                #opt-send-mess ul li a{



                                }
                                #opt-send-mess ul li #checked-record{
                                                         margin-left: 60px;
                                                         padding: 2px;
                                                     }
                    #send-mess{
                        display: flex;
                        flex-direction: row;

                    }
                        #set-content{
                            width: 80%;
                            border-radius: 10px;

                        }
                        #send-content{
                            width: 10%;
                            border-radius: 10px;
                            background-color: #00A1D3;
                            font-weight: bold;
                            font-style: italic;
                            color: whitesmoke;

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

    function makeid() {
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

        for (var i = 0; i < 6; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));

        return text;
    }
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
    // function writeUserMess(userId){
    //     var myid=getmyid();
    //     var keyroom=makeid();
    //     const db = getDatabase();
    //     set(ref(db, 'chat/'), {
    //         user1: userId,
    //         user2: myid,
    //
    //     });
    // }
    function writeUserData(userId) {
        var myid=getmyid();
        var state=0;
        var path_get_content="chat/";
        var key_path="";
        const db = getDatabase();
        if(userId!=myid){
            get(child(ref(db), `chat`)).then((snapshot) => {

                var keyroom="-"+myid+"-"+userId;

                snapshot.forEach(function (childkey){
                    if(childkey.key.search(myid) > 0 && childkey.key.search(userId) > 0 ){
                        state=1;
                        key_path=childkey.key;

                    }else {

                    }
                })

                if(state==1){
                    console.log(path_get_content+key_path);
                    var box_send="<textarea id=\"set-content\" placeholder=\"Nhập tin nhắn...\"></textarea>\n" +
                        " <button id=\"send-content\" onclick=\"send_my_mess('"+key_path+"','"+userId+"')\">Gui</button>";
                    document.getElementById("send-mess").innerHTML=box_send;
                    show_mess(key_path);
                    document.getElementById('show-mess').scrollTop =  document.getElementById('show-mess').scrollHeight

                    // setInterval(function() {
                    //     show_mess(key_path);
                    // }, 3000);



                }else{
                    set(ref(db, 'chat/'+keyroom), {
                       

                    });
                    // setInterval(function() {
                    //     show_mess(keyroom);
                    // }, 3000);
                    var box_send="<textarea id=\"set-content\" placeholder=\"Nhập tin nhắn...\"></textarea>\n" +
                        " <button id=\"send-content\" onclick=\"send_my_mess('"+keyroom+"','"+userId+"')\">Gui</button>";
                    document.getElementById("send-mess").innerHTML=box_send;
                    window.scrollTo(0,document.getElementById('show-mess').scrollHeight);

                }




            }).catch((error) => {
                console.error(error);
            });

        }



    }
    function isset(_var){
        return !!_var; // converting to boolean.
    }
    function get_audio_file(keyroom) {
        var file_audio = $('#audio').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_audio);

        $.ajax({
            url: 'get_audio_mess.php?idroom='+keyroom, // point to server-side PHP script
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(php_script_response){
                // display response from the PHP script, if any

               console.log(php_script_response);

            }

        });

    }
    function get_video_file(keyroom) {
        var file_video = $('#video').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_video);

        $.ajax({
            url: 'get_video_mess.php?idroom='+keyroom, // point to server-side PHP script
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(php_script_response){
                // display response from the PHP script, if any

                console.log(php_script_response);

            }

        });

    }
    function get_img_file(keyroom) {
        var file_img = $('#img').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_img);


        $.ajax({
            url: 'get_img_mess.php?idroom='+keyroom, // point to server-side PHP script
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(php_script_response){
                // display response from the PHP script, if any

                console.log(php_script_response);

            }

        });

    }

    function send_my_mess(keyroom,userId) {
        var file_audio = $('#audio').prop('files')[0];
        var file_video = $('#video').prop('files')[0];
        var file_img = $('#img').prop('files')[0];
        var path_video="";
        var path_audio="";
        var path_img="";

        if(isset(file_audio)){
            get_audio_file(keyroom);

            path_audio="chats/audio/"+keyroom+"/"+file_audio.name;
            console.log(path_audio);

        }else{

        }
        if(isset(file_video)){
            get_video_file(keyroom);
            path_video="chats/video/"+keyroom+"/"+file_video.name;

        }else{

        }
        if(isset(file_img)){
            get_img_file(keyroom);
            path_img="chats/img/"+keyroom+"/"+file_img.name;


        }else{

        }

        var content_mess=document.getElementById('set-content').value;
        console.log(content_mess);
        const db = getDatabase();
        set(push(ref(db, 'chat/' + keyroom)), {
            id: getmyid(),
            img: path_img,
            video : path_video,
            audio:path_audio,
            content:content_mess,
        });

        writeUserData(userId);
       show_mess(keyroom);





    }



    // function getContentUserMess(userId){
    //     var myid=getmyid();
    //     const db = getDatabase();
    //     get(child(dbRef, `chat`)).then((snapshot) => {
    //         if (snapshot.exists()) {
    //             console.log(snapshot.val());
    //             console(userId);
    //         } else {
    //             console.log("No data available");
    //         }
    //     }).catch((error) => {
    //         console.error(error);
    //     });
    // }

    // ---------------------chat_old_user
    function get_room_have_user() {
        var myid=getmyid();
        const db = getDatabase();
        var str="";
        onChildAdded(ref(db ,`chat/`), (snapshot) => {
            var other_room;
            var room=snapshot.key;
            var num_my_room=room.search(myid);
            console.log(num_my_room);
            if(num_my_room!=-1){
                if(num_my_room<12 ){
                    other_room=room.substr( 12, 21 );

                }else{
                    other_room=room.substr( 1, 10 )
                }
            }else{


            }

            var content=other_room;
                $.ajax({
                    url: 'list_mess_user.php', // point to server-side PHP script
                    type: 'post',
                    data:'content=' + content,
                    success: function(php_script_response){
                            // console.log(content);
                        document.getElementById('list-mess').innerHTML+=php_script_response;

                    }
                });

            })




    }
    get_room_have_user();
    
    
    
    
    
    //------------end chat_ole_user




    var i=0;
    function show_opt_box_cmt() {
        if(i%2==0){
            document.getElementById('opt-send-mess').style.display="block";
        }else{
            document.getElementById('opt-send-mess').style.display="none";
        }
        i++;

    }
    function get_list_user() {
        var content=document.getElementById('timkiem').value;
        $.ajax({
            url: 'list_mess_user.php', // point to server-side PHP script
            type: 'post',
            data:'content=' + content,
            success: function(php_script_response){
                document.getElementById('list-mess').innerHTML=php_script_response;

                console.log(php_script_response);


            }
        });


    }


    function get_mess(id) {
        $.ajax({
            url: 'get_mess.php', // point to server-side PHP script
            type: 'post',
            data:'id=' + id,
            success: function(php_script_response){
                document.getElementById('div2').innerHTML=php_script_response;
                writeUserData(id);


            }
        });

    }



    function show_mess(keyroom) {
        const db = getDatabase();
        var str="";
        onChildAdded(ref(db ,`chat/`+keyroom), (snapshot1) => {

            var myid=getmyid();
            var video="";
            var audio="";
            var img="";
            var content="";
            if(snapshot1.val().id == myid){
                if(snapshot1.val().video!=""){
                    var srcvideo=snapshot1.val().video;
                    video= " <video  class=\"video-in-mess\" controls>\n" +
                        "      <source src="+srcvideo+">\n" +
                        "   </video>\n" ;

                }
                if(snapshot1.val().audio!=""){
                    var srcaudio=snapshot1.val().audio;
                    audio="<audio  controls>\n" +
                        "    <source src="+srcaudio+">\n" +
                        "  </audio>\n" ;

                }
                if(snapshot1.val().img!=""){
                    var srcimg=snapshot1.val().img;
                    img= "<img height=\"240\" src="+srcimg+" >\n" ;

                }
                if(snapshot1.val().content!=""){
                    var srccontent=snapshot1.val().content;
                    content=  "<p id=\"my-content\">"+srccontent+"</p>\n" ;

                }
                str=str+" <div id=\"khach\">\n" +video+img+audio+content+
                    " </div>\n";
                console.log("khongbang");

            }else{
                if(snapshot1.val().video!=""){
                    var srcvideo=snapshot1.val().video;
                    video= " <video  class=\"video-in-mess\" controls >\n" +
                        "      <source src="+srcvideo+">\n" +
                        "   </video>\n" ;

                }
                if(snapshot1.val().audio!=""){
                    var srcaudio=snapshot1.val().audio;
                    audio="<audio  controls>\n" +
                        "    <source src="+srcaudio+">\n" +
                        "  </audio>\n" ;

                }
                if(snapshot1.val().img!=""){
                    var srcimg=snapshot1.val().img;
                    img= "<img height=\"240\" src="+srcimg+" >\n" ;

                }
                if(snapshot1.val().content!=""){
                    var srccontent=snapshot1.val().content;
                    content=  "<p id=\"my-content\">"+srccontent+"</p>\n" ;

                }
                str=str+" <div id=\"toi\">\n" +video+img+audio+content+
                    " </div>\n";
                console.log("bang");

            }
            document.getElementById('show-mess').innerHTML=str;
            document.getElementById('show-mess').scrollTop =  document.getElementById('show-mess').scrollHeight


        });

        //
        // onValue(ref(db ,`chat/`+keyroom), (snapshot) => {
        //     const data = snapshot.val();
        //     console.log(data);
        //         console.log(snapshot.val());
        //
        //         snapshot.forEach(function (snapshot1){
        //
        //             var myid=getmyid();
        //             var video="";
        //             var audio="";
        //             var img="";
        //             var content="";
        //                 if(snapshot1.val().id != myid){
        //                     if(snapshot1.val().video!=""){
        //                         var srcvideo=snapshot1.val().video;
        //                         video= " <video  class=\"video-in-mess\" >\n" +
        //                             "      <source src="+srcvideo+">\n" +
        //                             "   </video>\n" ;
        //
        //                     }
        //                     if(snapshot1.val().audio!=""){
        //                         var srcaudio=snapshot1.val().audio;
        //                         audio="<audio  controls>\n" +
        //                             "    <source src="+srcaudio+">\n" +
        //                             "  </audio>\n" ;
        //
        //                     }
        //                     if(snapshot1.val().img!=""){
        //                         var srcimg=snapshot1.val().img;
        //                         img= "<img height=\"240\" src="+srcimg+" >\n" ;
        //
        //                     }
        //                     if(snapshot1.val().content!=""){
        //                         var srccontent=snapshot1.val().content;
        //                         content=  "<p id=\"my-content\">"+srccontent+"</p>\n" ;
        //
        //                     }
        //                     str=str+" <div id=\"khach\">\n" +video+img+audio+content+
        //                                 " </div>\n";
        //                     console.log("khongbang");
        //
        //                 }else{
        //                     if(snapshot1.val().video!=""){
        //                         var srcvideo=snapshot1.val().video;
        //                         video= " <video  class=\"video-in-mess\" >\n" +
        //                             "      <source src="+srcvideo+">\n" +
        //                             "   </video>\n" ;
        //
        //                     }
        //                     if(snapshot1.val().audio!=""){
        //                         var srcaudio=snapshot1.val().audio;
        //                         audio="<audio  controls>\n" +
        //                             "    <source src="+srcaudio+">\n" +
        //                             "  </audio>\n" ;
        //
        //                     }
        //                     if(snapshot1.val().img!=""){
        //                         var srcimg=snapshot1.val().img;
        //                         img= "<img height=\"240\" src="+srcimg+" >\n" ;
        //
        //                     }
        //                     if(snapshot1.val().content!=""){
        //                         var srccontent=snapshot1.val().content;
        //                         content=  "<p id=\"my-content\">"+srccontent+"</p>\n" ;
        //
        //                     }
        //                     str=str+" <div id=\"toi\">\n" +video+img+audio+content+
        //                     " </div>\n";
        //                     console.log("bang");
        //
        //                 }
        //             document.getElementById('show-mess').innerHTML=str;
        //
        //         })
        //
        //
        //
        // });

    }


    window.get_list_user=get_list_user;
    window.get_mess=get_mess;
    window.show_opt_box_cmt=show_opt_box_cmt;
    window.send_my_mess=send_my_mess;
</script>

</head>
<body>


<div id="box-mess">
    <div id="opt-mess-leff">
        <ul id="list-opt-mess-left">
            <li ><a href="#" id="avarta"><img src="<?php echo"$img"; ?>" width="80" height="80"></a></li>
            <li id="kinhlup"><a href="#" ><img src="img/icon-kinh-lup.png" width="40" height="40"></a></li>
<!--            <li><a href="#" ><img src="img/icon-list.jpg" width="40" height="40"></a>3</li>-->
        </ul>

    </div>
    <div id="opt-mess-right">
        <!--        ------------top-opt-mess-right-->
        <div id="top-opt-mess-right">
            <div id="top-left-opt-mess-right">
              <p style="font-size: 15px;margin-left: 15px; font-weight: bold"><?php echo"$name"; ?></p>
            </div>
            <div id="top-right-opt-mess-right">
                <ul>
                    <li> <a href="interface_mxh.php?iduser=<?php echo "$id";?>"><img src="img/icon-home.png" style="height: 25px;image-rendering: pixelated;object-fit: contain"></a></li>
                    <li> <a href="index.php"><img src="img/logoyoutube.gif" style="height: 25px;image-rendering: pixelated;object-fit: contain"></a></li>

                </ul>
            </div>
        </div>
<!--        ------------bottom-opt-mess-right-->
        <div id="bottom-opt-mess-right">
<!--            ---bottom-opt-left-->
            <div id="div1">
                <div id="search">
                    <input type="text" name="timkiem" id="timkiem" value="<?php if(isset($_GET['myid'])){
                        $userwatch=$_GET['myid'];
                        echo"$userwatch";
                    }else{
                        echo "";

                    } ?>" onkeyup="get_list_user()"placeholder="ID:Search User..................">
                </div>
                <div id="list-mess">

                </div>

            </div>
<!--            ---bottom-opt-right-->
            <div id="div2">
<!--                <div id="name-user">-->
<!--                    <img src="img/logoyoutube.gif" style="width: 60px;height: 60px;border-radius: 30px">-->
<!--                    <p>Tran Van Huy</p>-->
<!--                </div>-->
<!--                <div id="mess-box">-->
<!--                    <div id="show-mess">-->
<!--                        <div id="khach">-->
<!--                            <video  class="video-in-mess" >-->
<!--                                <source src="users/ncgb2.mp4">-->
<!--                            </video>-->
<!--                            <img src="img/icon-list.jpg" height="240">-->
<!--                            <audio  controls>-->
<!--                                <source src="yeumotnguoikara.mp3">-->
<!--                            </audio>-->
<!--                            <p id="my-content">abc</p>-->
<!--                        </div>-->
<!--                        <div id="toi">-->
<!--                            <video class="video-in-mess"   controls >-->
<!--                                <source src="users/ncgb2.mp4">-->
<!--                            </video>-->
<!--                            <img class="img-in-mess"  height="240" src="img/icon-list.jpg">-->
<!--                            <audio class="audio-in-mess" controls>-->
<!--                                <source src="yeumotnguoikara.mp3">-->
<!--                            </audio>-->
<!--                            <p class="content-in-mess" id="my-content">abc</p>-->
<!--                        </div>-->
<!---->
<!---->
<!--                    </div>-->
<!--                </div>-->
<!--                <div id="my-send-mess-box">-->
<!--                    <a onclick="show_opt_box_cmt()"><img src="img/iconadd.jpg" style="width: 30px; height: 30px;border-radius: 20px"></a>-->
<!---->
<!--                    <div id="opt-send-mess" style="display: none">-->
<!--                        <ul>-->
<!--                            <form method="POST" enctype="multipart/form-data" >-->
<!--                                <li><img src="img/icon_add_record.png" style="width: 40px; height: 40px;border-radius: 20px"> <input type="file" name="audio" id="audio"></li>-->
<!--                                <li><img src="img/icon-youtube.png" style="width: 40px; height: 40px;border-radius: 20px"> <input type="file" name="video" id="video"></li>-->
<!--                                <li><img src="img/icon-img.png" style="width: 40px; height: 40px;border-radius: 20px"> <input type="file" name="img" id="img"></li>-->
<!--                            </form>-->
<!--                            <li><a><img src="img/icon-list.jpg" style="width: 40px; height: 40px;border-radius: 20px"></a></li>-->
<!--                            <li>-->
<!--                                <ul id="checked-record">-->
<!--                                    <li> <input type="checkbox" name="myrecord" value="bai1"/> <label>bai1</label> <br/></li>-->
<!--                                    <li> <input type="checkbox" name="myrecord" value="bai2"/> <label>bai2</label> <br/></li>-->
<!--                                    <li> <input type="checkbox" name="myrecord" value="bai3"/> <label>bai3</label> <br/></li>-->
<!--                                </ul>-->
<!--                            </li>-->
<!--                        </ul>-->
<!---->
<!--                    </div>-->
<!--                    <div id="send-mess">-->
<!--                        <textarea id="set-content" placeholder="Nhập tin nhắn..."></textarea>-->
<!--                        <button id="send-content">Gui</button>-->
<!--                    </div>-->
<!--                </div>-->
            </div>


        </div>
    </div>
</div>
</body>
