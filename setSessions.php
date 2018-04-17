<?php
 include("config.php");
 session_start();

 header("Content-Type: application/json; charset=UTF-8");
 $data = $_POST['quesCount'];
 	$arr = $_POST['catn'];
  echo $arr;
  $_SESSION['questionCounter'] = $data;

  $_SESSION['catagory'] = $_POST['cat'];
  $_SESSION['questions'] = $_POST['ques'];
  $_SESSION['selections'] = $_POST['selec'];
  $_SESSION['catScores'] = $_POST['cats'];
  $_SESSION['catNum'] = $_POST['catn'];
  $_SESSION['hintsUsed'] = $_POST['hintsU'];
  $_SESSION['currHintsUsed'] = $_POST['currhintsu'];
  $_SESSION['nextAdd'] = $_POST['nAdd'];
  $_SESSION['lastAdd'] = $_POST['lAdd'];
  ?>