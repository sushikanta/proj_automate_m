<?php include("function.php");?>
<?php
 
$dr_id = $_REQUEST['id'] ;
$value = ucwords($_REQUEST['value']);
$columnId = $_REQUEST['columnId'] ; 
$columnPosition = $_REQUEST['columnPosition'] ; 


if ($columnId == '1' && $columnPosition == '1')
{
$result = mysqli_query($con, "UPDATE dr_profile SET dr_name = '".$value."' WHERE dr_id = '$dr_id'"); 
if (mysqli_affected_rows($con) == '0') { echo "Oops ! Nothing is change"; }
if (mysqli_affected_rows($con) == '1') { echo $value; }
if (mysqli_affected_rows($con) == '-1') { echo "Oops ! Already Exist"; }
}

if ($columnId == '2' && $columnPosition == '2')
{
$result = mysqli_query($con, "UPDATE dr_profile SET  dr_specialization = '".$value."' WHERE dr_id = '$dr_id'"); 
if (!$result) { echo "Update failed"; }
else          { echo  $value; }
}

if ($columnId == '3' && $columnPosition == '3')
{
$result = mysqli_query($con, "UPDATE dr_profile SET  dr_institute = '".$value."' WHERE dr_id = '$dr_id'"); 
if (!$result) { echo "Update failed"; }
else          { echo  $value; }
}

if ($columnId == '4' && $columnPosition == '4')
{
$result = mysqli_query($con, "UPDATE dr_profile SET  dr_phone = '$value' WHERE dr_id = '$dr_id'"); 
if (!$result) { echo "Update failed"; }
else          { echo  $value; }
}


mysqli_close($con);

?>