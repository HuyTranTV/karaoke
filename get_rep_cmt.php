<?php
$id_cmt = $_GET['id_cmt'];
$id_video=$_GET['id_video'];
require 'cn.php';
$sql1 = 'SELECT * FROM `rep_cmt` WHERE id_video="#QWGpww" and ID_CMT="1321"';
$result1 = mysqli_query($link, $sql1);
$arr2=array();
$dem=0;
while($rows2=mysqli_fetch_array($result1))
{
    $dson=json_encode($rows2);
    $arr2[$dem]=$dson;
    $dem++;
}
$encode=json_encode($arr2);
echo $encode;

?>