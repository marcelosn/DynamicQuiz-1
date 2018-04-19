<?php
 include("config.php");
 session_start();
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
    //echo $cat_num;

    $conn2 = mysqli_query($db, "SELECT catName FROM videos WHERE catagory = $i");
    $result = mysqli_fetch_assoc($conn2);
    $obj->numQues = $cat_num;
    $obj->catName = $result['catName'];


     //$obj = array($numQues, $catName);

/*while($rs = mysqli_fetch_assoc($conn)) {
    $data[] = $rs;
}*/

//$conn->close();

echo json_encode($obj)
?>