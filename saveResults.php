<?php
 	session_start();
    include("config.php");
    //include("session.php");

	header("Content-Type: application/json; charset=UTF-8");
	$obj = json_decode($_GET["x"]);

    $catagory =  (int)"$obj->catagory";
	$correct =  (int)"$obj->correct";
	$wrong =  (int)"$obj->wrong";
	$hintsUsed =  (int)"$obj->hintsUsed";
	$catQuestions =  (int)"$obj->catQuestions";
	
    echo "$myid";

	$sql = "INSERT INTO  results (id, catagory,correct,wrong, hintsUsed, catQuestions) VALUES ($myid, $catagory, $correct,$wrong, $hintsUsed, catQuestions) ON DUPLICATE KEY UPDATE correct=$correct, wrong = $wrong, hintsUsed=$hintsUsed;";
		echo "got info";
		/*

		if (mysqlki_query($db, $sql)) === TRUE) {
    echo "question saved!";
	} else {
    echo "Error: " . $sql . "<br>" . $db->error;
	}*/

    ?>