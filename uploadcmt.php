<?php


if(isset($_GET['id'])&& isset($_GET['idcmt'])&& isset($_GET['uid'])){
    $id=$_GET['id'];
    $uid=$_GET['uid'];
    $id_cmt=$_GET['idcmt'];
    $path_record="users/record/".$id."/".$uid."/".$id_cmt;
    echo"$id-$uid-$id_cmt-----$path_record";
    if(mkdir($path_record,0700)){
        if ( 0 < $_FILES['file']['error'] ) {
            $link1="0";
        }
        else {
            move_uploaded_file($_FILES['file']['tmp_name'], $path_record."/".$_FILES['file']['name']);
            $link1=$_FILES['file']['name'];
        }
    }else{
        if ( 0 < $_FILES['file']['error'] ) {
            $link1="0";
        }
        else {
            move_uploaded_file($_FILES['file']['tmp_name'], $path_record."/".$_FILES['file']['name']);
            $link1=$_FILES['file']['name'];
        }

    }
}else{
    echo"fales";

}
?>
