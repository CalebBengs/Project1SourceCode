<?php

function emptyInputSignup($name, $email, $username, $street, $city, $state, $zipcode, $pwd, $pwdRepeat) {
  $result;
  if (empty($name) || empty($email) || empty($username) || empty($street) || empty($city) || empty($state) || empty($zipcode) || empty($pwd) || empty($pwdRepeat)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function emptyAdminInputInsert($name, $email, $username, $pwd) {
  $result;
  if (empty($name) || empty($email) || empty($username) || empty($pwd)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function emptyAdminTreatmentInsert($code, $treatment) {
  $result;
  if (empty($code) || empty($treatment)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function emptyAdminClinicInsert($name, $url, $location, $rating, $hours, $phone, $preparedness) {
  $result;
  if (empty($name) || empty($url) || empty($location) || empty($rating) || empty($hours) || empty($phone) || empty($preparedness)){
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function emptyAdminSymptomInsert($severity, $desc) {
  $result;
  if (empty($severity) || empty($desc)){
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function emptyAdminInjuryInsert($severity, $desc, $area) {
  $result;
  if (empty($severity) || empty($desc) || empty($area)){
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function emptyAdminServiceCode($code) {
  $result;
  if (empty($code)){
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function invalidUid($username) {
  $result;
  if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function invalidTreatmentCode($conn, $code) {
  $sql = "SELECT * FROM service_code WHERE CodeSequence LIKE ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../AdminInsert.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $code);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($resultData)) {
    $result = false;
    return $result;
  }
  else {
    $result = true;
    return $result;
  }
}

function invalidEmail($email) {
  $result;
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function pwdMatch($pwd, $pwdRepeat) {
  $result;
  if ($pwd !== $pwdRepeat) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function uidExists($conn, $username, $email) {
  $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../sigup.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ss", $username, $email);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  }
  else {
    $result = false;
    return $result;
  }

  mysqli_stmt_close($stmt);
}

function treatmentExists($conn, $treatment) {
  $sql = "SELECT * FROM specialty_treatment WHERE LOWER(Treatment) LIKE LOWER(?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../AdminInsert.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $treatment);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($resultData)) {
    $result = true;
    return $result;
  }
  else {
    $result = false;
    return $result;
  }

  mysqli_stmt_close($stmt);
}

function symptomExists($conn, $desc) {
  $sql = "SELECT * FROM symptom WHERE LOWER(Description) LIKE LOWER(?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../AdminInsert.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $desc);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  }
  else {
    $result = false;
    return $result;
  }

  mysqli_stmt_close($stmt);
}

function injuryExists($conn, $sid, $area) {
  $sql = "SELECT * FROM injury WHERE SID = ? AND LOWER(AffectedArea) LIKE LOWER(?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../AdminInsertInjury.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ss", $sid, $area);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($resultData)) {
    $result = true;
    return $result;
  }
  else {
    $result = false;
    return $result;
  }

  mysqli_stmt_close($stmt);
}

function serviceExists($conn, $id, $code) {
  $sql = "SELECT * FROM services_provided WHERE CID = ? AND LOWER(ServiceCode) LIKE LOWER(?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../AdminInsertServicesProvided.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ss", $id, $code);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($resultData)) {
    $result = true;
    return $result;
  }
  else {
    $result = false;
    return $result;
  }

  mysqli_stmt_close($stmt);
}

function checkSeverityLevel($severity){
  if(($severity != 0) && ($severity != 1) && ($severity != 2) && ($severity != 3)){
    return false;
  }

  return true;
}

function checkRating($rating){
  if(($rating > 5) || ($rating < 0)){
    return false;
  }

  return true;
}

function checkAffectedArea($area){
  if (!preg_match("/^[a-zA-Z]{1,10}$/", $area)) {
    $result = true;
  }else{
    $result = false;
  }
}

function clinicExists($conn, $name) {
  $sql = "SELECT * FROM clinic WHERE LOWER(Name) LIKE LOWER(?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../AdminInsert.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $name);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  }
  else {
    $result = false;
    return $result;
  }

  mysqli_stmt_close($stmt);
}

//Function to write user's sign up information in the sign-up form into database
function createUser($conn, $name, $email, $username, $street, $city, $state, $zipcode, $pwd) {
  $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersStreet, usersCity, usersState, usersZipcode, usersPwd) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../sigup.php?error=stmtfailed");
    exit();
  }

  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);   //Encripted password so password can't be seen in database

  mysqli_stmt_bind_param($stmt, "ssssssss", $name, $email, $username, $street, $city, $state, $zipcode, $hashedPwd);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../signup.php?error=none");
  exit();
}

//Function to write user's sign up information in the sign-up form into database
function adminCreateTreatment($conn, $code, $treatment) {
  $sql = "INSERT INTO specialty_treatment (SpecialtyCode, Treatment) VALUES (?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../AdminInsert.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ss", $code, $treatment);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../AdminInsert.php?error=none");
  exit();
}

//Function to write user's sign up information in the sign-up form into database
function adminCreateServiceProvided($conn, $id, $code) {
  $sql = "INSERT INTO services_provided (CID, ServiceCode) VALUES (?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../AdminInsertServicesProvided.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ss", $id, $code);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../AdminInsertServicesProvided.php?error=none");
  exit();
}

//Function to write user's sign up information in the sign-up form into database
function adminCreateUser($conn, $name, $email, $username, $street, $city, $state, $zipcode, $pwd) {
  $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersStreet, usersCity, usersState, usersZipcode, usersPwd) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../AdminInsert.php?error=stmtfailed");
    exit();
  }

  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);   //Encripted password so password can't be seen in database

  mysqli_stmt_bind_param($stmt, "ssssssss", $name, $email, $username, $street, $city, $state, $zipcode, $hashedPwd);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../AdminInsert.php?error=none");
  exit();
}

//Function to write user's sign up information in the sign-up form into database
function adminCreateClinic($conn, $name, $url, $rating, $hours, $location, $phone, $preparedness) {
  $sql = "INSERT INTO clinic (Name, URL, Rating, Hours, Location, Phone, Preparedness) VALUES (?, ?, ?, ?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../AdminInsert.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "sssssss", $name, $url, $rating, $hours, $location, $phone, $preparedness);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../AdminInsert.php?error=none");
  exit();
}

//Function to write user's sign up information in the sign-up form into database
function adminCreateSymptom($conn, $severity, $desc) {
  $sql = "INSERT INTO symptom (Severity, Description) VALUES (?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../AdminInsert.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ss", $severity, $desc);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../AdminInsert.php?error=none");
  exit();
}

//Function to write user's sign up information in the sign-up form into database
function adminCreateInjury($conn, $severity, $desc, $area) {
  if(!symptomExists($conn, $desc)){
    $sql = "INSERT INTO symptom (Severity, Description) VALUES (?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../AdminInsertInjury.php?error=stmtfailed");
      exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $severity, $desc);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
  }

  $sql1 = "SELECT ID FROM symptom WHERE LOWER(Description) LIKE LOWER(?);";

  $stmt1 = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt1, $sql1)) {
    header("location: ../AdminInsertInjury.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt1, "s", $desc);
  mysqli_stmt_execute($stmt1);
  $resultData = mysqli_stmt_get_result($stmt1);

  if ($row = mysqli_fetch_assoc($resultData)) {
    $sid = $row['ID'];
  }else{
    header("location: ../AdminInsertInjury.php?error=stmtfailed");
    exit();
  }
  mysqli_stmt_close($stmt1);

  $sql2 = "INSERT INTO injury (AffectedArea, SID) VALUES (?, ?);";
  $stmt2 = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt2, $sql2)) {
    header("location: ../AdminInsertInjury.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt2, "ss", $area, $sid);
  mysqli_stmt_execute($stmt2);
  mysqli_stmt_close($stmt2);
  header("location: ../AdminInsertInjury.php?error=none");
  exit();
}

function emptyInputLogin($username, $pwd) {
  $result;
  if (empty($username) || empty($pwd)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function emptyInputSearch($street, $city, $state, $zip) {
  $result;
  if (empty($street) || empty($city) || empty($state) || empty($zip)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function loginUser($conn, $username, $pwd) {
  $uidExists = uidExists($conn, $username, $username);

  if ($uidExists === false) {
    header("location: ../login.php?error=wronglogin");
    exit();
  }

  $pwdHashed = $uidExists["usersPwd"];
  $checkPwd = password_verify($pwd, $pwdHashed);

  if($checkPwd === false) {
    header("location: ../login.php?error=wronglogin");
    exit();
  }
  else if ($checkPwd === true) {
    session_start();
    $_SESSION["userid"] =  $uidExists["usersId"];
    $_SESSION["useruid"] =  $uidExists["usersUid"];
    header("location: ../index.php");
    exit();
  }
}

function loginAdmin($conn, $username, $pwd) {
  $uidExists = uidExists($conn, $username, $username);

  if ($uidExists === false) {
    header("location: ../login.php?error=wronglogin");
    exit();
  }

  $pwdHashed = $uidExists["usersPwd"];
  $checkPwd = password_verify($pwd, $pwdHashed);

  if($checkPwd === false) {
    header("location: ../login.php?error=wronglogin");
    exit();
  }
  else if ($checkPwd === true) {
    session_start();
    $_SESSION["userid"] =  $uidExists["usersId"];
    $_SESSION["useruid"] =  $uidExists["usersUid"];
    header("location: ../AdminHome.php");
    exit();
  }
}


function createUserAddress($conn, $street, $city, $state, $zip) {
  $sql = "INSERT INTO usersaddress (streetNo, city, state, zipCode) VALUES (?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../search.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ssss", $street, $city, $state, $zip);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../search.php?error=none");
  exit();
}

//Function to write user's sign up information in the sign-up form into database
function adminDeleteClinic($conn, $id) {
  $sql = "DELETE FROM services_provided WHERE CID = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../AdminDeleteClinic.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  $sql = "DELETE FROM clinic WHERE ID = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../AdminDeleteClinic.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s",$id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../AdminDeleteClinic.php?error=none");
  exit();
}

function adminDeleteUser($conn, $id) {
  $sql = "DELETE FROM users WHERE usersId = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../AdminDeleteUser.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../AdminDeleteUser.php?error=none");
  exit();
}

function adminDeleteTreatment($conn, $id) {
  $sql = "DELETE FROM specialty_treatment WHERE ID = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../AdminDeleteTreatment.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../AdminDeleteTreatment.php?error=none");
  exit();
}

function adminDeleteSymptom($conn, $id) {
  $sql = "DELETE FROM injury WHERE SID = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../AdminDeleteSymptom.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  $sql = "DELETE FROM symptom WHERE ID = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../AdminDeleteSymptom.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s",$id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../AdminDeleteSymptom.php?error=none");
  exit();
}

function adminDeleteService($conn, $id, $service) {
  $sql = "DELETE FROM services_provided WHERE CID = ? AND ServiceCode LIKE ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../AdminDeleteService.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ss", $id, $service);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../AdminDeleteService.php?error=none");
  exit();
}

function adminDeleteInjury($conn, $id, $area) {
  $sql = "DELETE FROM injury WHERE SID = ? AND AffectedArea LIKE ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../AdminDeleteInjury.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ss", $id, $area);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../AdminDeleteInjury.php?error=none");
  exit();
}

function adminUpdateClinic($conn, $id, $name, $url, $rating, $hours, $location, $phone, $preparedness){
  $sql = "SELECT ID FROM clinic WHERE Name LIKE ? OR URL LIKE ? AND ID <> ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../AdminUpdateClinicsInterim.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "sss", $name, $url, $id);
  mysqli_stmt_execute($stmt);
  $resultData = mysqli_stmt_get_result($stmt);
  $resultData = ($resultData->fetch_assoc());
  mysqli_stmt_close($stmt);

  if($resultData == NULL){
    $sql = "UPDATE clinic SET Name = ?, URL = ?, Rating = ?, Hours = ?, Location = ?, Phone = ?, Preparedness = ? WHERE ID = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../AdminUpdateClinicsInterim.php?error=stmtfailed");
      exit();
    }
    $rating = (float)$rating;
    $preparedness = (int)$preparedness;

    mysqli_stmt_bind_param($stmt, "ssssssss", $name, $url, $rating, $hours, $location, $phone, $preparedness, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
  }else{
    header("location: ../AdminUpdateClinicsInterim.php?error=nametaken");
    exit();
  }

  header("location: ../AdminUpdateClinicsInterim.php?error=none");
  exit();
}

function adminUpdateTreatment($conn, $id, $code, $treatment){
  $sql = "SELECT ID FROM specialty_treatment WHERE Treatment LIKE ? AND ID <> ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../AdminUpdateTreatmentsInterim.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ss", $treatment, $id);
  mysqli_stmt_execute($stmt);
  $resultData = mysqli_stmt_get_result($stmt);
  $resultData = ($resultData->fetch_assoc());
  mysqli_stmt_close($stmt);

  if($resultData == NULL){
    $sql = "UPDATE specialty_treatment SET SpecialtyCode = ?, Treatment = ? WHERE ID = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../AdminUpdateTreatmentsInterim.php?error=stmtfailed");
      exit();
    }

    mysqli_stmt_bind_param($stmt, "sss", $code, $treatment, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
  }else{
    header("location: ../AdminUpdateTreatmentInterim.php?error=nametaken");
    exit();
  }

  header("location: ../AdminUpdateTreatmentInterim.php?error=none");
  exit();
}
