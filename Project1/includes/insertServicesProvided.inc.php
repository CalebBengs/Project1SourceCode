<?php
session_start();
//When user enter submit button, user's info will be put into variables as follows:
 if (isset($_POST["insert"])) {
   $id = $_POST["clinicService"];
   $code = $_POST["serviceCode"];
   $_SESSION['sid'] = $_POST['serviceCode'];

   require_once 'dbh.inc.php';  //include file to connect to with database
   require_once 'functions.inc.php';  //include file to run function for sign up page


//Functions to check if user enter valid information or not.
   if (serviceExists($conn, $id, $code)) {
     header("location: ../AdminInsertServicesProvided.php?error=codeTaken");
     exit();
   }

   adminCreateServiceProvided($conn, $id, $code);

 }else if(isset($_POST["back"])){
   header("location: ../AdminClinicInterface.php");
 }

 //If all information is valid, prompt user to sign up page that user has successfully sign up
 else {
   header("location: ../AdminInsertServicesProvided.php");
 }
