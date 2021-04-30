<?php
  session_start();

  //When user enter submit button, user's info will be put into variables as follows:
   if (isset($_POST["insert"])) {
     $severity = $_POST["Severity"];
     $desc = $_POST["Description"];

     require_once 'dbh.inc.php';  //include file to connect to with database
     require_once 'functions.inc.php';  //include file to run function for sign up page


  //Functions to check if user enter valid information or not.
     if (emptyAdminSymptomInsert($severity, $desc) !== false) {
       header("location: ../AdminInsert.php?error=emptyinput");
       exit();
     }

     if (symptomExists($conn, $desc)){
       header("location: ../AdminInsert.php?error=sympexists");
       exit();
     }

     if (!checkSeverityLevel($severity)){
       header("location: ../AdminInsert.php?error=severitybounds");
       exit();
     }

     adminCreateSymptom($conn, $severity, $desc);

   }else if(isset($_POST["back"])){
     header("location: ../AdminSymptomInterface.php");
   }

   //If all information is valid, prompt user to sign up page that user has successfully sign up
   else {
     header("location: ../AdminInsert.php");
   }

?>
