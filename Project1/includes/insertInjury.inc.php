<?php
  session_start();

  //When user enter submit button, user's info will be put into variables as follows:
   if (isset($_POST["insert"])) {
     $severity = $_POST["Severity"];
     $desc = $_POST["Description"];
     $area = $_POST["AffectedArea"];

     require_once 'dbh.inc.php';  //include file to connect to with database
     require_once 'functions.inc.php';  //include file to run function for sign up page


  //Functions to check if user enter valid information or not.
     if (emptyAdminInjuryInsert($severity, $desc, $area) !== false) {
       header("location: ../AdminInsertInjury.php?error=emptyinput");
       exit();
     }

     if(symptomExists($conn, $desc)){
       $sql = "SELECT ID FROM symptom WHERE Description LIKE ?;";
       $stmt = mysqli_stmt_init($conn);
       if (!mysqli_stmt_prepare($stmt, $sql)) {
         header("location: ../AdminInsertInjury.php?error=stmtfailed");
         exit();
       }

       mysqli_stmt_bind_param($stmt, "s", $desc);
       mysqli_stmt_execute($stmt);
       $resultData = mysqli_stmt_get_result($stmt);
       $sid;
       if ($row = mysqli_fetch_assoc($resultData)) {
         $sid = $row['ID'];
       }else{
         header("location: ../AdminInsertInjury.php?error=stmtfailed");
         exit();
       }

       mysqli_stmt_close($stmt);
       $_SESSION['sid'] = $sid;

       if (injuryExists($conn, $sid, $area)){
         header("location: ../AdminInsertInjury.php?error=injexists");
         exit();
       }
     }

     if (!checkSeverityLevel($severity)){
       header("location: ../AdminInsertInjury.php?error=severitybounds");
       exit();
     }

     if (checkAffectedArea($area)){
       header("location: ../AdminInsertInjury.php?error=areabounds");
     }

     adminCreateInjury($conn, $severity, $desc, $area);

   }else if(isset($_POST["back"])){
     header("location: ../AdminSymptomInterface.php");
   }

   //If all information is valid, prompt user to sign up page that user has successfully sign up
   else {
     header("location: ../AdminInsertInjury.php");
   }

?>
