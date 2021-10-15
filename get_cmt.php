<?php

require 'cn.php';
$sql1 = "SELECT * FROM `comment` WHERE 1";
$result1 = mysqli_query($link, $sql1);
if(mysqli_num_rows($result1)>0){
    while ($rows2 = mysqli_fetch_array($result1)) {
        echo `<div class="comment-user">
                    <b id="username">user</b>
                    <p class="comment-content" id="content">noidug khong co gi het vui long nhap lai</p>
                    <div class="status">
                        <p>28/03/2021</p>
                        <a href="#">Trả lời</a>
                    </div>
                    <div class="rep-comment-user">
                        <b id="rep-username">user</b>
                        <p class="comment-content" id="rep-comment">noidug khong co gi het vui long nhap lai</p>
                        <b id="rep-username">user</b>
                        <p class="comment-content" id="rep-comment">noidug 2 khong co gi het vui long nhap lai</p>
                        <b id="rep-username">user</b>
                        <p class="comment-content" id="rep-comment">noidug 3 khong co gi het vui long nhap lai</p>
                    </div>
                </div>`;
    }
}




?>