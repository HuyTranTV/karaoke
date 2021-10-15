
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        #download{
            border: 0px;
            text-align: center;
            width: 120px;
            border-radius: 10px;
            padding: 10px;
            background: lightgreen;
            font-size: 15px;
            color: whitesmoke;
        }
        #download:hover{
            width: 140px;
            border-radius: 10px;
            color: black;

        }
    </style>
</head>
<body>
<?php
$id=$_POST['id'];
$namefile=$_POST['name'];
$tone=$_POST['tone'];

//echo exec("tree /f");
//
//echo exec("dir");
//$output=exec("python  D:\Xamp\htdocs\karaoke\upload_my_record\pitch.py huyhat F#min");
//$output = exec($command);

//$command="upload_my_record/cogiangtinhFmin_tuned.wav";
$command = `python D:\\Xamp\\htdocs\\karaoke\\upload_my_record\\pitch.py $namefile $tone`; //Chuyển mã trong tập tin test.py thành các lệnh
//

echo "<a href='$command' id='download' download>Download</a>";

echo"<audio controls>
<source src='$command'>
</audio>";
echo"Bài hát $namefile với tone $tone";
?>
</body>
</html>



