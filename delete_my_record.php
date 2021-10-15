<?php
print_r($_POST['checkbox']);
require 'cn.php';
session_start();

if (isset($_POST['checkbox'])) {
    echo $_SESSION['id'];
    $id = $_SESSION['id'];
    foreach ($_POST['checkbox'] as $key => $value) {
//$key: key của phần tử đang được duyệt
//$value: Giá trị của phần tử đang được duyệt
// Xử lý tác động vào các phần tử của mảng
        echo "$key";
        echo "$value";




//----------------------------record


        $sql1="SELECT * FROM `record` WHERE ID_RECORD='$value' and ID_USER='$id'";
        $result1=mysqli_query($link,$sql1);
        if(mysqli_num_rows($result1)>0){
            $rows1=mysqli_fetch_assoc($result1);
            $path=$rows1['LINK'];
              if (file_exists($path)) {
                unlink($path);
              } else
                  {
                        // File not found.
                    }
        }
        $sql = "DELETE FROM `record` WHERE ID_RECORD='$value' and ID_USER='$id'";

                if($result=mysqli_query($link,$sql)){
                    echo "<script> alert('Upload Successfully')</script>";


                }else{

                }




    }
} else {
    echo "<script> console.log('not file')</script>";
}
header('location:my_record.php');

?>


