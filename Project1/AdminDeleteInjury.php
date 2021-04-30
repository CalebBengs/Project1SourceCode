<?php
  include_once 'AdminHeader.php';
?>

<section class="admBody">
    <?php
      $table = $_SESSION['table'];

      echo "<h2>Please Select the 'Service Provided' Item to Delete</h2>";
      echo "<form action='includes/deleteInjury.inc.php' method='post'>";
      echo "<select name='injuries'>";

      require('includes/dbh.inc.php');

      $sql = "SELECT * FROM symptom AS S, injury AS I WHERE S.ID = I.SID;";

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
        $clinic[] = array($row['ID'], $row['Description'], $row['AffectedArea']);
      }

      mysqli_stmt_close($stmt);

      mysqli_close($conn);
      foreach($clinic as $service){
        echo "<option value='$service[0],$service[2]'>$service[0],  $service[1], $service[2]</option>";
      }
    ?>
    </select>
    <button type='submit' name='back'>Back</button> <span></span>
    <button type='submit' name='delete'>Delete</button>
    <?php
    if (isset($_GET["error"])) {
      echo "<div class='warning'>";
        if ($_GET["error"] == "stmtfailed") {
          echo "<p>Something went wrong, try again!</p>";
        }
      echo "</div>";
      echo "<div class='success'>";
        if ($_GET["error"] == "none") {
          echo "<p>Delete Successful!</p>";
        }
      echo "</div>";
    }
    ?>
  </form>
</section>

<?php
  include_once 'footer.php';
?>
