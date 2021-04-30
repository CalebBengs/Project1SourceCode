<?php
session_start();
$address = $_SESSION['userAddress'];

if(isset($_POST["symSearch"])){
  $_SESSION['userAddress'] = $address;
  header('Location: ../SymptomSearch.php');
  exit();
}else if(isset($_POST["trtSearch"])){
  $_SESSION['userAddress'] = $address;
  header('Location: ../TreatmentOptions.php');
  exit();
}else if(isset($_POST["emergency"])){
  $_SESSION['userAddress'] = $address;
  header('Location: emergency.inc.php');
  exit();
}

?>
