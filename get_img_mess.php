<?php

if(isset($_GET['idroom'])){
    $idroom=$_GET['idroom'];
    $path_img="chats/img/".$idroom;

    if(mkdir($path_img,0700)){
        if ( 0 < $_FILES['file']['error'] ) {
            $link1="0";
        }
        else {
            move_uploaded_file($_FILES['file']['tmp_name'], $path_img."/".$_FILES['file']['name']);
            $link1=$_FILES['file']['name'];
        }
    }else{
        if ( 0 < $_FILES['file']['error'] ) {
            $link1="0";
        }
        else {
            move_uploaded_file($_FILES['file']['tmp_name'], $path_img."/".$_FILES['file']['name']);
            $link1=$_FILES['file']['name'];
        }

    }
}else{
    echo"fales";

}
?>
