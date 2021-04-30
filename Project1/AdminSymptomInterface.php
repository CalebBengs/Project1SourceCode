<?php
  include_once 'AdminHeader.php';
?>

<?php
if(isset($_POST['Choose'])){
  $_SESSION['table'] = "symptom";
  if($_POST['Choose'] == 0){
    $_SESSION['selection'] = 'Insert';
    header('Location: AdminInsert.php');
  }else if($_POST['Choose'] == 1){
    $_SESSION['selection'] = 'Update';
    header('Location: AdminUpdateSymptomInterim.php');
  }else if($_POST['Choose'] == 2){
    $_SESSION['selection'] = 'Delete';
    header('Location: AdminDeleteSymptom.php');
  }else if($_POST['Choose'] == 3){
    $_SESSION['table'] = "injury";
    $_SESSION['selection'] = 'Insert';
    $_SESSION['isInjury'] = 'true';
    header('Location: AdminInsertInjury.php');
  }else if($_POST['Choose'] == 4){
    $_SESSION['table'] = "injury";
    $_SESSION['selection'] = 'Delete';
    $_SESSION['isInjury'] = 'true';
    header('Location: AdminDeleteInjury.php');
  }
}
?>

  <section class="admBody">
    <h2>Please Choose the Operation to Perform on the "Symptoms" Table</h2>
    <form method="POST" action="AdminSymptomInterface.php">
    <select name="Choose">
      <option value="0">Insert Symptom</option>
      <option value="1">Update Symptom</option>
      <option value="2">Delete Symptom</option>
      <option value="3">Insert Injury</option>
      <option value="4">Delete Injury</option>
    </select>
    <button type="sumbit" name="submit">Submit</button>
  </section>

<?php
  include_once 'footer.php';
?>
