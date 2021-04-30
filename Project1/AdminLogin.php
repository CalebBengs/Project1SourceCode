<?php
  include_once 'header.php';
?>

<section class="signup-form">
  <h2>Sign in as Administrator</h2>
  <form action="includes/adminSignUp.inc.php" method="post">
    <input type="text" name="uid" placeholder="Username..."><br>
    <input type="password" name="pwd" placeholder="Password..."><br>
    <button type="submit" name="submit">Log In</button>
  </form>


  <?php
    if (isset($_GET["error"])) {
      if ($_GET["error"] == "emptyinput") {
        echo "<p>Fill in all fields!</p>";
      }
      else if ($_GET["error"] == "invaliduid") {
        echo "<p>Choose a valid username!</p>";
      }
      else if ($_GET["error"] == "passworddontmatch") {
        echo "<p>Password doesn't match!</p>";
      }
      else if ($_GET["error"] == "stmtfailed") {
        echo "<p>Something went wrong, try again!</p>";
      }
    }
   ?>

</section>

<?php
  include_once 'footer.php';
?>
