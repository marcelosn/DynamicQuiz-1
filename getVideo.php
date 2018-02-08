<?php
 include('config.php');
 session_start();

 $obj = json_decode($_GET["x"]);
 $catagory = "$obj->catagory";
 //echo $catagory;

 $result = mysqli_query($db, "SELECT * FROM videos WHERE catagory = $catagory;");
$video = mysqli_fetch_assoc($result);

 $url = $video["url"];
 echo $url;
 ?>
