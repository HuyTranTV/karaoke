<?php


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $path_video = 'users/video/'.$id;
    echo "$id-----$path_video";
    if (mkdir($path_video, 0700)) {
        if (0 < $_FILES['file']['error']) {
            $link1 = "0";
        } else {
            move_uploaded_file($_FILES['file']['tmp_name'], $path_video . "/" . $_FILES['file']['name']);
            $link1 = $_FILES['file']['name'];
        }
    } else {
        if (0 < $_FILES['file']['error']) {
            $link1 = "0";
        } else {
            move_uploaded_file($_FILES['file']['tmp_name'], $path_video . "/" . $_FILES['file']['name']);
            $link1 = $_FILES['file']['name'];
        }

    }
} else {
    echo "fales";

}

?>
