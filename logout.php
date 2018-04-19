<?php
   include('config.php');
   session_start();

   session_destroy();
   
   echo 'You have cleaned session';
   header("location : studentlogin.php");
   exit();

   ?>
			?>