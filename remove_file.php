<?php
if(isset($_POST['path'])){
    $path=$_POST['path'];
    if (file_exists($path)) {
        unlink($path);
        echo"ok";

    } else {
        // File not found.
    }

}
?>
