<?php

//When user enter submit button, user's info will be put into variables as follows:
 if (isset($_POST["submit"])) {
   $username = $_POST["uid"];
   $pwd = $_POST["pwd"];

   require_once '../includes/dbh.inc.php';  //include file to connect to with database
   require_once '../includes/functions.inc.php';  //include file to run function for sign up page


//Functions to check if user enter valid information or not.
   if (emptyInputLogin($username, $pwd) !== false) {
     header("location: ../signup.php?error=emptyinput");
     exit();
   }

   loginAdmin($conn, $username, $pwd);
 }
 //If all information is valid, prompt user to sign up page that user has successfully sign up
 else {
   header("location: ../AdminLogin.php");
   exit();
 }
