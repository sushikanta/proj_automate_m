<?php require_once("function.php");?>
<?php
$mix = $_REQUEST['id'];
  $all = explode(" ", $mix);
  $TPN_id = $all['0'];
  $TPN_status = $all['1'];
$value = $_REQUEST['value'] ;
$columnId = $_REQUEST['columnId']; 
$columnPosition = $_REQUEST['columnPosition'];

if($TPN_status =='33'){

if ($columnId == '1' && $columnPosition == '1')
    {
  	  mysqli_query($con, "UPDATE template_name SET TPN_name = '".$value."' WHERE TPN_id = '$TPN_id'");
	  if (mysqli_affected_rows($con) < '0') { echo "Error : ".mysqli_error($con);}
	  if (mysqli_affected_rows($con) == '1') { echo $value;}
	}
	
if ($columnId == '2' && $columnPosition == '2')
    {
  	  mysqli_query($con, "UPDATE template_name SET TPN_total_row = '$value' WHERE TPN_id = '$TPN_id'");
	 if (mysqli_affected_rows($con) < '0') { echo "Error ! Already Exist or TEchinical issue".mysqli_error($con);}
	  if (mysqli_affected_rows($con) == '1') { echo $value;}
	 
	}
if ($columnId == '3' && $columnPosition == '3')
    {
  	  mysqli_query($con, "UPDATE template_name SET TPN_total_column = '$value' WHERE TPN_id = '$TPN_id'");
	  if (mysqli_affected_rows($con) < '0') { echo "".mysqli_error($con);}
	  if (mysqli_affected_rows($con) == '1') { echo $value;}
	}
}
else{	
	 echo "Oops ! Not allowed to edit 'Used / Disabled' Template !";	
	}
?>