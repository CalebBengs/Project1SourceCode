<?php

$serverName = "localhost";
$dBUserName = "root";
$dBPassword = "20SnowMageddon!21";
$dBName = "health interface";

$conn = mysqli_connect($serverName, $dBUserName, $dBPassword, $dBName);

if(!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
