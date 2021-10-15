<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php
$myid= $_POST['myid'];

?>
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
    function get_record(){
        var myid="1176460198";
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
    get_record();
</script>

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
                <li class="nav-item active">
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Lọc theo tháng
                        </button>
                        <div class="dropdown-menu" id="price-level">
                            <a class="dropdown-item" href="#"> Tháng này </a>
                            <a class="dropdown-item" href="#"> 1 </a>
                            <a class="dropdown-item" href="#"> 2 </a>
                            <a class="dropdown-item" href="#"> 3 </a>
                            <a class="dropdown-item" href="#"> 4 </a>
                            <a class="dropdown-item" href="#"> 5 </a>
                            <a class="dropdown-item" href="#"> 6 </a>
                            <a class="dropdown-item" href="#"> 7 </a>
                            <a class="dropdown-item" href="#"> 8 </a>
                            <a class="dropdown-item" href="#"> 9 </a>
                            <a class="dropdown-item" href="#"> 10 </a>
                            <a class="dropdown-item" href="#"> 11 </a>
                            <a class="dropdown-item" href="#"> 12 </a>
                        </div>
                    </div>
                </li>
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
            </ul>
        </div>
    </div>
</nav>
<div id="hien-thi-san-pham">
<!--    <div class="record" >-->
<!--        <p style="text-align: center"> 10/5/2021</p>-->
<!--        <h5 style="text-align: center">name</h5>-->
<!--        <audio controls style="width: 90%">-->
<!--            <source src="yeumotnguoikara.mp3">-->
<!--        </audio>-->
<!--        <button type="button" class="btn btn-danger " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
<!--            Auto tune-->
<!--        </button>-->
<!--    </div>-->

    </div>
