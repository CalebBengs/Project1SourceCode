<?php
session_start();
//When user enter submit button, user's info will be put into variables as follows:
 if (isset($_POST["update"])) {
   $id = $_SESSION['id'];
   $k = $_SESSION['len'];
   $j = 1;
   $list = [];
   while($j < $k){
     $list[] = $_POST["clinic$j"];
     $j = $j + 1;
   }

   require_once 'dbh.inc.php';  //include file to connect to with database
   require_once 'functions.inc.php';  //include file to run function for sign up page

   if(!checkSeverityLevel((int)$list[6])){
     header("Location: ../AdminUpdateClinicsInterim.php?error=severitybounds");
     exit();
   }

   if(!checkRating($list[2])){
     header("Location: ../AdminUpdateClinicsInterim.php?error=ratingbounds");
     exit();
   }

   adminUpdateClinic($conn, $id, $list[0], $list[1], $list[2], $list[3], $list[4], $list[5], $list[6]);

}else if(isset($_POST["back"])){
  header("location: ../AdminUpdateClinicsInterim.php");
}

//If all information is valid, prompt user to sign up page that user has successfully sign up
else {
  header("location: ../AdminUpdateClinicsInterim.php");
}
