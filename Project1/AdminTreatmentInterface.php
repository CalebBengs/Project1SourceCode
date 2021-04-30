<?php
  include_once 'AdminHeader.php';
?>

<?php
  if(isset($_POST['Choose'])){
    $_SESSION['table'] = "specialty_treatment";
    if($_POST['Choose'] == 0){
      header('Location: AdminInsert.php');
    }else if($_POST['Choose'] == 1){
      header('Location: AdminUpdateTreatmentInterim.php');
    }else if($_POST['Choose'] == 2){
      header('Location: AdminDeleteTreatment.php');
    }
  }
?>

  <section class="admBody">
    <h2>Please Choose the Operation to Perform on the "Treatments" Table</h2>
    <form method="POST" action="AdminTreatmentInterface.php">
    <select name="Choose">
      <option value="0">Insert</option>
      <option value="1">Update</option>
      <option value="2">Delete</option>
    </select>
    <button type="sumbit" name="submit">Submit</button>
  </section>

<?php
  include_once 'footer.php';
?>
