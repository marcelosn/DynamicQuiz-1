<?php
 include("question.php");
 include("config.php");
 //session_start();
   //include("quiz.php")
   //echo "hi i'm working"; 
   //header("Content-Type: application/json; charset=UTF-8");
   
    $obj = json_decode($_GET["x"]);
   //$obj = $_REQUEST["x"];
    $dbName = "$obj->table";
    //echo "pls work";
   //echo "$dbName";
   
   $questions = mysqli_query($db, "SELECT * FROM $dbName");
   //echo count($questions);

   $num_rows = mysqli_num_rows($questions);
   //echo "$num_rows";
   global $ques_num;
   $ques_num = 1;
   //echo "$ques_num";
   $questions_array = Array();
   //Get all the catagories
   for ($i = 1; $i<=$num_rows; $i++){
   //$i=1;
   //echo "$ques_num";
   //echo "$i";
    
    $result = mysqli_query($db, "SELECT * FROM $dbName WHERE catagory = $i");
    
    //$res = mysqli_fetch_assoc($result);
    $cat_num = mysqli_num_rows($result);
    if($cat_num != 0) {
      $catagory_array = Array();
      for ($x = 0; $x<$cat_num;$x++){

      //echo "$ques_num";
      $quessel = mysqli_query($db, "SELECT * FROM $dbName WHERE catagory = $i AND question_num = $ques_num;"); //this request doesn't account for catagory
      
      $newques = mysqli_fetch_assoc($quessel);
      $isthere = mysqli_num_rows($quessel);
      //$data = $newques;
      //echo json_encode($data);}}}
      
      if($isthere != 0){
        $question = $newques["question_body"];
          //echo $question;
        $a = $newques["question_a"];
        $b = $newques["question_b"];
        $c = $newques["question_c"];
        $d = $newques["question_d"];
          $e = $newques["question_e"];
        $subject = $newques["catagory"];
        $answer = $newques["answer"];
        $hint = $newques["hint"];
        $answer_array = array($a, $b, $c, $d, $e);
        //echo ($answer_array[1]);}}}}/*
        $newQuestion = new Question;
        $newQuestion->question = $question;
        $newQuestion->choices = $answer_array;
        $newQuestion->correctAnswer = $answer;
        $newQuestion->catagory = $subject;
        $newQuestion->hint = $hint;
        $jsonQues = json_encode($newQuestion);
        //echo $jsonQues;

        
        array_push($catagory_array, $newQuestion);
        //echo count($catagory_array);
        $ques_num= $ques_num+1;
          }
      //$catagory_array = json_encode($catagory_array);
      //echo count($questions_array);
      }
      array_push($questions_array, $catagory_array);
    }
    
   }
   global $final_encode;
$final_encode = json_encode($questions_array);
echo $final_encode; 
   ?>
 