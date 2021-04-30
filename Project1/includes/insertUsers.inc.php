<?php
session_start();
//When user enter submit button, user's info will be put into variables as follows:
 if (isset($_POST["insert"])) {
   $name = $_POST["usersName"];
   $email = $_POST["usersEmail"];
   $username = $_POST["usersUid"];
   $street = $_POST["usersStreet"];
   $city = $_POST["usersCity"];
   $state = $_POST["usersState"];
   $zipcode = $_POST["usersZipcode"];
   $pwd = $_POST["usersPwd"];

   require_once 'dbh.inc.php';  //include file to connect to with database
   require_once 'functions.inc.php';  //include file to run function for sign up page


//Functions to check if user enter valid information or not.
   if (emptyAdminInputInsert($name, $email, $username, $pwd) !== false) {
     header("location: ../AdminInsert.php?error=emptyinput");
     exit();
   }

   if (invalidUid($username) !== false) {
     header("location: ../AdminInsert.php?error=invaliduid");
     exit();
   }

   if (invalidEmail($email) !== false) {
     header("location: ../AdminInsert.php?error=invalidemail");
     exit();
   }

   if (uidExists($conn, $username, $email) !== false) {
     header("location: ../AdminInsert.php?error=usernametaken");
     exit();
   }

   adminCreateUser($conn, $name, $email, $username, $street, $city, $state, $zipcode, $pwd);

 }else if(isset($_POST["back"])){
   header("location: ../AdminUsersInterface.php");
 }


 //If all information is valid, prompt user to sign up page that user has successfully sign up
 else {
   header("location: ../AdminInsert.php");
 }
