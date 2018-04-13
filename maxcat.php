<?php
include("config.php");
    
    $conn = mysqli_query($db, "SELECT DISTINCT catagory FROM questions");


if (!$conn) {
        echo 'MySQL Error: ' . mysqli_error($db);
        exit;
    }
    $result = mysqli_fetch_assoc($conn);
    $maxcat = mysqli_num_rows($conn);

/*while($rs = mysqli_fetch_assoc($conn)) {
    $data[] = $rs;
}*/

//$conn->close();

echo $maxcat;
?>