<?php
session_start();
require 'cn.php';
$uri = $_SERVER['REQUEST_URI'];


if(explode("=", $uri)==false){
    header('location:index.php');
}


if (isset($_COOKIE['idvideo'])) {
    unset($_COOKIE['idvideo']);
    setcookie('idvideo', null, -1, '/');

} else {

}
$iduserhh=$_SESSION['id'];
$tenuserhh=$_SESSION['username'];

$anhdaidienhh=$_SESSION['imguser'];
$status=0;
$name="No name";
$img=" ";
if(isset($_COOKIE['id'])){
    if(isset($_GET['iduser'])){
        if($_COOKIE['id']==$_GET['iduser']){
            setcookie("userwatch",$_GET['iduser'], time() + 6000000, "/");
            $status=1;
            setcookie("status", $status, time() + 6000000, "/");
            $id=$_COOKIE['id'];
            $sql="SELECT * FROM `user` WHERE ID_USER=$id";
            if($result=mysqli_query($link,$sql)){
                if(mysqli_num_rows($result)>0){
                    while($rows=mysqli_fetch_assoc($result)){
                        $name=$rows['HOTEN_USER'];
                        $img=$rows['hinhanh'];




                    }
                }else{
                    $name="No name";
                    $img=" ";
                }
            }else{
                echo"<script>alert('ID dono exist)</script>";
            }

        }else{
            $status=0;

            setcookie("userwatch",$_GET['iduser'], time() + 6000000, "/");

            setcookie("status", $status, time() + 6000000, "/");
            $id=$_GET['iduser'];
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

    }else{

    }
}

else{
    echo"<script>alert('Login please')</script>";
}



?>
<!DOCTYPE html>
<html lang="en" name="viewport" content="width=device-width, initial-scale=1">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

        import { getDatabase,onValue,query,limitToLast,remove,push,update, ref, set, child, get,onChildAdded,limitToFirst, onChildChanged, onChildRemoved } from "https://www.gstatic.com/firebasejs/9.0.0/firebase-database.js";
        // var link_record="user/iduser/record/";
        // var namefile="huy.wav";
        // var link_video="user/iduser/video/"
        function today() {
            var d=new Date();
            var moth=d.getMonth()+1;
            var str= d.getHours()+"h :"+d.getMinutes()+"m || "+d.getDate()+" / "+moth+" / "+d.getFullYear();
            return str;
        };
        function writeUserData(userId, name,uid, content, recordUrl,imageUrl) {
            const db = getDatabase();
            var time=today();
            set(ref(db, 'users/' + userId + '/' +uid), {
                id_post:uid,
                username: name,
                content: content,
                record_url: recordUrl,
                img_url: imageUrl,
                status:"1",
                date:time,
            });
        }

        // function writeUserCmt(userId,uid,userIDcmt, name,content,recordUrl){
        //     const db = getDatabase();
        //     set(ref(db, 'users/' + userId + '/' +uid + '/cmt/' +userIDcmt), {
        //         username: name,
        //         content: content,
        //         record_url: recordUrl,
        //     });
        // }
        // function writeUserlike(userId,uid,userIDlike, name){
        //     const db = getDatabase();
        //     set(ref(db, 'users/' + userId + '/' +uid + '/like/' +userIDlike), {
        //         username: name,
        //     });
        // }
        // writeUserCmt('1176460198','ns4i5h','11133213','Le-Van-Luyen','Ban hat hay qua','record/huytv.wav')
        // writeUserlike('1176460198','ns4i5h','11133213','Le-Van-Luyen');
        function getid() {
            var a= document.cookie.split(';');
            for(var i=0; i<a.length;i++){
                if(a[i].indexOf("userwatch")==1){
                    var iduser=a[i].split("=");

                    return iduser[1];
                }else{

                }
            }
            // var iduser=a[3].split("=");
            // console.log(iduser[1]);
            // return iduser[1];
        }
        function getstatuspage() {
            var a= document.cookie.split(';');
            for(var i=0; i<a.length;i++){
                if(a[i].indexOf("status")==1){
                    var iduser=a[i].split("=");

                    return iduser[1];
                }else{

                }
            }
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

        function  sendvideo() {
            var id=getid();
            var file_data = $('#get-video').prop('files')[0];
            if(isset(file_data)){
                var form_data = new FormData();
                form_data.append('file', file_data);
                var name_video=file_data.name;
                var path_video='users/video/'+id+"/"+name_video
                var title = document.getElementById("titile-video").value;
                // -------firebase
                const db = getDatabase();
                var path='users/' + id + '/video';
                console.log(title);
                console.log(path+' ** '+path_video);
                push(ref(db, path), {
                    title:title,
                    path:path_video,

                });
                $.ajax({
                    url: 'uploadvideo.php?id='+id, // point to server-side PHP script
                    dataType: 'text',  // what to expect back from the PHP script, if anything
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success: function(php_script_response){
                        console.log(php_script_response); // display response from the PHP script, if any


                    }
                });

            }else{
                alert("Ban chua chon file");
            }
            showvideo();



        }
        function remove_file(path) {

            $.ajax({
                url: 'remove_file.php', // point to server-side PHP script
                type: 'post',
                data:'path=' + path,
                success: function(php_script_response){

                    alert("Bạn đã xóa thành công 1 file");


                }
            });




        }
        function del_video(key_video,path_sever) {
            var id=getid();
            var db=getDatabase();
            var path='users/' + id + '/video/'+key_video;
            remove(ref(db, path));
            remove_file(path_sever);
            showvideo();
            get_more_video();




            return false;

        }
        window.del_video=del_video;
        function showvideo() {
            var id=getid();
            var path='users/' + id + '/video/';
            const dbRef = ref(getDatabase());
            var str="";
            var dem=1;
            get(child(dbRef, path)).then((snapshot) => {

                snapshot.forEach(function (childkey){
                        var key=childkey.key;
                        var id_video='users/' + id + '/video/' + key;
                        get(child(dbRef, id_video)).then((snapshot1) => {
                            dem=dem+1;
                            var urlvideo=snapshot1.val().path;
                            var title=snapshot1.val().title;
                            var delete_video="";
                            if(getmyid()==getid()){
                                delete_video="<a class=\"icon_del_video\" href=\"#\" onclick=\"return del_video('"+key+"','"+urlvideo+"');\"><span class=\"material-icons\">\n" +
                                    "highlight_off\n" +
                                    "</span>\n</a>";
                            }else{

                            }

                            if(dem<=5){
                                str=str+"<div class=\"infor-time\">\n" +
                                    "                    <div class=\"user-avarta\">\n" +
                                    "                        <h5 class=\"header-video\">"+title+"</h5>\n" +delete_video+
                                    "                    </div>\n" +
                                    "                    <div class=\"user-name\">\n" +
                                    "                        <video class=\"video\" controls>\n" +
                                    "                            <source src="+urlvideo+" type=\"video/mp4\">\n" +
                                    "                        </video>\n" +
                                    "                    </div>\n" +
                                    "                </div>";

                                document.getElementById('info-time-show').innerHTML=str;

                            }

                        }).catch((error) => {
                            console.error(error);
                        });





                })




            }).catch((error) => {
                console.error(error);
            });

        }
        showvideo();
        function get_more_video() {
            document.getElementById("center").style.width="80%";
            document.getElementById("right").style.display="block";

            var id=getid();
            var path='users/' + id + '/video/';
            const dbRef = ref(getDatabase());
            var str="";
            get(child(dbRef, path)).then((snapshot) => {
                snapshot.forEach(function (childkey){
                    var key=childkey.key;
                    var id_video='users/' + id + '/video/' + key;
                    var delete_video="";

                    get(child(dbRef, id_video)).then((snapshot1) => {
                        var urlvideo=snapshot1.val().path;
                        var title=snapshot1.val().title;
                        // console.log(urlvideo+title);
                        if(getmyid()==getid()){
                            delete_video="<a class=\"icon_del_video1\" href=\"#\" onclick=\"del_video('"+key+"','"+urlvideo+"');\">Delete: </a>";

                        }else{

                        }
                        str=str+ "   <div class=\"video-more\">\n" +
                            "            <label>"+delete_video+title+"</label>\n" +
                            "            <video controls>\n" +
                            "                <source src="+urlvideo+">\n" +
                            "            </video>\n" +
                            "\n" +
                            "        </div>\n" +
                            "        <hr>\n" +
                            "   "
                        var hd="<a onclick='exit_libvideo()' style='border: 1px solid blue; border-radius: 20px;width: 100%;height: 40px;text-align: center';><span class=\"material-icons\">\n" +
                            "video_library\n" +
                            "</span>Close</a>";
                        document.getElementById('right').innerHTML=hd+str;
                    }).catch((error) => {
                        console.error(error);
                    });


                })




            }).catch((error) => {
                console.error(error);
            });

        }
        function exit_libvideo() {
            document.getElementById("right").style.display="none";
            document.getElementById("center").style.width="80%";

        }
        window.exit_libvideo=exit_libvideo;
        function get_value_length() {
            var titile = document.getElementById("titile-video").value;
            var length=titile.length;
            console.log(length);
            document.getElementById("value_length_input").innerHTML="<p>"+length+"/50</p>"
        }
        function show_input_video() {
            var str="   <div id=\"input-video\">\n" +
                "                        <p id=\"value_length_input\"></p>\n" +
                "                        <form>\n" +
                "                            <input type=\"input\" name=\"titile-video\" onkeyup=\"get_value_length();\" maxlength=\"50\" placeholder=\"Title Video...\" id=\"titile-video\">\n" +
                "                            <input type=\"file\" name=\"get-video\" id=\"get-video\">\n" +
                "                        </form>\n" +
                "                        <button id=\"btn-input-video\" onclick=\"sendvideo();\">OK</button>\n" +
                "                    </div>";
            document.getElementById("input-video-box").innerHTML=str;
        }

        function like_bai_viet(id,key_baiviet){
            var myid=getmyid();
            const db = getDatabase();
            var path='users/' + id + '/' + key_baiviet + '/like/'+ myid;

            set(ref(db, path), {
                id:myid,

            });
            document.getElementById('like'+key_baiviet).innerHTML="<a href=\"#\" onclick=\"return dislike_bai_viet('" + id + "','" + key_baiviet + "')\"  class=\"like-start\"><img src=\"img/icon-at-like.png\" width=\"30\" height=\"30\"style=\"border-radius: 60px; margin: 2px\"></a>";

            return false;

            
        }
        function dislike_bai_viet(id,key_baiviet){
            var myid=getmyid();
            const db = getDatabase();
            var path='users/' + id + '/' + key_baiviet + '/like/'+ myid;

            remove(ref(db, path));
            document.getElementById('like'+key_baiviet).innerHTML="<a href=\"#\" onclick=\"return like_bai_viet('" + id + "','" + key_baiviet + "')\"  class=\"like-start\"><img src=\"img/icon-bf-like.png\" width=\"30\" height=\"30\"style=\"border-radius: 60px; margin: 2px\"></a>";

            return false;


        }

        window.like_bai_viet=like_bai_viet;
        window.dislike_bai_viet=dislike_bai_viet;
        function likecmt(id,key_baiviet,key_cmt) {
            var myid=getmyid();
            const db = getDatabase();
            var path='users/' + id + '/' + key_baiviet + '/cmt/'+ key_cmt +'/like/'+ myid;

            set(ref(db, path), {
                id:myid,

            });


            var str="<a href=\"\"><img src=\"img/icon-at-like.png\" onclick=\"return dislikecmt('"+id+"','"+key_baiviet+"','"+key_cmt+"')\"  width=\"30px\" height=\"30px\" style=\"border-radius: 15px\"></a>";
            document.getElementById(key_baiviet+key_cmt).innerHTML=str;

            return false;
        }

        function cmt(id,key_baiviet){
            var idusercmt='<?php echo "$iduserhh"?>';
            var tenusercmt='<?php echo "$tenuserhh"?>';
            var anhusercmt='<?php echo "$anhdaidienhh"?>';
            var content=document.getElementById('cmt'+key_baiviet).value;
            if(isset(content)){
                content=document.getElementById('cmt'+key_baiviet).value;
            }else{
                content="";
            }
            var file_data = $('#record'+key_baiviet).prop('files')[0];
            var path_record;
            var path_firebase='users/' + id + '/' +key_baiviet + '/cmt/' ;
            const db = getDatabase();
            if(isset(file_data)){
                var form_data = new FormData();
                form_data.append('file', file_data);
                path_record="users/record/"+id+"/"+key_baiviet+"/"+idusercmt+"/"+file_data.name;
                set(push(ref(db, path_firebase)), {
                    idcmt: idusercmt,
                    username: tenusercmt,
                    content: content,
                    img_url: anhusercmt,
                    record_url: path_record,
                    date:today(),
                });
            }else{
                set(push(ref(db, path_firebase)), {
                    idcmt: idusercmt,
                    username: tenusercmt,
                    content: content,
                    img_url: anhusercmt,
                    record_url: " ",
                    date:today(),
                });

            }




            $.ajax({
                url: 'uploadcmt.php?id='+id+'&&uid='+key_baiviet+'&&idcmt='+idusercmt, // point to server-side PHP script
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(php_script_response){
                     // display response from the PHP script, if any

                    setTimeout(function () {
                        display_cmt(id,key_baiviet);
                    },1000);

                }
            });




                // const db = getDatabase();
                // set(ref(db, 'users/' + id + '/' +key_baiviet + '/cmt/' +idusercmt), {
                //     username: tenusercmt,
                //     content: content,
                //     img_url: anhusercmt,
                //     record_url: recordUrl,
                // });

        }
        function dislikecmt(id,key_baiviet,key_cmt) {

            var myid=getmyid();
            const db = getDatabase();
            var path='users/' + id + '/' + key_baiviet + '/cmt/'+ key_cmt +'/like/'+ myid;

            remove(ref(db, path));
            onChildRemoved(ref(db, path), (data) => {


            });

            var str="<a href=\"\"><img src=\"img/icon-bf-like.png\" onclick=\"return likecmt('"+id+"','"+key_baiviet+"','"+key_cmt+"')\"  width=\"30px\" height=\"30px\" style=\"border-radius: 15px\"></a>";
            document.getElementById(key_baiviet+key_cmt).innerHTML=str;

            return false;
        }
        function delete_my_status(id,key_baiviet){
            const db = getDatabase();
            get(child(ref(db), 'users/' + id + '/' +key_baiviet)).then((snapshot) => {
            var path_record="";
            var path_img=""
                if(snapshot.val().record_url!="no_link_record"){


                    path_record=snapshot.val().record_url;


                }else{
                    console.log("no_record");
                    // var path_record=snapshot.val().record_url;
                    // remove_file(path_record);

                }
                if(snapshot.val().img_url!="no_link_img"){

                    console.log(snapshot.val().img_url);
                    path_img=snapshot.val().img_url;
                    // remove(ref(db, 'users/' + id + '/' +key_baiviet + '/cmt/' +key_cmt));


                }else{
                    console.log("no_img");
                    // var path_record=snapshot.val().record_url;
                    // remove_file(path_record);

                    // remove(ref(db, 'users/' + id + '/' +key_baiviet + '/cmt/' +key_cmt));
                }
                remove_file(path_record);
                remove_file(path_img);
                remove(ref(db, 'users/' + id + '/' +key_baiviet));


            }).catch((error) => {
                console.error(error);
            });
            setTimeout(function(){
                read_status(id);},
                2000);


            return false;
        }
        function private_my_status(id,key_baiviet){
            const db = getDatabase();
            update(ref(db, 'users/' + id + '/' +key_baiviet ), {
                status:"0",
            });
            read_status(id);
            return false;
        }
        function public_my_status(id,key_baiviet){
            const db = getDatabase();
            update(ref(db, 'users/' + id + '/' +key_baiviet ), {
                status:"1",
            });
            read_status(id);
            return false;
        }
        function delete_cmt(id,key_baiviet,key_cmt){
            const db = getDatabase();

            // get(child(starCountRef)).then((snapshot)=> {
            //     if(snapshot.val().record_url==" "){
            //         console.log("no");
            //         remove(ref(db, 'users/' + id + '/' +key_baiviet + '/cmt/' +key_cmt));
            //
            //
            //     }else{
            //         var path_record=snapshot.val().record_url;
            //         remove_file(path_record);
            //         console.log(snapshot.val().record_url);
            //         remove(ref(db, 'users/' + id + '/' +key_baiviet + '/cmt/' +key_cmt));
            //     }
            //
            // })
            get(child(ref(db), 'users/' + id + '/' +key_baiviet + '/cmt/' +key_cmt)).then((snapshot) => {

                if(snapshot.val().record_url==" "){
                    console.log("no");
                    remove(ref(db, 'users/' + id + '/' +key_baiviet + '/cmt/' +key_cmt));


                }else{
                    var path_record=snapshot.val().record_url;
                    remove_file(path_record);
                    console.log(snapshot.val().record_url);
                    remove(ref(db, 'users/' + id + '/' +key_baiviet + '/cmt/' +key_cmt));
                }
            }).catch((error) => {
                console.error(error);
            });
            setTimeout(function(){  display_cmt(id,key_baiviet); }, 2000);

                alert("Delete success");
                return false;

        }
        function update_cmt(id,key_baiviet,key_cmt){
            var content=prompt("Input your comment to update: ");
            const db = getDatabase();
            if(content!=null){

                update(ref(db, 'users/' + id + '/' +key_baiviet + '/cmt/' +key_cmt), {
                    content: content,
                });

                display_cmt(id,key_baiviet);
                alert("Update success");

            }else{


            }


            return false;


        }

        window.likecmt=likecmt;
        window.display_cmt=display_cmt;
        window.cmt=cmt;
        window.dislikecmt=dislikecmt;
        window.delete_my_status=delete_my_status;
        window.private_my_status=private_my_status;
        window.public_my_status=public_my_status;
        window.update_cmt=update_cmt;
        window.delete_cmt=delete_cmt;
        window.sendvideo=sendvideo;
        window.get_value_length=get_value_length;
        window.show_input_video=show_input_video;
        window.get_more_video=get_more_video;
        // window.load_list_friend=load_list_friend;

        // function load_list_friend(){
        //     var my_user=getmyid();
        //     $.ajax({
        //         url: 'list_friend.php?myid='+my_user, // point to server-side PHP script
        //         dataType: 'text',  // what to expect back from the PHP script, if anything
        //         cache: false,
        //         contentType: false,
        //         processData: false,
        //         data:{  },
        //         type: 'post',
        //         success: function(php_script_response){
        //             document.getElementById('center').innerHTML=php_script_response;
        //
        //         }
        //     });
        //
        // }

        function makeid() {
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

            for (var i = 0; i < 6; i++)
                text += possible.charAt(Math.floor(Math.random() * possible.length));

            return text;
        }
        function get_status(uid,link1,link2) {
            var content_status=document.getElementById('content-status').value;
            var name_user=document.getElementById('submitform').value
            console.log(content_status+name_user)

            var id=getid();
            // var linkrecord=link1;
            // var linkimg=link2;

            writeUserData(id,name_user,uid,content_status,link1,link2)
            content_status=" ";
            alert("Đã đăng bài");
            content_status="";

        }
        function isset(_var){
            return !!_var; // converting to boolean.
        }
        var statusthispage=getstatuspage();
        if(statusthispage==1){
        var submit=document.getElementById('submitform');
        submit.addEventListener('click',function () {
            var file_data = $('#record').prop('files')[0];
            console.log(file_data);
            var file_data1 = $('#img').prop('files')[0];
            console.log(file_data1);
            var uid=makeid();
            if(isset(file_data) && isset(file_data1)){
                var form_data = new FormData();
                form_data.append('file', file_data);
                form_data.append('file1', file_data1);
                var fileName_record = file_data.name;
                var fileName_img = file_data1.name;
                var link_record="users/record/"+getid()+"/"+uid+"/"+fileName_record;
                var link_img="users/img/"+getid()+"/"+uid+"/"+fileName_img;


            }else if(isset(file_data)){
                var form_data = new FormData();
                form_data.append('file', file_data);
                var fileName_record = file_data.name;
                var link_record="users/record/"+getid()+"/"+uid+"/"+fileName_record;
                alert(link_record);
                console.log(form_data);
            }else if(isset(file_data1)){
                var form_data = new FormData();
                form_data.append('file1', file_data1);
                var fileName_img = file_data1.name;
                var link_img="users/img/"+getid()+"/"+uid+"/"+fileName_img;
                alert(link_img);
                console.log(form_data);
            }else{

            }

            console.log(uid);
            $.ajax({
                url: 'upload.php?uid='+uid, // point to server-side PHP script
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(php_script_response){
                     // display response from the PHP script, if any
                    if(isset(link_img) && isset(link_record)){
                        get_status(uid,link_record,link_img)
                    }else if(isset(link_record)){
                        get_status(uid,link_record,"no_link_img")
                    }else if(isset(link_img)){
                        get_status(uid,"no_link_record",link_img)
                    }else{
                        get_status(uid,"no_link_record","no_link_img")
                    }
                    var idme=getid();
                    read_status(idme);
                    
                }

            });
        })
        }
        function size_input(id_input) {
            var num=document.getElementById(id_input).value;
            if(num.length>0){
                document.getElementById(id_input).style.width="90%";
                document.getElementById(id_input).style.background="white";
                document.getElementById(id_input).style.textAlign="center";
            }

        }
        window.size_input=size_input;
        var i=2;
        function display_cmt(id,key_baiviet){

            if(i%2==0){
                // document.getElementById(key_baiviet).append("<p>hello</p>");
                var id_keylist="list"+key_baiviet;
                var id_cmt_box="cmt"+key_baiviet;
                var id_record_box="record"+key_baiviet;

                document.getElementById(key_baiviet).innerHTML="<form >\n" +
                    "                    <div id=\"load-ghi-am\">\n" +
                    "                        <img src=\"img/icon-add-record.png\" width=\"40\" height=\"40\" style=\"border-radius: 60px; margin: 2px\">\n" +
                    "                        <div id=\"info-record\">\n" +
                    "                            <label>Record</label>\n" +
                    "                            <input type=\"file\" name="+id_record_box+" id="+id_record_box+"   accept=\".mp3, .wav \" id=\"record\" value=\"Record add\">\n" +
                    "                        </div>\n" +
                    "                    </div>\n" +
                    "                </form>\n" +
                    "\n" +
                    "                <div class=\"user-set-cmt-box\">\n" +
                    "                    <input placeholder=\"      Comment....\" onkeyup=\"size_input('"+id_cmt_box+"');\" id="+id_cmt_box+" name="+id_cmt_box+" class=\"cmt\">\n" +
                    "                    <button class=\"send\" onclick=\"return cmt('"+id+"','"+key_baiviet+"')\"><span class=\"material-icons\">\n" +
                    "send\n" +
                    "</span>\n</button>\n" +
                    "                </div>\n" +
                    "               \n" +
                    "                </hr>\n" +
                    "                <div class=\"listCmt\" >\n" +
                    "                    <ul id="+id_keylist+">\n" +
                    "                      \n" +
                    "\n" +
                    "\n" +
                    "                    </ul>\n" +
                    "                </div>\n";

                document.getElementById(id_keylist).style.overflow="auto";
                document.getElementById(id_keylist).style.height="500px";
                const dbRef = ref(getDatabase());

                get(child(dbRef, `users/`+id+'/'+key_baiviet+'/cmt')).then((snapshot) => {
                    if (snapshot.exists()) {
                        var countcmt=0;
                        var strcmt=" ";
                        // var oj=snapshot.toString();

                        snapshot.forEach(function (listcmt) {
                            var record;
                            var key_cmt = listcmt.key;
                            var username = listcmt.val().username;
                            var content = listcmt.val().content;
                            var id_cmt = listcmt.val().idcmt;
                            var record_url = listcmt.val().record_url;

                            var date = "<p style='font-weight: bold; color: silver; font-style: italic; font-size: 10px'>"+listcmt.val().date+"<img src='img/icon-clock.png' style='width: 20px; height: 13px; margin-left: 5px'></p>";

                            if(record_url!=" "){
                                record="<audio controls><source src='"+record_url+"'></audio>";
                            }else{
                                record=" ";

                            }


                            var img_url = listcmt.val().img_url;
                            countcmt++;
                            var countlike = 0;
                            var myid=getmyid();
                            var law_cmt=" ";

                            if(myid==id_cmt){
                                law_cmt=    "                                <div class=\"dropdown\" style=\"width: 60%; float: right; \">\n" +
                                    "                                    <button class=\"dropbtn\">...</button>\n" +
                                    "                                    <div class=\"dropdown-content\">\n" +
                                    "                                        <a href=\"#\" onclick=\"return delete_cmt('"+id+"','"+key_baiviet+"','"+key_cmt+"')\">Delete</a>\n" +
                                    "                                        <a href=\"#\" onclick=\"return update_cmt('"+id+"','"+key_baiviet+"','"+key_cmt+"')\">Update</a>\n" +

                                    "                                    </div>\n" +
                                    "                                </div>\n"
                            }else if(getid()==myid){
                                law_cmt=    "                                <div class=\"dropdown\" style=\"width: 60%; float: right; \">\n" +
                                    "                                    <button class=\"dropbtn\">...</button>\n" +
                                    "                                    <div class=\"dropdown-content\">\n" +
                                    "                                        <a href=\"#\" onclick=\"return delete_cmt('"+id+"','"+key_baiviet+"','"+key_cmt+"')\">Delete</a>\n" +

                                    "                                    </div>\n" +
                                    "                                </div>\n"

                            }else{
                                law_cmt=""

                            }



                            get(child(dbRef, `users/` + id + '/' + key_baiviet + '/cmt' + '/' + key_cmt + '/like')).then((snapshot) => {
                                if (snapshot.exists()) {

                                    // var oj=snapshot.toString();
                                    snapshot.forEach(function (listlike) {
                                        console.log(listlike.key);
                                        countlike++;

                                    })




                                } else {
                                    console.log("No data available");
                                }

                                 strcmt = strcmt+"<li>\n" +
                                    "                            <div class=\"opt-cmt\">\n" +
                                    "                                <a href="+'interface_mxh.php?iduser='+id_cmt+" style=\" text-decoration: none ;font-weight:bold; font-size: initial;font-size: 10px \"><img src="+img_url+" width=\"60\" height=\"60\" style=\"border-radius: 30px;\">" + username + "</a>\n" +date+
                                                                law_cmt+

                                    "                            </div>\n" +
                                    "                            <div class=\"show-cmt-uid\">\n" +
                                                                   record+
                                    "                                <div class=\"like-cmt-user-rep\" style=\"display: flex\">\n" +
                                    "                                    <div class=\"like-user-rep\"  style=\"display: flex; border-right: 1px solid pink\">\n" +
                                    "                                        <div id="+key_baiviet+key_cmt+"><a href=\"\" ><img src=\"img/icon-bf-like.png\" onclick=\"return likecmt('"+id+"','"+key_baiviet+"','"+key_cmt+"')\"  width=\"30px\" height=\"30px\" style=\"border-radius: 15px\"></a></div>\n" +
                                    "                                        <p style='font-weight: bold; font-size: 15px; color: lightgray'>" + countlike + "</p>\n" +
                                    "                                    </div>\n" +
                                    "                                    <div class=\"cmt-user-rep\">\n" +
                                    "                                        <p id="+'content'+key_cmt+">" + content + "</p>\n" +
                                    "                                    </div>\n"+
                                    "                                </div>\n" +
                                    "                            </div>\n" +
                                    "                        </li>";


                                console.log("countlike"+countlike);
                                document.getElementById(id_keylist).innerHTML=strcmt;

                            }).catch((error) => {
                                console.error(error);
                            });
                            // console.log(strcmt);

// -------------------end forech list cmt----
                        });

                        console.log(strcmt);


                        } else {
                            console.log("No data available11");
                        }
                    }).catch((error) => {
                    console.error(error);
                });


            }else{
                document.getElementById(key_baiviet).innerHTML=" ";

            }

            return false;
        }
        window.display_cmt=display_cmt;
// ------------------------doc status tren fire base------

        function read_status(id) {
            const dbRef = ref(getDatabase());
            get(child(dbRef, `users/`+id)).then((snapshot) => {
                if (snapshot.exists()) {
            // var oj=snapshot.toString();
                    var status=" ";
                    snapshot.forEach(function (childkey) {
                        // console.log(childkey.key);
                        var key=childkey.key;
                        if(key!="video") {
                            get(child(dbRef, `users/` + id + '/' + key)).then((snapshot) => {
                                if (snapshot.exists()) {
                                    // console.log(snapshot.val());
                                    var username = snapshot.val().username;
                                    var img_url = snapshot.val().img_url;
                                    var record_url = snapshot.val().record_url;
                                    console.log()
                                    var record;
                                    var img;
                                    if (img_url != "no_link_img") {
                                        if (record_url != "no_link_record") {
                                            img = "<img src='" + img_url + " 'alt=\"Listen:\" style=\"width: 60%;  object-fit: contain\">\n";
                                        } else {
                                            img = "<img src='" + img_url + " 'alt=\"Listen:\" style=\"width: 100%;  object-fit: contain\">\n";

                                        }

                                    } else {
                                        img = " ";

                                    }
                                    if (record_url != "no_link_record") {
                                        record = "<audio controls><source src='" + record_url + "'></audio>";
                                    } else {
                                        record = " ";

                                    }
                                    console.log(record);
                                    var content = snapshot.val().content;
                                    var statuslaw = snapshot.val().status;
                                    var time = "<p style='color: silver; font-weight: bold; font-size: 10px; margin-left: 10px'>"+snapshot.val().date+"<img src='img/icon-clock.png' style='width: 20px; height: 13px; margin-left: 5px'></p>";
                                    var img_userwatch = '<?php echo "$img"?>';

                                    var myid = getmyid();
                                    var state_like = 0;
                                    if (statuslaw == 1) {

                                        // ------------------Count like----------
                                        get(child(dbRef, `users/` + id + '/' + key + '/like')).then((snapshot) => {
                                            var countlike = 0;
                                            if (snapshot.exists()) {

                                                snapshot.forEach(function (listlike) {
                                                    countlike++;

                                                    if (myid == listlike.key) {
                                                        state_like = 1;

                                                    } else {
                                                        state_like = 0;
                                                    }
                                                })

                                            } else {
                                                console.log("No data available");
                                            }
                                            var likeimg = "";
                                            if (state_like == 1) {
                                                likeimg = "<div id=" + 'like' + key + " class=\"like-start\"><a href=\"#\" onclick=\"return dislike_bai_viet('" + id + "','" + key + "')\"  class=\"like-start\"><img src=\"img/icon-at-like.png\" width=\"30\" height=\"30\"style=\"border-radius: 60px; margin: 2px\"></a></div>\n";

                                            } else {
                                                likeimg = "<div id=" + 'like' + key + " class=\"like-start\"><a href=\"#\" onclick=\"return like_bai_viet('" + id + "','" + key + "')\"  class=\"like-start\"><img src=\"img/icon-bf-like.png\" width=\"30\" height=\"30\"style=\"border-radius: 60px; margin: 2px\"></a></div>\n";

                                            }
                                            var strlaw = "";

                                            if (getid() == getmyid()) {
                                                strlaw = "<div class=\"dropdown\" style=\"width: 60%; float: right\">\n" +
                                                    "                            <button class=\"dropbtn\">...</button>\n" +
                                                    "                            <div class=\"dropdown-content\">\n" +
                                                    "                                <a href=\"#\" onclick=\"return delete_my_status('" + id + "','" + key + "')\">Delete</a>\n" +
                                                    "                                <a href=\"#\" onclick=\"return private_my_status('" + id + "','" + key + "')\">Private</a>\n" +
                                                    "                                <a href=\"#\" onclick=\"return public_my_status('" + id + "','" + key + "')\">Public</a>\n" +
                                                    "                            </div>\n" +
                                                    "                        </div>\n"

                                            } else {
                                                strlaw = "";
                                            }
                                            status = status + "<div class=\"share\" >\n" +
                                                "                <div class=\"share-info\">\n" +
                                                "                    <a href=\"#\"><img src=" + img_userwatch + " width=\"60\" height=\"60\"style=\"border-radius: 60px; margin: 2px\"></a>\n" +
                                                "                    <div class=\"share-name\">\n" +
                                                "                        <b>" + username + "</b>\n" +
                                                "                        <i>" + time + "</i>\n" + strlaw +

                                                "                    </div>\n" +
                                                "                </div>\n" +
                                                "                <div class=\"share-status\">\n" +
                                                "                    <p style='padding-left: 7px'>" + content + "</p>\n" +
                                                "                </div>\n" +
                                                "                <div class=\"share-video\">\n" +
                                                img +
                                                record +
                                                "                </div>\n" +
                                                "\n" +
                                                "\n" +
                                                "                <div class=\"count-like\">\n" +
                                                "                    <a href=\"#\"><img src=\"img/icon-like.png\" width=\"30\" height=\"30\"style=\"border-radius: 60px; margin: 2px\"></a>\n" +
                                                "                    <i  style='margin-left: 10px; font-weight: bold'>" + countlike + "</i>\n" +
                                                "                </div>\n" +
                                                "\n" +
                                                "                <div class=\"like-cmt\">\n" +
                                                likeimg +
                                                "                    <a href=" + "#" + key + " onclick=\"return display_cmt('" + id + "','" + key + "')\"   class=\"cmt-start\" ><img src=\"img/icon-cmt.png\" width=\"60\" height=\"30\"style=\"border-radius: 60px; margin: 2px\"></a>\n" +
                                                "                </div><div id=" + key + " class=\"user-cmt-box\"></div></div>";
                                            document.getElementById("tree").innerHTML = status;


                                            // console.log(status);


                                        }).catch((error) => {
                                            console.error(error);
                                        });
                                    } else if (getmyid() == getid()) {
                                        get(child(dbRef, `users/` + id + '/' + key + '/like')).then((snapshot) => {
                                            var countlike = 0;
                                            if (snapshot.exists()) {

                                                snapshot.forEach(function (listlike) {
                                                    countlike++;
                                                })

                                            } else {
                                                console.log("No data available");
                                            }
                                            var strlaw = "";
                                            var iconprivate = "<img src='img/download.png' width='20' height='20' style='border-radius: 10px'/>";
                                            if (getid() == getmyid()) {
                                                strlaw = "<div class=\"dropdown\" style=\"width: 60%; float: right\">\n" +
                                                    "                            <button class=\"dropbtn\">...</button>\n" +
                                                    "                            <div class=\"dropdown-content\">\n" +
                                                    "                                <a href=\"#\" onclick=\"return delete_my_status('" + id + "','" + key + "')\" >Delete</a>\n" +
                                                    "                                <a href=\"#\" style=\" background-color: yellow\" onclick=\"return private_my_status('" + id + "','" + key + "')\">Private</a>\n" +
                                                    "                                <a href=\"#\" onclick=\"return public_my_status('" + id + "','" + key + "')\">Public</a>\n" +
                                                    "                            </div>\n" +
                                                    "                        </div>\n"
                                            } else {
                                                strlaw = "";
                                            }
                                            status = status + "<div class=\"share\" >\n" +
                                                "                <div class=\"share-info\">\n" +
                                                "                    <a href=\"#\"><img src=" + img_userwatch + " width=\"60\" height=\"60\"style=\"border-radius: 60px; margin: 2px\"></a>\n" +
                                                "                    <div class=\"share-name\">\n" +
                                                "                        <b>" + username + "</b>\n" +
                                                "                        <i>" + time + "</i>\n" + iconprivate + strlaw +

                                                "                    </div>\n" +
                                                "                </div>\n" +
                                                "                <div class=\"share-status\">\n" +
                                                "                    <p>" + content + "</p>\n" +
                                                "                </div>\n" +
                                                "                <div class=\"share-video\">\n" +
                                                "                    <img src=" + img_url + " style=\"width: 100%; height: 80%; object-fit: contain\">\n" +
                                                "                    <audio controls>\n" +
                                                "                        <source src=" + record_url + ">\n" +
                                                "                    </audio>\n" +
                                                "                </div>\n" +
                                                "\n" +
                                                "\n" +
                                                "                <div class=\"count-like\">\n" +
                                                "                    <a href=\"#\"><img src=\"img/icon-like.png\" width=\"30\" height=\"30\"style=\"border-radius: 60px; margin: 2px\"></a>\n" +
                                                "                    <i style='margin-left: 10px; font-weight: bold'>" + countlike + "</i>\n" +
                                                "                </div>\n" +
                                                "\n" +
                                                "                <div class=\"like-cmt\">\n" +
                                                "                    <a href=\"#\" class=\"like-start\"><img src=\"img/icon-bf-like.png\" width=\"30\" height=\"30\"style=\"border-radius: 60px; margin: 2px\"></a>\n" +
                                                "                    <a href=" + "#" + key + " onclick=\"return display_cmt('" + id + "','" + key + "')\"   class=\"cmt-start\" ><img src=\"img/icon-cmt.png\" width=\"60\" height=\"30\"style=\"border-radius: 60px; margin: 2px\"></a>\n" +
                                                "                </div><div id=" + key + " class=\"user-cmt-box\"></div></div>";
                                            document.getElementById("tree").innerHTML = status;


                                            // console.log(status);


                                        }).catch((error) => {
                                            console.error(error);
                                        });
                                    }

                                } else {
                                    console.log("No data available");
                                }
                            }).catch((error) => {
                                console.error(error);
                            });
                        }
                        // -----------end foreach info status
                    })

                    // console.log(snapshot.toString());
                } else {
                    console.log("No data available");
                }
            }).catch((error) => {
                console.error(error);
            });

        }

        function show_del_video() {

            var elems = document.getElementsByClassName('icon_del_video');
            for (var i=0;i<elems.length;i+=1){
                elems[i].style.display = 'block';
            }
            var elems1 = document.getElementsByClassName('icon_del_video1');
            // get_more_video();
            for (var i=0;i<elems1.length;i+=1){
                elems1[i].style.display = 'block';
            }

        }
        window.show_del_video=show_del_video;
        // var bt=document.getElementById("addbt");
        // bt.addEventListener('click',function (){
        //     // writeUserData("111","huy","huy@","img/ha");
        //
        //
        // })
        var iduser=getid();
        read_status(iduser);
// ----------------------------------------------Show cmt---------------------------


        // var cmtbox=""
        // function show_cmt(cmtbox) {
        //     var str=
        //
        // }










        // const dbRef = ref(getDatabase());
        // get(child(dbRef, `users/111`)).then((snapshot) => {
        //     if (snapshot.exists()) {
        //         console.log(snapshot.val());
        //     } else {
        //         console.log("No data available");
        //     }
        // }).catch((error) => {
        //     console.error(error);
        // });
    </script>
    <style>
    #container{
        display: flex;
        width: 100%;
        padding: 10px;

    }
        #left{
            width: 20%;
            min-height: 500px;
            margin-right: 5%;
            display: flex;
            flex-direction: column;


        }

            #my-info{
                margin: 1px;
                padding: 1px;
                list-style: none;

            }
                #my-info li{
                    padding: 20px;
                    border-bottom: 1px solid silver;
                    border-radius: 20px;
                }
                #my-info li a{
                    text-decoration: none;
                    color: black;
                    text-align: center;
                }
                #my-info li a img{
                    border-radius: 10px;
                    width: 60px;
                    height: 60px;
                    padding-right: 20px;

                }
            #my-option{
                display: flex;
                width: 100%;
            }
            #my-option ul{
                text-decoration: none;
                list-style: none;
                padding: 1px;
                margin: 1px;
                background-color: snow;
                display: flex;
                flex-direction: column;
                width: 100%;
            }
                #my-option ul li{
                    padding: 20px;
                    border: 1px solid silver;
                    width: 85%;
                    height: 100%;
                    border-radius: 10px;
                }

                #my-option ul li:hover{
                    background-color: gainsboro;
                    width: 110%;
                    border-radius: 40px;
                }
                #my-option ul li .opt{
                        list-style: none;
                        text-decoration: none;
                        font-weight: bold;
                        font-size: 19px;
                        color: black;

                    }
                .opt:hover{
                    font-size: 20px;
                }
                    #my-option ul li .opt img{
                        border-radius: 10px;
                        padding-right: 40px;
                    }



        /*--------------------------------------------------------------------------------Center---*/
        #center{
            width: 80%;
            min-height: 1000px;
            margin-right: 2%;

        }
            #top-in-center{
                display: flex;
                padding: 5px;
                min-height: 200px;
                width: 98%;



            }
                #info-time-show{
                    margin-left: 10px;
                    width: 80%;
                    display: flex;
                }
                #info-time-show .infor-time{
                    border: 1px solid blue;
                    border-radius: 20px;

                    width: 25%;
                    min-height: 100px;
                    flex-direction: column;
                    margin-right: 7px;
                    padding: 2px;
                    text-align: center;
                }
                .infor-time{
                    border: none;
                    border-radius: 20px;
                    background-color: black;
                    width: 16%;
                    min-height: 100px;
                    flex-direction: column;
                    margin-right: 7px;
                    padding: 2px;
                    text-align: center;
                }

                    #titile-video{
                        width: 90%;
                        border: none;
                        border-radius: 10px;

                    }
                    #get-video{
                        position: relative;
                        font-family: calibri;
                        width:100px;
                        padding: 10px;
                        -webkit-border-radius: 5px;
                        -moz-border-radius: 5px;
                        border: 1px dashed #BBB;
                        text-align: center;
                        cursor: pointer;

                    }
                    #btn-input-video{
                        border-radius: 20px;
                        border: 1px solid deepskyblue;
                    }
                    #btn-input-video:hover{
                        background-color: deepskyblue;

                    }
                    #show_delete_video{
                        border-radius: 5px;
                        font-weight: bold;
                        background-color: snow;
                        border: 0px;
                        margin-top: 25px;

                    }
                    .user-avarta{
                        display: flex;
                        border: 1px solid lightskyblue;
                        border-radius: 100px;
                        height: 40px;
                        padding: 2px;
                        background-color: white;


                    }
                        .icon_del_video{
                            position: absolute;
                            display: none;
                            color: red;
                            margin-left: 80px;
                            margin-top: -20px;
                            text-decoration: none;
                            font-weight: bold;
                            text-align: center;
                        }
                        .icon_del_video1{
                            position: relative;
                            color: red;
                            /*margin-left: 100px;*/
                            /*margin-top: -20px;*/
                            text-decoration: none;
                            font-weight: bold;
                            display: none;
                         }
                        .icon_del_video:hover{
                            background-color: black;
                            color: white;
                            font-size: 15px;
                            height: 30px;
                            width: 20px;
                            border-radius: 10px;
                            text-align: center;
                            transition: 1s;
                        }
                        .icon_del_video1:hover{

                            color: red;
                            font-size: 25px;
                            height: 30px;
                            width: 20px;
                            border-radius: 10px;
                            text-align: center;
                            transition: 1s;
                        }
                    .user-avarta .header-video{
                        font-size: 10px;
                        font-style: italic;
                        }
                    .user-avarta a img{
                        width: 40px;
                        hight:40px;
                        border-radius: 20px;
                    }

                    .user-name{
                        width: 100%;
                       
                    }
                    .user-name .video{
                        width: 100%;
                        height: 140px;
                        border-radius: 20px;

                    }

            .status{
                display: flex;
                flex-direction: column;
                min-height: 180px;
                background-color: snow;
                margin: 10px;
                width: 96%;
                border-radius: 25px;
                border-bottom: 4px solid silver;
                border-top: 2px solid black;
            }
                #get-status{
                    display: flex;
                    height: 70%;
                    border-radius: 20px;
                }
                    #content-status{
                        width: 75%;
                        border: none;
                        border-bottom: 1px solid silver;
                        border-radius: 10px;
                    }
                    #submitform{
                        border-radius: 30px;
                        width: 15%;
                        border: none;
                        background-color: lightskyblue;
                        font-style: italic;
                        color: white;
                    }
                #option{
                    height:30% ;
                    display: flex;
                }
                    #load-ghi-am{
                        display: flex;
                        width: 50%;

                     }
                        #info-record{
                            width: 80%;
                            display: flex;
                            flex-direction: column;
                        }
                            #info-record label{
                                color: white;
                                font-style: italic;
                                font-size: 20px;
                            }
                            #info-record #record{
                                padding:10px;
                                border: none;
                                border-radius: 5px;
                                width: auto;
                            }
                    #load-hinh-anh{
                        display: flex;
                        height: 50%;
                    }
                        #info-img{
                            width: 80%;
                            display: flex;
                            flex-direction: column;
                        }
                            #info-img label{
                                color: white;
                                font-style: italic;
                                font-size: 20px;
                            }
                            #info-img #img{
                                padding:4px;
                                border: none;
                                border-radius: 5px;
                                width: auto;
                            }


            .share{
                /*border: 1px solid yellow;*/
                box-shadow: 2px 3px 9px 1px lightsteelblue;
                border-radius: 30px;
                height: auto;
                display: flex;
                flex-direction: column;
                width: 100%;
                margin-bottom: 5px;
            }
                .share-info{
                    display: flex;
                    padding: 3px;
                    width: 100%;
                    border-radius: 20px;
                    background-color: white;

                }
                    .share-name{
                        display: flex;
                        flex-direction: column;
                        width: 70%;
                        min-height: 40px;
                        padding-top: 8px;
                    }

                    .share-status{
                        background-color: white;
                        width: 100%;
                    }
                    .share-video{
                        height: auto;
                        background-color: white;
                        width: 100%;

                    }
                    .count-like{
                        display: flex;
                        text-align: center;
                        padding-left: 20px;
                        border-top: 1px solid silver;
                        border-bottom: 1px  solid silver;
                    }
                        .count-like i{
                            margin-top: 10px;
                        }
                    .like-cmt{
                        display: flex;
                        width: 100%;
                    }

                    .user-cmt-box{
                        display: flex;
                        width: 100%;
                        flex-direction: column;
                    }
                        .user-set-cmt-box{
                            display: flex;
                            text-align: center;

                        }
                            .like-start{
                                text-align: center;
                                width: 50%;
                            }
                            .like-start:hover{
                                background-color: gainsboro;
                                width: 60%;
                                border-radius: 40px;
                            }
                            .cmt-start{
                                text-align: center;
                                width: 50%;
                            }
                            .cmt-start:hover{
                                background-color: gainsboro;
                                width: 60%;
                                border-radius: 40px;

                            }

                            .cmt{
                                width: 20%;
                                border: none;
                                border-bottom: 1px solid black;

                                min-height: 40px;
                                background-color: whitesmoke;
                                transition: width 3s;
                            }
                            /*.cmt:hover{*/
                            /*    width: 90%;*/
                            /*    background-color: white;*/
                            /*}*/

                            .send{
                                width: 10%;
                                border: none;
                                background-color: lightskyblue;
                                color: white;
                                font-weight: bold;
                                min-height: 40px;
                                font-size: 15px;

                            }
                            .send:hover{
                                font-size: 30px;
                                background-color: #00A1D3;
                            }
                        .listCmt{

                            }
                            .listCmt ul{
                                padding: 2px;
                                margin: 2px;

                            }
                                .listCmt ul li{
                                    list-style: none;


                                }
                                    .opt-cmt{
                                        display: flex;
                                        background-color: white;
                                        padding-left: 80px;

                                    }

                                    .show-cmt-uid{

                                        border-radius: 30px;
                                        border-bottom: 1px solid lightgreen;
                                        box-shadow: 2px 4px 6px lightskyblue;

                                    }
                                        .show-cmt-uid audio{
                                            margin-left: 35%;
                                            
                                        }
                                        .show-cmt-uid p{
                                            margin-left: 10px;
                                        }
                                        .like-cmt-user-rep{

                                        }
                                            .like-user-rep{
                                                padding-right: 15px;

                                            }

                                            .cmt-user-rep{

                                            }



        #right{

            width: 15%;
            height: 800px;
            overflow-y: scroll;
            display: none;


        }
            ::-webkit-scrollbar{
                width: 10px;

            }

            .video-more{
                height: auto;
                margin-bottom: 5px;




            }
            .video-more lable{

                display: flex;
                flex-direction: column;
            }
                .video-more label{
                    background-color: white;
                    font-style: italic;
                    font-weight: bold;
                }
                .video-more video{
                    width: 100%;
                    height: 160px;

                }
    </style>
<!--    ---------------------css-------------->
    <style>
        /* Style The Dropdown Button */
        .dropbtn {
            background-color: white;
            color: black;
            padding: 10px;
            font-size: 15px;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }

        /* The container <div> - needed to position the dropdown content */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        /* Dropdown Content (Hidden by Default) */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 120px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        /* Links inside the dropdown */
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        /* Change color of dropdown links on hover */
        .dropdown-content a:hover {background-color: #f1f1f1}

        /* Show the dropdown menu on hover */
        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* Change the background color of the dropdown button when the dropdown content is shown */
        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }
    </style>

</head>
<body>
<div id="container">
    <div id="left">
        <div id="my-info">
            <li><a href="#" class="opt"><?php echo "<img src=".$img.">".$name ?></a></li>
            <b style="text-align: center">ID: <?php echo "$id"?></b>
        </div>
        <hr>
        <div id="my-option">
            <ul >
                <li><a href="list_friend.php?myid=<?php echo "$id" ?> " class="opt"  >
                        <img src="img/icon-mess.png" style="height: 40px; width: 40px">Messeger</a></li>
                <li><a href="interface_mxh.php?iduser=<?php echo $_SESSION['id']?>" class="opt"><img src="img/icon-home.png" style="height: 40px; width: 40px">My-Page</a></li>
                <li><a href="index.php" class="opt"><img src="img/icon-youtube.png" style="height: 40px; width: 40px">My-Karaoke</a></li>
                <li><a href="my_record.php" class="opt"><img src="img/icon-list.jpg" style="height: 40px; width: 40px">My-Voice</a></li>
            </ul>
        </div>


    </div>
    <div id="center">
        <div id="top-in-center">

            <?php
            if($status==1){
            ?>
                <div class="infor-time" id="info-time-me">
                    <div class="user-avarta">
                        <a href="#"><img src="<?php echo "$img";?>"></a>
                        <a href="#" style="margin-left: 9%" onclick="show_input_video();"><span class="material-icons">
                                                                                control_point
                                                                                </span></a>
                    </div>
                    <div class="user-name" id="input-video-box">


                    </div>
                    <div>
                        <button id="show_delete_video" onclick="show_del_video()" >Xóa video</button>
                    </div>
                </div>
            <?php }

            ?>
            <div id="info-time-show">

            </div>


            <div id="list-info-time" style="width: 12%; background-color: white">
                <div id="mui-ten-di-chuyen" style="margin-top: 60%; width: 100%;" >
                    <a href="#" onclick="get_more_video()"><img src="img/1200x1200.gif"  style="width: 100%";></a>
                </div>

            </div>
        </div>

        <?php
                if($status==1){


        ?>
        <div class="status">
                <div id="get-status">

                    <a href="#"><?php echo "<img width='100' height='100' style='border-radius: 80px' src=".$img.">"?></a>
                    <textarea name="content-status" id="content-status" placeholder="Bạn đang nghĩ gì ..."></textarea>
                    <button   id="submitform" <?php echo"value=".str_replace( ' ', '-', $name) ?>><span class="material-icons">
send
</span>
                    </button>
                </div>
                <hr>
            <form method="POST" enctype="multipart/form-data">
            <div id="option">
                    <div id="load-ghi-am">
                        <img src="img/icon-add-record.png" width="60" height="60" style="border-radius: 60px; margin: 2px">
                        <div id="info-record">
                            <label>Record</label>
                            <input type="file" name="record"   accept=".mp3, .wav " id="record" value="Record add">
                        </div>
                    </div>

                    <div id="load-hinh-anh">
                        <img src="img/icon-img.png" width="60" height="60"style="border-radius: 60px; margin: 2px">
                        <div id="info-img">
                            <label>IMG</label>
                            <input type="file" name="img"  accept="image/x-png,image/gif,image/jpeg" id="img">
                        </div>

                    </div>
                </div>
            </form>
        </div>
        <?php
                }else{

                }

        ?>
        <div class="tree" id="tree">


        </div>
    </div>
    <div id="right">



    </div>

</div>

<script>

</script>
</body>
</html>
