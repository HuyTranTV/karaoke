<?php
require 'cn.php';

if(isset($_POST['id'])){
    $content=$_POST['id'];
    $sql="select * from `user` where ID_USER like '%$content%'";
    $result=mysqli_query($link,$sql);
    $str="";

    while ($rows=mysqli_fetch_assoc($result)){
        $name=$rows['HOTEN_USER'];
        $id=$rows['ID_USER'];
        $img=$rows['hinhanh'];
        $str=$str." <div id=\"name-user\">
                    <img src=".$img." style=\"width: 60px;height: 60px;border-radius: 30px\">
                    <p>$name</p>
                </div>
                <div id=\"mess-box\">                                  
                   <div id=\"show-mess\">
                   
                    </div>
                </div>
                <div id=\"my-send-mess-box\">
                    <a onclick=\"show_opt_box_cmt()\"><img src=\"img/iconadd.jpg\" style=\"width: 30px; height: 30px;border-radius: 20px\"></a>

                    <div id=\"opt-send-mess\" style=\"display: none\">
                        <ul>
                            <form method=\"POST\" enctype=\"multipart/form-data\" >
                                <li><img src=\"img/icon_add_record.png\" style=\"width: 40px; height: 40px;border-radius: 20px\"> <input type=\"file\" name=\"audio\" id=\"audio\"></li>
                                <li><img src=\"img/icon-youtube.png\" style=\"width: 40px; height: 40px;border-radius: 20px\"> <input type=\"file\" name=\"video\" id=\"video\"></li>
                                <li><img src=\"img/icon-img.png\" style=\"width: 40px; height: 40px;border-radius: 20px\"> <input type=\"file\" name=\"img\" id=\"img\"></li>
                            
                            <li><a><img src=\"img/icon-list.jpg\" style=\"width: 40px; height: 40px;border-radius: 20px\"></a></li>
                            <li>
                                <ul id=\"checked-record\">
                                    <li> <input type=\"checkbox\" name=\"myrecord\" value=\"bai1\"/> <label>bai1</label> <br/></li>
                                    <li> <input type=\"checkbox\" name=\"myrecord\" value=\"bai2\"/> <label>bai2</label> <br/></li>
                                    <li> <input type=\"checkbox\" name=\"myrecord\" value=\"bai3\"/> <label>bai3</label> <br/></li>
                                </ul>
                            </li>
                            </form>
                            
                        </ul>

                    </div>
                    <div id=\"send-mess\">
 
                    </div>
                </div>";

    }
    echo"$str";


}
else{
    echo "no";
}
?>


