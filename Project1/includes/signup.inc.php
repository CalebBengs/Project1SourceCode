<?php

 if (isset($_POST["submit"])) {
   $name = $_POST["name"];
   $email = $_POST["email"];
   $username = $_POST["uid"];
   $street = $_POST["street"];
   $city = $_POST["city"];
   $state = $_POST["state"];
   $zipcode = $_POST["zipcode"];
   $pwd = $_POST["pwd"];
   $pwdRepeat = $_POST["pwdrepeat"];

   require_once 'dbh.inc.php';
   require_once 'functions.inc.php';

   if (emptyInputSignup($name, $email, $username, $street, $city, $state, $zipcode, $pwd, $pwdRepeat) !== false) {
     header("location: ../signup.php?error=emptyinput");
     exit();
   }

   if (invalidUid($username) !== false) {
     header("location: ../sigup.php?error=invaliduid");
     exit();
   }

   if (invalidEmail($email) !== false) {
     header("location: ../sigup.php?error=invalidemail");
     exit();
   }

   if (pwdMatch($pwd, $pwdRepeat) !== false) {
     header("location: ../sigup.php?error=passworddontmatch");
     exit();
   }

   if (uidExists($conn, $username, $email) !== false) {
     header("location: ../sigup.php?error=usernametaken");
     exit();
   }

   createUser($conn, $name, $email, $username, $street, $city, $state, $zipcode, $pwd);

 }
 else {
   header("location: ../signup.php");
 }
