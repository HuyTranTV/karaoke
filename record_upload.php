<?php

require 'cn.php';
session_start();
if (isset($_FILES['file'])) {
    echo $_SESSION['id'];
    $id = $_SESSION['id'];
    foreach ($_FILES['file']['name'] as $key => $value) {
//$key: key của phần tử đang được duyệt
//$value: Giá trị của phần tử đang được duyệt
// Xử lý tác động vào các phần tử của mảng
        echo "$key";
        echo "$value";

        $path_record1 = "upload_my_record/" . $value;


//----------------------------record




        $sql = "INSERT INTO `record`( `ID_USER`, `LINK`, `Name`) VALUES ('$id','$path_record1','$value')";

            if(move_uploaded_file($_FILES['file']['tmp_name'][$key], $path_record1)==true){
                if($result=mysqli_query($link,$sql)){
                    echo "<script> alert('Upload Successfully')</script>";

                }else{

                }

            }else{
                if($result=mysqli_query($link,$sql)){
                    echo "<script> alert('Upload Successfully')</script>";

                }else{

                }

            }


    }
} else {
    echo "<script> console.log('not file')</script>";
}
//header('location:my_record.php');

?>
