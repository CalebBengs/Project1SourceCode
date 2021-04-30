<?php
  session_start();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Project 1 - Admin</title>
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="styles/adminBody.css">
  </head>
  <body>
    <nav class="nvBar">
      <p class="prjtName">Project1</p>
        <ul>
          <li><a href='AdminHome.php'>Home</a></li>
          <li><a href='AdminUsersInterface.php'>Users</a></li>
          <li><a href='AdminClinicInterface.php'>Clinics</a></li>
          <li><a href='AdminTreatmentInterface.php'>Treatments</a></li>
          <li><a href='AdminSymptomInterface.php'>Symptoms</a></li>
          <li><a href='includes/logout.inc.php'>Log out</a></li>
        </ul>
    </nav>
