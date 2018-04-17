<?php
session_start();
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'quizUser');
   define('DB_PASSWORD', 'dynAmic4998!');
   define('DB_DATABASE', 'DynamicQuiz');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

    if (!$db) {
 die("Connection failed: " . mysqli_connect_error());
}

  /* $con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());*/
?>