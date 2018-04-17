<?php
   include("config.php");
   //session_save_path("/var/lib/php/sessions");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myname = mysqli_real_escape_string($db,$_POST['id']);
      $myID = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT number FROM studentlist WHERE id = '$myname' and password = '$myID'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		//echo "count is $count";
      if($count == 1) {
         //echo "inside the if!!!";
         /*session_register("myname");*/
         $_SESSION['login_user'] = $myname;
         $sql2 = "UPDATE studentlist SET activated = 1 WHERE id = '$myname'";
        

          $_SESSION['questionCounter'] = 1;
          $_SESSION['catagory'] = 1;
          $_SESSION['questions'] = "[]";
          $_SESSION['questionQueue'] = "[]";
          $_SESSION['selections'] = "[]";
          $_SESSION['catScores'] = "[]";
          $_SESSION['catNum'] = "[]";
          $_SESSION['hintsUsed'] = "[]";
          $_SESSION['currHintsUsed'] = 0;
          $_SESSION['initial'] = 1;
          $_SESSION['nextAdd'] = $_SESSION['initial'];
          $_SESSION['lastAdd'] = $_SESSION['initial'];
         $activated = mysqli_query($db,$sql2);
           if (!$activated) {
          echo 'MySQL Error: ' . mysqli_error($db);
          exit;
          }

         //echo $myname;
         header("location: quizForm.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>

<html>
   
   <head>
      <title>Login Page</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
   
      <div align = "center">
         <h3 style = 'width:40%; border-style:solid; border-width:5px; padding:10px;'>
            <div style = "background-color:green; color:#FFFFFF; padding:3px;"><b>Please Read!</b></div>
            </br>
            This is a study tool. It is also an experimental tool meant to test the effectiveness of dynamic online learning systems. This trial is part of a Distinguished Major Project by a 4th year student. You will be presented with extra practice material for two weeks, with an assessment quiz along the way. The results of this quiz will be recorded to analyze the trends of performance. Then, you will be asked to test your learned skills in a survey at the end. Please do not work with other students or share answers, as this would compromise the results of this study. Participation in this study is completely voluntary, and will have absolutely no effect on your grade. The student running this experiment will not know your identity, as the mapping of anonymous IDs is hidden behind Netbadge. Your individual results will not be revealed to your professor, and he will only ever see aggregate data. He will at no point look at the mappings to identify which students participated in the city. The generated user ID that you login with will be used in place of any identifying information.
         </br>
      </br>

If you would like to participate in this study, please use the provided id and password to log in. If you do log in, you are considered a participant. However, you have the right to leave, and if you don’t complete the surveys your results will not be included.

         </h3>


         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
            
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>ID  :</label><input type = "text" name = "id" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
               
            </div>
            
         </div>
         
      </div>

   </body>
</html>