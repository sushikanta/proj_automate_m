<?php require_once("check_login_mt.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Template View</title>
<?php require_once("css_bootstrap_header.php"); ob_start();?> 
<body>

<?php require_once("right_top_header_popup.php");?>
<?php if(isset($_GET['tpn_id']) && $_GET['tpn_id']!=""){ $tpn_id = $_GET['tpn_id'];?>

<div class="container">
 <div class="page-content">
  <div class="inv-main">

<div class="panel panel-success" style="min-height:300px;">
    <div class="panel-heading light_purple_color"><h3 class="panel-title"><i class="fa fa-cubes fa-lg fa-fw"></i> View 
		<span class="panel_subTitle">( Template Name - <?php echo showTemplate_Name($con, $tpn_id); ?> )</span>
      	<span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i>  <span id="show_date"></span></span>
	</div>    
    
<?php $result = mysqli_query($con, "SELECT TPN_name, TPN_total_row, TPN_total_column FROM template_name WHERE TPN_id = '$tpn_id'");
 
if(mysqli_num_rows($result) != 0) {
	while($row=mysqli_fetch_array($result)){
    $t_row=$row['TPN_total_row'];
	$t_column=$row['TPN_total_column'];
	}
	?>                  
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="test_name">
<thead align="left">
<tr>
    <th colspan="<?php echo $t_column+1; ?>" class="text-center">
    <span class="panel_subTitle">Investigation : <?php echo showTest_using_template($con, $tpn_id); ?> ( <?php echo showDept_using_template($con, $tpn_id);?> )</span> </th>
</tr>
</thead>
<tbody>
 
 <?php $sl_no=1; for($counter_row = 1; $counter_row <= $t_row; $counter_row++)
			{  ?> 
 <tr id="<?php echo $row['TPB_id'] ; ?>">
    <td><?php echo  $sl_no; ?> </td>
   
	<?php for($counter_column = 1; $counter_column <= $t_column; $counter_column++)
			  { ?>
			  <td><?php echo showData_rowColumn($con, $tpn_id, $counter_row, $counter_column); ?> </td>
	  <?php	}
			$sl_no++;
		   }} ?>
 	</tr>
    
</tbody>
</table>
          
 <div class="clear"></div>
</div>

<?php require_once("footer.php"); ?> 
<?php require_once("script_bootstrap.php"); ?> 
  </body>
</html>
<?php } ob_flush();?>