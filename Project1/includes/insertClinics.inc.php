<?php
session_start();
//When user enter submit button, user's info will be put into variables as follows:
 if (isset($_POST["insert"])) {
   $name = $_POST["Name"];
   $url = $_POST["URL"];
   $location = $_POST["Location"];
   $rating = $_POST["Rating"];
   $hours = $_POST["Hours"];
   $phone = $_POST["Phone"];
   $preparedness = $_POST["Preparedness"];

   require_once 'dbh.inc.php';  //include file to connect to with database
   require_once 'functions.inc.php';  //include file to run function for sign up page


//Functions to check if user enter valid information or not.
   if (emptyAdminClinicInsert($name, $url, $location, $rating, $hours, $phone, $preparedness) !== false) {
     header("location: ../AdminInsert.php?error=emptyinput");
     exit();
   }

   if(!checkSeverityLevel($preparedness)){
     header("Location: ../AdminInsert.php?error=severitybounds");
     exit();
   }

   if(!checkRating($rating)){
     header("Location: ../AdminInsert.php?error=ratingbounds");
     exit();
   }

   if (clinicExists($conn, $name)){
     header("location: ../AdminInsert.php?error=clncexists");
     exit();
   }

   adminCreateClinic($conn, $name, $url, $rating, $hours, $location, $phone, $preparedness);

 }else if(isset($_POST["back"])){
   header("location: ../AdminClinicInterface.php");
 }

 //If all information is valid, prompt user to sign up page that user has successfully sign up
 else {
   header("location: ../AdminInsert.php");
 }
