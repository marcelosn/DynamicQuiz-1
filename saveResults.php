<?php
 	session_start();
    include("config.php");
    //include("session.php");

	header("Content-Type: application/json; charset=UTF-8");
	if (array_key_exists('catagory', $_POST) && array_key_exists('correct', $_POST) && array_key_exists('wrong', $_POST)&& array_key_exists('hintsUsed', $_POST)&& array_key_exists('catQuestions', $_POST)) {

    // do stuff with params

} else {
    echo 'Invalid parameters!';
}

    $catagory =  $_POST['catagory'];
	$correct =  $_POST['correct'];
	$wrong =  $_POST['wrong']
	$hintsUsed =  $_POST['hintsUsed']
	$catQuestions =  $_POST['catQuestions'];
	
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