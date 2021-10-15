<?php
require 'cn.php';
session_start();
//setcookie("id", "111222", time() + 60000000, "/");

if(isset($_POST['iduser']) and isset($_POST['tenuser']) and isset($_POST['anhdaidien']) and isset($_POST['email']))
{
    $iduser=mb_substr($_POST['iduser'],0,10);
    $tenuser=$_POST['tenuser'];
    $anhdaidien=$_POST['anhdaidien'];
    $email=$_POST['email'];
    setcookie("id", $iduser, time() + 6000000, "/");
    $_SESSION['id']=$iduser;
    $_SESSION['username']=$tenuser;
    $_SESSION['imguser']=$anhdaidien;
//    echo"$iduser-$tenuser-$email-$anhdaidien";
    $sql="INSERT INTO `user`(`ID_USER`, `HOTEN_USER`, `SDT_USER`, `EMAIL_USER`, `hinhanh`) VALUES ('$iduser','$tenuser','' ,'$email','$anhdaidien')";
    if($result=mysqli_query($link,$sql)){
        echo "Đăng nhập thành công";
        echo $_COOKIE['id'];
    }
    else{
        $sql1="UPDATE `user` SET `HOTEN_USER`='$tenuser',`SDT_USER`=' ',`EMAI_USER`='$email',`hinhanh`='$anhdaidien' WHERE `ID_USER`='$iduser'";
        if($result1=mysqli_query($link,$sql1)){
            echo "Login success";
        }
        else{
            echo "Login Fail";
        }


    }

}
else{
    echo"Login Fail !!!";
}
?>
