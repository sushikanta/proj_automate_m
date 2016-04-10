<?php require_once("check_login_admin.php");
	resetcounter($con, 42, 'dd');  // reset audit
?>
<!DOCTYPE html>
<html>
  <head>
  <title>Edit/Delete Expenditure</title>
  <?php require_once("css_bootstrap_datatable_header.php");?> 
</head>
<?php  if(isset($_GET['start']) && $_GET['start'] !="" && isset($_GET['end']) && $_GET['end'] !="")
	{
	$start =  date("Y-m-d", strtotime($_GET['start']));
	$end =  date("Y-m-d", strtotime($_GET['end']));
?>


<body>
<?php require_once("right_top_header_popup.php");?>
	<div class="container">
		<div class="page-content">   
        
<div class="inv-main">
  <div class="panel panel-success">
   <div class="panel-heading no-print light_purple_color">
   <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
    Edit / Delete <span class="panel-subTitle">( Expenditure )</span>
   <span class="date_time pull-right light_purple_color" style="padding-right:10px;"> <i class="fa fa-calendar"></i> <span id="show_date"></span></span>  
   </h3>
   </div>      
                                   
<table cellpadding="0" cellspacing="0" border="0" class="table-hover" id="expenditure_table">
<thead align="left">
<tr>
  <th> Sl.no</th>  
  <th> Exp ID</th>
  <th> Voucher no.</th>
  <th> Particulars</th>
  <th> Receiver</th>
  <th> Date</th>
  <th> HH (24h Format)</th>
  <th class="text-right"> Amount</th>
  <th> Added by</th> 
</tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT e.EX_id, e.EX_voucher, e.EX_particular, e.EX_person, e.EX_amount, e.EX_date, e.EX_user, u.user_name FROM expenditure e LEFT JOIN user_table u ON u.user_id = e.EX_user WHERE DATE_FORMAT(e.EX_date, '%Y-%m-%d') BETWEEN '$start' AND '$end'");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
	$EX_id = $row['EX_id'];
	$EX_voucher = $row['EX_voucher'];
	$EX_particular = $row['EX_particular'];
	$EX_person = $row['EX_person'];
	$EX_amount = $row['EX_amount'];
	$EX_date = $row['EX_date'];
	$EX_user = $row['EX_user'];
	$user_name = $row['user_name'];
 ?>
 	<tr id ="<?php echo $EX_id;?>">
       <td><?php echo $sl_no; ?></td>
       <td><?php echo $EX_id; ?></td>
	   <td><?php echo $row['EX_voucher']; ?></td> 
       <td><?php echo $row['EX_particular']; ?></td> 
       <td><?php echo $row['EX_person']; ?></td> 
	   <td><?php echo date("d/m/Y", strtotime($row['EX_date']));?></td>
       <td><?php echo date("H", strtotime($row['EX_date']));?></td>
       <td class="text-right"><?php echo number_format($row['EX_amount'], 2, '.', '');?></td>
       <td><?php echo $user_name;?></td>
     </tr>	
<?php
$sl_no++;
}
?>
</tbody>
</table>
<div class="add_delete_toolbar"/>
  <div class="clear"></div>
</div>

<?php include("footer.php"); ?>   
<?php include("script_bootstrap_datatable.php"); ?>
<script src="js/jeditable.datepicker.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8"> 
$(document).ready(function() {    
  $('#expenditure_table').dataTable({
		"bJQueryUI": true,
		"bPaginate": false,
		"bProcessing": true,
        "bStateSave": true,
		"bBootstrap": true,
		"bAutoWidth": false,
		"bFilter":true,
		"bInfo":false,
		"fnPreDrawCallback": function( oSettings ) {		
		  $('.dataTables_filter input').addClass('form-control input-sm');
		  $('.dataTables_filter input').attr('placeholder', 'Search');	
		  $('.dataTables_filter input').css('height', '33px');
		  $('.dataTables_length select').addClass('form-control input-sm');
		  $('.dataTables_length select').css('height', '33px');	
		  $('.dataTables_length select').css('margin-right', '3px');	
		  $('.dataTables_length select').css('margin-bottom', '10px');
		  $('.dataTables_length select').css('float', 'left');		
		 }
     });
	 
  $('#expenditure_table').dataTable().makeEditable({
		sUpdateURL: "expenditure_ajax_update.php",
		sDeleteURL: "expenditure_ajax_delete.php",
		oDeleteRowButtonOptions: { 
				label: "Remove",
				icons: {primary:'ui-icon-trash'}
				},	
		aoColumns: [
                    	null,
                    	null,
						{
						 placeholder : '',
						  loadtext: 'loading...',
						  cssclass: 'required',
						  tooltip: 'Click to Edit',
						  onblur: 'cancel',
						  submit: 'OK',
						  event: 'click',
						  width: '60%',			
						  oValidationOptions : 
							 {  rules:{  value: { required: true, minlength: 2 } },}									  
						 },
						 
						 {
						  placeholder : '',
						  loadtext: 'loading...',
						  //indicator: 'saving...',
						  cssclass: 'required',
						  tooltip: 'Click to Edit',
						  type: 'text',
						  onblur: 'cancel',
						  submit: 'OK',
						  event: 'click',
						  width: '80%',						
						  oValidationOptions : 
							 {  rules:{  value: { required: true, minlength: 2 } },}									  
						 },
						 
						 {
						  placeholder : '',
						  loadtext: 'loading...',
						  ////indicator: 'saving...',
						  cssclass: 'required',
						  tooltip: 'Click to Edit',
						  type: 'text',
						  onblur: 'cancel',
						  submit: 'OK',
						  event: 'click',
						  width: '60%',						
						  oValidationOptions : 
							 {  rules:{  value: { required: true, minlength: 2 } },}									  
						 },

						{
						  placeholder : '',
						  loadtext: 'loading...',
						  //indicator: 'saving...',
						  cssclass: 'required',
						  tooltip: 'Click to Edit',
						  type: 'datepicker',
						  onblur: 'cancel',
						  submit: 'OK',
						  event: 'click',
						  width: '60%',								  
						 },
						 {
						  placeholder : '',
						  loadtext: 'loading...',
						  cssclass: 'required',
						  tooltip: 'Click to Edit',
						  onblur: 'cancel',
						  submit: 'OK',
						  event: 'click',
						  width: '60%',
						  oValidationOptions : 
							 {  rules:{  value: { required: true, max:24 } },}												  
						 }, 
						
						 {
						  placeholder : '',
						  loadtext: 'loading...',
						  //indicator: 'saving...',
						  cssclass: 'required',
						  tooltip: 'Click to Edit',
						  type: 'text',
						  onblur: 'cancel',
						  submit: 'OK',
						  event: 'click',
						  width: '60%',						
						  oValidationOptions : 
							 {  rules:{  value: { required: true, number:true } },}									  
						 }, 
						null,                    				                  				
			 
                    ],
			fnShowError: function (message, action) {
                        switch (action) {
                            case "update":
                                jAlert(message, "Update failed");
								//window.location.reload();
                                break;
                            case "delete":
                                jAlert(message, "Delete failed");
								//window.location.reload();
                                break;
                            case "add":
                               jAlert(message, "Add failed");
                                break;
                        }
                    },
			});
});
</script>
</body>
</html>
<?php } ob_flush();?>