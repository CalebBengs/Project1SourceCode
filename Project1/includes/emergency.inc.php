<?php
  //include_once '../header.php';

  session_start();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Project 1</title>
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/HomePage.css">
    <link rel="stylesheet" href="../styles/LoginForms.css">
    <link rel="stylesheet" href="../styles/TreatmentOptions.css">
    <link rel="stylesheet" href="../styles/SymptomSearch.css">
  </head>
  <body>
    <nav class="nvBar">
      <p class="prjtName">Project1</p>
        <ul>
          <li><a href="../index.php">Home</a></li>

          <?php
            if (isset($_SESSION["userid"])) {
              echo "<li><a href='../includes/logout.inc.php'>Log out</a></li>";
              echo "<li><a href='../UserSearchLocation.php'>Search</a></li>";
            }
            else {
              echo "<li><a href='../signup.php'>Sign up</a></li>";
              echo "<li><a href='../login.php'>Log in</a></li>";
            }
           ?>
        </ul>
    </nav>


<?php
    $address = explode("|", $_SESSION["userAddress"]);
    $streetNo = $address[0];
    $city = $address[1];
    $state = $address[2];
    $zipCode = $address[3];

    require_once "../includes/dbh.inc.php";
    require_once "../includes/functions.inc.php";
    //createUserAddress($conn, $streetNo, $city, $state, $zipCode);
?>
    <h2 style="color:blueviolet;text-decoration:underline;">Hospitals Nearby</h2>
    <iframe
      width="600"
      height="450"
      style="border:0"
      loading="lazy"
      allowfullscreen
      src="https://www.google.com/maps/embed/v1/search?key=AIzaSyAtt4hsayf45u18-2kJMdEs30PjXjSnwts&q=hospital+<?php echo $streetNo.",+".$city. ",+".$state. ",+".$zipCode; ?>">
    </iframe>

<footer class = "footer">

</footer>


</body>
</html>
