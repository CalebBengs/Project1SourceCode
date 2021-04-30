<?php
  include_once 'AdminHeader.php';
?>

  <section class="admBody">
    <h2>Please Fill in all Fields to Add an Element to "Symptoms Provided"</h2>
    <form action="includes/insertServicesProvided.inc.php" method="post">
      <select name='clinicService'>
        <?php
            require('includes/dbh.inc.php');

            $sql = "SELECT ID, Name FROM clinic;";

            // Initialize a mysql statment.
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
              echo $sql;
              exit();
            }

            // Execute the statment.
            mysqli_stmt_execute($stmt);
            $resultData = mysqli_stmt_get_result($stmt);
            $clinic = [];
            while($row = mysqli_fetch_assoc($resultData)) {
              $clinic[] = array($row['Name'], $row['ID']);
            }

            mysqli_stmt_close($stmt);

            mysqli_close($conn);
            foreach($clinic as $place){
              echo "<option value='$place[1]'>$place[1],  $place[0]</option>";
            }
        ?>
      </select>
      <select name="serviceCode">
        <?php
            require('includes/dbh.inc.php');

            $sql = "SELECT CodeSequence, Specialty FROM service_code;";

            // Initialize a mysql statment.
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
              echo $sql;
              exit();
            }

            // Execute the statment.
            mysqli_stmt_execute($stmt);
            $resultData = mysqli_stmt_get_result($stmt);
            $code = [];
            while($row = mysqli_fetch_assoc($resultData)) {
              $code[] = array($row['CodeSequence'], $row['Specialty']);
            }

            mysqli_stmt_close($stmt);

            mysqli_close($conn);
            foreach($code as $place){
              echo "<option value='$place[0]'>$place[0],  $place[1]</option>";
            }
        ?>
      </select>
      <button type='submit' name='back'>Back</button> <span></span>
      <button type='submit' name='insert'>Insert</button>
    </form>
    <?php
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
        else if ($_GET["error"] == "codeTaken") {
          echo "<p>That clinic already has that code.</p>";
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
