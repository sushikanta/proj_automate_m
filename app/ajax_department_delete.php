<?php include("config.php"); ?>
<?php
$id = $_REQUEST['id'];

switch($id)
 {
	case ('1'):
      	echo "Opps ! 'Super User' can not be deleted..";
	 	break;
	case ('2'):
      	echo "Opps ! 'System Admin' can not be deleted..";
	 	break;
	case ('3'):
      	echo "Opps ! 'Front Desk' can not be deleted..";
	 	break;
    case ('4'):
      	echo "Opps ! 'Sample Collection' can not be deleted..";
	  	break;
	case ('5'):
      	echo "Opps ! 'LAB' can not be deleted..";
	  	break;
	case ('6'):
      	echo "Opps ! 'Ultrasound' can not be deleted..";
	  	break;
	case ('7'):
      	echo "Opps ! 'ECG' can not be deleted.."; 
	 	break;
	case ('8'):
 		echo "Opps ! 'X-Ray' can not be deleted..";
	  	break;
	case ('9'):
      	echo "Opps ! 'HR' can not be deleted..";
	 	break;
  	default: 
$result=mysqli_query($con, "DELETE FROM `department_tbl` WHERE `department_id` ='$id'"); echo "ok"; }
         
?>