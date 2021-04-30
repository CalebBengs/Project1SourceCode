<?php
session_start();
//When user enter submit button, user's info will be put into variables as follows:
 if (isset($_POST["update"])) {
   $id = $_SESSION['id'];
   $k = $_SESSION['len'];
   $j = 1;
   $list = [];
   while($j < $k){
     $list[] = $_POST["treatment$j"];
     $j = $j + 1;
   }

   require_once 'dbh.inc.php';  //include file to connect to with database
   require_once 'functions.inc.php';  //include file to run function for sign up page

   if (emptyAdminTreatmentInsert($list[0], $list[1]) !== false) {
     header("location: ../AdminUpdateTreatmentInterim.php?error=emptyinput");
     exit();
   }

   if (invalidTreatmentCode($conn, $list[0])) {
     header("location: ../AdminUpdateTreatmentInterim.php?error=invalidcode");
     exit();
   }

   if (treatmentExists($conn, $list[1])){
     header("location: ../AdminUpdateTreatmentInterim.php?error=trtexists");
     exit();
   }

   adminUpdateTreatment($conn, $id, $list[0], $list[1]);

}else if(isset($_POST["back"])){
  header("location: ../AdminUpdateTreatmentInterim.php");
}

//If all information is valid, prompt user to sign up page that user has successfully sign up
else {
  header("location: ../AdminUpdateTreatmentInterim.php");
}
