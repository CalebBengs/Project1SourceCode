<?php
  include_once 'AdminHeader.php';
?>
<?php
  if(isset($_POST['back'])){
    header("location: AdminClinicInterface.php");
    exit();
  }
?>
  <section class="admBody">
    <?php
      $string = explode("|", $_POST["uclinic"]);

      require('includes/dbh.inc.php');

      // This is the SQL statement to be executed.
      $sql = "SHOW COLUMNS FROM clinic";

      // Initialize a mysql statment.
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo $sql;
        exit();
      }

      // Execute the statment.
      mysqli_stmt_execute($stmt);
      $resultData = mysqli_stmt_get_result($stmt);    // Obtain the result of executing the statement.
      $column = [];                                   // Create an array to store column data.
      while($row = mysqli_fetch_assoc($resultData)) { // Fetch each row in the result as an associative array.
        $column[] = $row['Field'];                    // Store the column information in the $locArray variable.
      }

      $_SESSION['colNames'] = $column;
      mysqli_stmt_close($stmt);

      mysqli_close($conn);

      echo "<h2>Please Change Desired Fields to Update the Selected 'clinic' Item</h2>";
      echo "<form action=includes/updateClinics.inc.php method='post'>";

      $k = 0;
      foreach($column as $entry){
        if($entry == 'ID'){
          $k = $k + 1;
          continue;
        }else{
          echo "<input type='text' name='clinic$k' value='$string[$k]'><br>";
        }
        $k = $k + 1;
      }
      $_SESSION['id'] = $string[0];
      $_SESSION['len'] = $k;
      echo "<button type='submit' name='back'>Back</button> <span></span>";
      echo "<button type='submit' name='update'>Update</button>";
      echo "</form>";
      if (isset($_GET["error"])) {
        echo "<div class='warning'>";
          if ($_GET["error"] == "emptyinput") {
            echo "<p>Fill in all fields!</p>";
          }
          else if ($_GET["error"] == "invaliduid") {
            echo "<p>Choose a valid username!</p>";
          }
          else if ($_GET["error"] == "invalidemail") {
            echo "<p>Choose a valid email!</p>";
          }
          else if ($_GET["error"] == "passworddontmatch") {
            echo "<p>Password doesn't match!</p>";
          }
          else if ($_GET["error"] == "stmtfailed") {
            echo "<p>Something went wrong, try again!</p>";
          }
          else if ($_GET["error"] == "usernametaken") {
            echo "<p>Username already taken!</p>";
          }
          else if ($_GET["error"] == "invalidcode") {
            echo "<p>Treatment code not valid!</p>";
          }
          else if ($_GET["error"] == "trtexists") {
            echo "<p>That treatment already exists.</p>";
          }
          else if ($_GET["error"] == "clncexists") {
            echo "<p>That clinic already exists.</p>";
          }
          else if ($_GET["error"] == "sympexists") {
            echo "<p>That symptom already exists.</p>";
          }
          else if ($_GET["error"] == "severitybounds") {
            echo "<p>Only enter severities as 1, 2, or 3. 3 is the worst.</p>";
          }
          else if ($_GET["error"] == "areabounds") {
            echo "<p>Affected area should be no more than 10 letters long.</p>";
          }
          echo "</div>";
          echo "<div class='success'>";
          if ($_GET["error"] == "none") {
            echo "<p>Insert Successful!</p>";
          }
        echo "</div>";
      }
    ?>
  </section>

<?php
  include_once 'footer.php';
?>
