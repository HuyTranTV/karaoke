<?php
require 'cn.php';
if(isset($_POST['idcmt'])&&isset($_POST['comment'])&&isset($_POST['me'])){
    $idcmt=$_POST['idcmt'];
    $comment=$_POST['comment'];
    $me=$_POST['me'];
    echo "$idcmt-$comment-$me";
    $sql="INSERT INTO `rep_cmt`(`ID_CMT`, `ID_USER`, `NOIDUNG`) VALUES ('$idcmt','$me','$comment')";
    $result=mysqli_query($link,$sql);
    if($result){
            echo "<p>$comment</p>";
    }else{
        echo "Vui lòng nhập comment";
    }

}
?>