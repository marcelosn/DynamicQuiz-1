<?php
 	session_start();
    include("config.php");
    //include("session.php");

    
	header("Content-Type: application/json; charset=UTF-8");
	$data = json_decode(file_get_contents("php://input"));




     $catagory =  mysqli_real_escape_string($db, $data->catagory);
	$correct =  mysqli_real_escape_string($db, $data->correct);
	$wrong =  mysqli_real_escape_string($db, $data->wrong);
	$hintsUsed =  mysqli_real_escape_string($db, $data->hintsUsed);
	$catNum = mysqli_real_escape_string($db, $data->catNum);

   
	 $dt = new DateTime();
	 $date = $dt->format('Y-m-d H:i:s');
	 //echo $date;

    $userID= $_SESSION['login_user'];
    

	$sql = mysqli_query($db, "INSERT INTO  results (id, catagory,correct,wrong, hintsUsed, catQuestions, timesubmitted) VALUES ($userID, $catagory, $correct,$wrong, $hintsUsed, $catNum, '$date')");

		if ($sql === TRUE) {
    echo "question saved!";
	} else {
    echo "Error: " . $sql . "<br>" . $db->error;
	}

    ?>