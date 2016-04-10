<?php
include('config.php');
?>

<?php if(isset($_GET['patient_id']) && $_GET['patient_id'] != '')
{
  $patient_id = $_GET['patient_id'];
  $patient_id = mysql_real_escape_string($patient_id);
  $res = mysqli_query($con, "SELECT `patient_id` FROM `patient_registration` WHERE patient_id='".$patient_id."'");
  if(mysqli_num_rows($res)>0)
  {
    echo 'exist';
  }
  else
  {
    echo 'NO';
  }
 }
?>