<?php require_once("check_login_admin.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Revise Price</title>
 <?php require_once("css_bootstrap_header.php");?>
 <?php require_once("print-borderless-ac.php");?>
</head>
<body id="myBody">
<?php require_once("right_top_header_admin.php");?>
<div class="container">
 <div class="page-content">		    
  <div class="inv-main">
  
    <div class="panel panel-success" id="printableArea">            
    <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     Price <span class="panel-subTitle"> ( Version wise ) </span>
     
     <button onclick="printDiv('printableArea')" class="no-print btn btn-mini btn-primary pull-right" style="margin-left:10px; margin-top:-5px;">
  <i class="fa fa-print fa-lg"></i> Print&nbsp;</button>    
  <button type="button" onclick="tableToExcel('check_tbl', 'AC statement')" class="no-print btn btn-mini btn-primary pull-right"  style="margin-top:-5px;">
  <i class="fa fa-file-excel-o fa-fw"></i> Save</button>
     
	<span class="date_time pull-right light_purple_color" style="padding-right:10px;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
     </h3>
     </div>
     
   <div class="panel-body">  
   <table cellpadding="0" cellspacing="0" border="0" class=" table-striped table-hover" id="check_tbl" style="width:100%;">
   <thead align="left">
      <tr>
        <th> # </th>
        <th>Investigation</th>
		<?php
        $result1 = mysqli_query($con, "SELECT PV_id, `PV_date`, `PV_status` FROM `price_version`");
        $sl_v=1;
        while ($row1 = mysqli_fetch_array($result1)){
        ?>
        <th class="text-right">Version <?php echo $sl_v; ?><br/><?php echo date("d-m-Y", strtotime($row1['PV_date'])); ?></th>
       <?php $sl_v++; } ?>	
      </tr>
   </thead>     
  <tbody>
<?php
$result2 = mysqli_query($con, "SELECT t.test_id, t.test_name, t.test_price FROM test_tbl t ORDER BY t.test_name ASC");
$sl_no=1;
while ($row2 = mysqli_fetch_array($result2))
{   
 	 $test_id = $row2['test_id'];
	 $test_name = $row2['test_name'];	
	 $test_price = $row2['test_price'];
	 
	?>
    <tr id="<?php echo $test_id; ?>">
      <td><?php echo $sl_no; ?></td>
      <td><?php echo $test_name; ?></td>      
      
      <?php       
		mysqli_data_seek($result1, 0);
        while ($row1 = mysqli_fetch_array($result1)){
			   $PV_id = $row1['PV_id'];
			   
			   $check1 = mysqli_query($con, "SELECT PD_price FROM price_dump WHERE PD_test_id = '$test_id' AND PD_version = '$PV_id'");
		      if(mysqli_num_rows($check1) !=0){
              while ($crow1 = mysqli_fetch_array($check1)){
				  $PD_price = $crow1['PD_price'];
      ?>
       		<td class="text-right"><?php echo $PD_price; ?></td>
           <?php } } 
		   else{ ?>
           
           <td class="text-right"><?php echo $test_price; ?></td>
           <?php } } ?>
           
           
    </tr>
<?php $sl_no++; } ?>
</tbody>   
</table>

</div>
</div>
</div>
</div>
<div class="clear"></div>
</div>
<?php require_once("footer.php"); ?> 
<?php require_once("script_bootstrap.php"); ?>
<?php require_once("script_saveto_excel.php");?>
<?php require_once("script_print_bw_div.php");?>
</body>
</html>
<?php ob_flush();?>