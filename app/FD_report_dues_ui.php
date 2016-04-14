<?php require_once("check_login_fd.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Dues Sheet - Type</title>
  <?php include("css_bootstrap_header.php");?>
  <?php include("print-borderless-tbl.php");?>
</head>
<body>
<?php if($_SESSION['user_dept_id'] == '2'){require_once("right_top_header_admin.php");} else if($_SESSION['user_dept_id'] == '3'){require_once("right_top_header.php");}?>
<div class="container">
 <div class="page-content">

 <div class="inv-main">
  <div class="panel panel-success">

      <!------------ Print & SAve------------>
    <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> FD - <span class="panel-subTitle"> Dues Sheet </span>

<button id="close_all" class="no-print btn btn-mini btn-primary pull-right" style="margin-left:10px; margin-top:-5px;">
      <i class="fa fa-reorder fa-lg"></i> Reset&nbsp;</button>

   <button onclick="window.print()" class="no-print btn btn-mini btn-primary pull-right" style="margin-left:10px; margin-top:-5px;">
      <i class="fa fa-print fa-lg"></i> Print&nbsp;</button>
    <button type="button" onclick="tableToExcel('due_ui', 'W3C Example Table')" class="no-print btn btn-mini btn-primary pull-right"  style="margin-top:-5px;"><i class="fa fa-file-excel-o fa-fw"></i> Save</button>
    </span>
     </h3>
   </div>

<div class="row" style="width:90%; margin-left:5%;">

     <table cellpadding="0" cellspacing="0" border="0" class=" table-condensed table-hover width_100" id="due_ui">
        <thead align="left">
        <tr>
          <th class="text-center blue_color" colspan="6" id="th_bg_color"> Front Desk Dues Sheet </th>
         </tr>
        <tr>
          <th class="text-center"> Sl.no. </th>
          <th> Source Type</th>
          <!--<th class="text-center"> No.of EDs</th>
          <th class="text-center"> No.of Investigation</th>  -->
         <th class="text-right"> Due Amount</th>
         <th class="text-center no-print">View</th>
        </tr>
        </thead>
  <tbody>
<?php
$result_test = mysqli_query($con, "SELECT source_name, source_id FROM source_tbl ORDER BY source_name ASC");
$sl_no=1;
while ($charge = mysqli_fetch_array($result_test))
{
 	$source_type = $charge['source_name'];
	$source_id = $charge['source_id'];
    //$total_EDs_source = total_EDs_source($con, $source_id);
	//$total_investigation_source = total_investigation_source($con, $source_id);
	$TotalBal_source = TotalBal_source($con, $source_id);
	if($TotalBal_source !='0'){
	?>

 <tr>
    <td class="text-center"> <?php echo $sl_no; ?> </td>
    <td><?php echo $source_type; ?> </td>

    <td class="text-right"><?php  if($TotalBal_source == ''){echo '0.00';}else{ echo $TotalBal_source; } ?> </td>
     <form  action="FD_report_balance_sheet_each.php"class="form-horizontal inv-form form_each" role="form" method="get" target="_blank" id="form_each">
    <td class="text-center no-print">
    <input type="hidden" name="src_id" value="<?php echo $source_id; ?>">
    <input type="hidden" name="type" value="33">
    <button class="btn btn-mini btn-primary" type="submit"> <i class="fa fa-list fa-fw"></i></button>
    </td>
    </form>
 </tr>

 <?php
	$sl_no++;
}
}
?>
		 <tr style="font-weight:bold;">
            <td colspan="2" class="text-right"> Total :</td>

            <td class="text-right"><i class="fa fa-inr"></i> <?php echo total_balance_all($con);?> </td>

    <td class="text-center no-print">
    <form  action="FD_report_balance_sheet_all.php"class="form-horizontal inv-form form_each" role="form" method="get" target="_blank" id="form_all">
    <input type="hidden" name="src_id" value="<?php echo $source_id; ?>">
    <input type="hidden" name="type" value="11">
    <button class="btn btn-mini btn-primary" type="submit"> All Dues</button>
    </form>
    </td>



          </tr>
        </tbody>
</table>

</div>
</div>
<div class="clear"></div>
</div>

<?php include("footer.php"); ?>
<?php include("script_bootstrap.php"); ?>
<?php require_once("script_saveto_excel.php"); ?>
<script>
$(document).ready(function(){

$('.form_each').submit(function(){
     window.open('', 'FD_report_balance_sheet_each.php', "width=1300,height=550,resizeable,scrollbars");
    this.target = 'FD_report_balance_sheet_each.php';
    });
$('.form_all').submit(function(){
     window.open('', 'FD_report_balance_sheet_all.php', "width=1300,height=550,resizeable,scrollbars");
    this.target = 'FD_report_balance_sheet_all.php';
    });

$('#close_all').click(function(e) {
       myWindow1 = window.open('', 'FD_report_balance_sheet_each.php');
     myWindow1.close();
     myWindow2 = window.open('', 'FD_report_balance_sheet_all.php');
     myWindow2.close();
    });



});
</script>

</body>
</html>
<?php ob_flush(); ?>
