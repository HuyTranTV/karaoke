<?php
require 'cn.php';
if(isset($_POST['content'])){
    $content=$_POST['content'];
    $sql="select * from `user` where ID_USER like '%$content%'";
    $result=mysqli_query($link,$sql);
    $str="";

        echo "<ul>";
        while ($rows=mysqli_fetch_assoc($result)){
            $name=$rows['HOTEN_USER'];
            $id=$rows['ID_USER'];
            $img=$rows['hinhanh'];
            $str=$str." <li class=\"list-user-mess\"><a href=\"interface_mxh.php?iduser=$id\"  ><img src=".$img." ></a><a href=\"#\" style='width: 100%'  onclick='get_mess($id)'><p style='margin-left: 10px'>$name</p></a></li>";

        }
        echo"$str";
        echo"</ul>";


}
else{
    echo "no";
}
?>

