<?php
require 'cn.php';
if(isset($_POST['cmtcontent'])&&isset($_POST['idvideo'])&&isset($_POST['me'])){
    $idcmt=rand();
    echo"$idcmt";
    $cmtcontent=$_POST['cmtcontent'];
    $idvideo=$_POST['idvideo'];
    $me=$_POST['me'];

    $sql="INSERT INTO `comment`(`ID_CMT`, `ID_USER`, `NOIDUNG`, `id_video`) VALUES ('$idcmt','$me','$cmtcontent','$idvideo')";
    $result=mysqli_query($link,$sql);
    if($result==true){

    }else{

    }

}
?>