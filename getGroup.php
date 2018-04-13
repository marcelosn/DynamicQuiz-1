<?php
 include("config.php");
 session_start();
 
   $userID= $_SESSION['login_user'];

   //echo $userID;
   
    
    $conn = mysqli_query($db, "SELECT studentgroup FROM studentlist WHERE id = '$userID'");


if (!$conn) {
        echo 'MySQL Error: ' . mysqli_error($db);
        exit;
    }
    $result = mysqli_fetch_assoc($conn);

/*while($rs = mysqli_fetch_assoc($conn)) {
    $data[] = $rs;
}*/

//$conn->close();

echo $result["studentgroup"];
?>