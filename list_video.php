<?php
require 'cn.php';

if(isset($_POST['content'])){
    $name_video=$_POST['content'];


    $sql="SELECT `ID_VIDEO`, `NAME_VIDEO`, `HINHANH_VIDEO`, `HOT` FROM `video` WHERE NAME_VIDEO LIKE '%$name_video%'";
    $result=mysqli_query($link,$sql);
    if(mysqli_num_rows($result)>0){

        while ($rows=mysqli_fetch_assoc($result)){
            $img=$rows['HINHANH_VIDEO'];
            $id=$rows['ID_VIDEO'];
            $name=$rows['NAME_VIDEO'];
            $str_img="<a id=\"imgvideo\" href=\"sing.php?id=$id&&name=$name&&img=$img\"><img  height=\"250\" src=\"$img\"></a>";
            $str_name="<a id=\"titile\" href=\"sing.php?id=$id&&name=$name&&img==$img\">$name</a>";
            echo "<div class=\"videos\">'.$str_img.$str_name.'</div>";
        }
    }

}
?>
