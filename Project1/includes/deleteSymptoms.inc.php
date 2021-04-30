<?php
session_start();
//When user enter submit button, user's info will be put into variables as follows:
 if (isset($_POST["delete"])) {
   $id = $_POST["symptom"];

   require_once 'dbh.inc.php';  //include file to connect to with database
   require_once 'functions.inc.php';  //include file to run function for sign up page

  adminDeleteSymptom($conn, $id);

}else if(isset($_POST["back"])){
  header("location: ../AdminSymptomInterface.php");
}

//If all information is valid, prompt user to sign up page that user has successfully sign up
else {
  header("location: ../AdminDeleteSymptom.php");
}
