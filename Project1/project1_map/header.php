<?php session_start();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Project 1</title>
  </head>
  <body>
    <nav>
      <div class="wrapper">
        <ul>
          <li><a href="index.php">Home</a></li>

          <?php
            if (isset($_SESSION["useruid"])) {
              echo "<li><a href='includes/logout.inc.php'>Log out</a></li>";
            }
            else {
              echo "<li><a href='signup.php'>Sign up</a></li>";
              echo "<li><a href='login.php'>Log in</a></li>";
            }
           ?>

        </ul>
      </div>
    </nav>

<div class="wrapper">
