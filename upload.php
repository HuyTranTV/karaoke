<?php
$path_img="users/img/".$_COOKIE['id'];
$path_record="users/record/".$_COOKIE['id'];
$path_img1="users/img/".$_COOKIE['id']."/".$_GET['uid'];
$path_record1="users/record/".$_COOKIE['id']."/".$_GET['uid'];
//mkdir($path_img, 0700);
//mkdir($path_record, 0700);
//echo $_FILES['file']['name'];
//echo $_FILES['file1']['name'];

//mkdir($path_img1, 0700);
//mkdir($path_record1, 0700);
//move_uploaded_file($_FILES['file']['tmp_name'], $path_record1."/".$_FILES['file']['name']);
//
//move_uploaded_file($_FILES['file1']['tmp_name'], $path_img1."/".$_FILES['file1']['name']);

if(mkdir($path_img, 0700)){
        if(mkdir($path_img1, 0700)){
            if ( 0 < $_FILES['file1']['error'] ) {
                $link1="0";
            }
            else {
                move_uploaded_file($_FILES['file1']['tmp_name'], $path_img1."/".$_FILES['file1']['name']);
                $link1=$_FILES['file1']['name'];
            }

        }
        else{
            if ( 0 < $_FILES['file1']['error'] ) {
                $link1="0";
            }
            else {
                move_uploaded_file($_FILES['file1']['tmp_name'], $path_img1."/".$_FILES['file1']['name']);
                $link1=$_FILES['file1']['name'];
            }
        }


}
elseif(mkdir($path_img1, 0700)){
            if ( 0 < $_FILES['file1']['error'] ) {
                $link1="0";
            }
            else {

                move_uploaded_file($_FILES['file1']['tmp_name'], $path_img1."/".$_FILES['file1']['name']);
                $link1=$_FILES['file1']['name'];
            }

        }
        else{
            if ( 0 < $_FILES['file1']['error'] ) {
                $link1="0";
            }
            else {
                move_uploaded_file($_FILES['file1']['tmp_name'], $path_img1."/".$_FILES['file1']['name']);
                $link1=$_FILES['file1']['name'];
            }
        }


//----------------------------record
if(mkdir($path_record, 0700)) {
    if (mkdir($path_record1, 0700)) {
        if (0 < $_FILES['file']['error']) {
            $link = "0";
        } else {
            move_uploaded_file($_FILES['file']['tmp_name'], $path_record1."/".$_FILES['file']['name']);
            $link = $_FILES['file']['name'];
        }

    } else {
        if (0 < $_FILES['file']['error']) {
            $link = "0";
        } else {
            move_uploaded_file($_FILES['file']['tmp_name'], $path_record1."/".$_FILES['file']['name']);
            $link = $_FILES['file']['name'];
        }
    }
}

elseif(mkdir($path_record1, 0700)){
    if ( 0 < $_FILES['file']['error'] ) {
                $link="0";
            }
            else {
                move_uploaded_file($_FILES['file']['tmp_name'], $path_record1."/".$_FILES['file']['name']);
                $link=$_FILES['file']['name'];
            }

        }
        else{
            if ( 0 < $_FILES['file']['error'] ) {
                $link="0";
            }
            else {
                move_uploaded_file($_FILES['file']['tmp_name'], $path_record1."/".$_FILES['file']['name']);
                $link=$_FILES['file']['name'];
            }
        }


//
//$linkshare=$link1.";".$link;
//setcookie( "link", "", time()- 60, "/","", 0);
//
//if ( 0 < $_FILES['file']['error'] ) {
//    echo 'Error: ' . $_FILES['file']['error'] . '<br>';
//}
//else {
//    move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $_FILES['file']['name']);
//}

?>
