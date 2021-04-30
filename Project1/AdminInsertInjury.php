<?php
  include_once 'AdminHeader.php';
?>

  <section class="admBody">
    <h2>Please Fill in all Fields to Add an Element to 'Injury'</h2>
    <form action='includes/insertInjury.inc.php' method='post'>
      <div class='inj'>
        <input type='text' name='Severity' placeholder='Severity...'><br>
        <input type='text' name='Description' placeholder='Description...'><br>
        <input type='text' name='AffectedArea' placeholder='Affected Area...'><br>
      </div>
      <button type='submit' name='back'>Back</button> <span></span>
      <button type='submit' name='insert'>Insert</button>
    </form>
  </section>

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
        else if ($_GET["error"] == "injexists") {
          echo "<p>That injury already exists.</p>";
        }
        echo "</div>";
        echo "<div class='success'>";
        if ($_GET["error"] == "none") {
          echo "<p>Insert Successful!</p>";
        }
      echo "</div>";
    }
  ?>

<?php
  include_once 'footer.php';
?>
