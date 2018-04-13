<?php
 include("config.php");
 //session_start();
   //include("quiz.php")
   //echo "hi i'm working"; 
   //header("Content-Type: application/json; charset=UTF-8");
   
    $obj = json_decode($_GET["x"]);
   //$obj = $_REQUEST["x"];
    
    $i = "$obj->catagory";
    
    $conn = mysqli_query($db, "SELECT * FROM questions WHERE catagory = $i");


if (!$conn) {
        echo 'MySQL Error: ' . mysqli_error($db);
        exit;
    }
    $result = mysqli_fetch_assoc($conn);
    $cat_num = mysqli_num_rows($conn);

/*while($rs = mysqli_fetch_assoc($conn)) {
    $data[] = $rs;
}*/

//$conn->close();

echo $cat_num;
?>