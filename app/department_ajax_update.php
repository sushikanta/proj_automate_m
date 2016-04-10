<?php require_once("function.php");?>
<?php 
$id = $_REQUEST['id'] ;
$value = $_REQUEST['value'] ; 

switch($id)
 {
	case ('1'):
      	echo "Opps ! 'Super User' can not be Edited";
	 	break;
	case ('2'):
      	echo "Opps ! 'System Admin' can not be Edited";
	 	break;
	case ('3'):
      	echo "Opps ! 'Front Desk' can not be Edited";
	 	break;
    case ('4'):
      	echo "Opps ! 'Sample Collection' can not be Edited";
	  	break;
	case ('5'):
      	echo "Opps ! 'LAB' can not be Edited";
	  	break;
	case ('6'):
      	echo "Opps ! 'Ultrasound' can not be Edited";
	  	break;
	case ('7'):
      	echo "Opps ! 'ECG' can not be Edited"; 
	 	break;
	case ('8'):
 		echo "Opps ! 'X-Ray' can not be Edited";
	  	break;
	case ('9'):
      	echo "Opps ! 'HR' can not be Edited";
	 	break;
  	default: 
		mysqli_query($con, "UPDATE department_tbl SET department_name = '".$value."' WHERE department_id = '$id'");
       if (mysqli_affected_rows($con) == '0') { echo "Oops : Same Value"; }
	   if (mysqli_affected_rows($con) == '1') { echo $value;}
	   if (mysqli_affected_rows($con) == '-1') { echo "Oops : Duplicate Entry OR Technical Problem";}
 }
?>