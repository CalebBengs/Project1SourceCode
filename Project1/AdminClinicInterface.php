<?php
  include_once 'AdminHeader.php';
?>

<?php
  if(isset($_POST['Choose'])){
    $_SESSION['table'] = "clinic";
    if($_POST['Choose'] == 0){
      $_SESSION['selection'] = 'Insert';
      header('Location: AdminInsert.php');
    }else if($_POST['Choose'] == 1){
      $_SESSION['selection'] = 'Update';
      header('Location: AdminUpdateClinicsInterim.php');
    }else if($_POST['Choose'] == 2){
      $_SESSION['selection'] = 'Delete';
      header('Location: AdminDeleteClinic.php');
    }else if($_POST['Choose'] == 3){
      $_SESSION['table'] = 'services_provided';
      $_SESSION['selection'] = 'Insert';
      header('Location: AdminInsertServicesProvided.php');
    }else if($_POST['Choose'] == 4){
      $_SESSION['table'] = 'services_provided';
      $_SESSION['selection'] = 'Delete';
      header('Location: AdminDeleteService.php');
    }
  }
?>

  <section class="admBody">
    <h2>Please Choose the Operation to Perform on the "Clinics" Table</h2>
    <form method="POST" action="AdminClinicInterface.php">
    <select name="Choose">
      <option value="0">Insert</option>
      <option value="1">Update</option>
      <option value="2">Delete</option>
      <option value="3">Insert Clinic Service</option>
      <option value="4">Delete Clinic Service</option>
    </select>
    <button type="sumbit" name="submit">Submit</button>
  </section>

<?php
  include_once 'footer.php';
?>
