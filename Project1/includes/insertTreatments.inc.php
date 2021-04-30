<?php
session_start();
//When user enter submit button, user's info will be put into variables as follows:
 if (isset($_POST["insert"])) {
   $code = $_POST["SpecialtyCode"];
   $treatment = $_POST["Treatment"];

   require_once 'dbh.inc.php';  //include file to connect to with database
   require_once 'functions.inc.php';  //include file to run function for sign up page


   //Functions to check if user enter valid information or not.
   if (emptyAdminTreatmentInsert($code, $treatment) !== false) {
     header("location: ../AdminInsert.php?error=emptyinput");
     exit();
   }

   if (invalidTreatmentCode($conn, $code)) {
     header("location: ../AdminInsert.php?error=invalidcode");
     exit();
   }

   if (treatmentExists($conn, $treatment)){
     header("location: ../AdminInsert.php?error=trtexists");
     exit();
   }

   adminCreateTreatment($conn, $code, $treatment);

 }else if(isset($_POST["back"])){
   header("location: ../AdminTreatmentInterface.php");
 }


 //If all information is valid, prompt user to sign up page that user has successfully sign up
 else {
   header("location: ../AdminInsert.php");
 }
