<?php require_once("function.php");
session_start();
ob_start();
if(!isset($_SESSION['status'])){
	header("location: index.php"); 
	exit;	
	}
elseif(isset($_SESSION['user_dept_id']) && $_SESSION['user_dept_id'] == '2')
 {
?>
<!DOCTYPE html>
<html>
<?php require_once("css_bootstrap_datatable_header.php");?> 
<body>
<?php require_once("right_top_header_admin.php");?>
<div class="container">
 <div class="page-content">               
 <div class="inv-main">
<?php 
$table_dr_id = $_GET['table_dr_id'];

if(isset($table_dr_id))
{   
   	$result = mysqli_query($con, "SELECT * FROM `dr_profile` WHERE `dr_id` = '$table_dr_id'");
	$sl_no=1;
	while ($row = mysqli_fetch_array($result))
	{
	?>
	
	 <div class="panel panel-success"> <!-----------------START Doctor Information--------------->
		 <div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-user-md"></i> Doctor - Personal Info
            <a class="text-right pull-right navbar-link" href="doctor_table.php"><i class="fa fa-arrow-circle-right fa-lg"></i></a>
            </h3>
		 </div>
		 
		<div class="control-group">
			  <label for="inputName" class="col-lg-2 control-label text-right">Doctor Name :</label>
			  <div class="col-lg-2">
				<span class="input-xlarge uneditable-input text-control"><?php echo $row['dr_name'];?></span>
			  </div>
			   <label for="inputSex" class="col-lg-2 control-label text-right">Specialisation :</label>
			  <div class="col-lg-2">					      
				<span class="input-xlarge uneditable-input text-control"> <?php echo $row['dr_specialization'];?></span>
			  </div>
			  <label for="inputAdress" class="col-lg-2 control-label text-right">Designation :</label>
			  <div class="col-lg-2">
				<span class="input-xlarge uneditable-input text-control"><?php echo $row['dr_designation'];?></span>
			  </div>  
		</div>
		
		<div class="control-group">
			  <label for="inputName" class="col-lg-2 control-label text-right">Working at :</label>
			  <div class="col-lg-2">
				<span class="input-xlarge uneditable-input text-control"><?php echo $row['dr_institute'];?></span>
			  </div>
			   <label for="inputSex" class="col-lg-2 control-label text-right">Email :</label>
			  <div class="col-lg-2">					      
				<span class="input-xlarge uneditable-input text-control"> <?php echo $row['dr_email'];?></span>
			  </div>
			  <label for="inputAdress" class="col-lg-2 control-label text-right">Contact Number :</label>
			  <div class="col-lg-2">
				<span class="input-xlarge uneditable-input text-control"><?php echo $row['dr_phone'];?></span>
			  </div>  
		</div>
		
		<div class="control-group">
			  <label for="inputName" class="col-lg-2 control-label text-right">Address :</label>
			  <div class="col-lg-2">
				<span class="input-xlarge uneditable-input text-control"><?php echo $row['dr_pres_address'].", ".$row['dr_pres_district'];?></span>
			  </div>
			   <label for="inputSex" class="col-lg-2 control-label text-right">State :</label>
			  <div class="col-lg-2">					      
				<span class="input-xlarge uneditable-input text-control"> <?php echo $row['dr_pres_state'];?></span>
			  </div>
			  <label for="inputAdress" class="col-lg-2 control-label text-right">PIN Code :</label>
			  <div class="col-lg-2">
				<span class="input-xlarge uneditable-input text-control"><?php echo $row['dr_pres_pin'];?></span>
			  </div>  
		</div>   
		
	<div class="clear"></div>
	</div>  	  
	<?php } ?> 	
         
<!------------------------------------------- Personal Info end ------------------------------------------------->


<div class="panel panel-success" id="dr_clinic_infoPanel">   <!---------------------------------- START Clinic section --------------------------------->				  	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-medkit"></i> Doctor - Clinic Info
         <a class="text-right pull-right navbar-link" href="doctor_table.php"><i class="fa fa-arrow-circle-right fa-lg"></i></a>
        </h3>
    </div>
    
    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered display" id="clinic_table">
        <thead align="left">
        <tr>
          <th style="display: none;"> clinic_id</th>
          <th style="display: none;"> dr_id</th>
          <th> # </th>
          <th> Clinic Name</th>          
          <th> Address</th>
          <th> Phone</th>
          <th><i class="fa fa-edit"></i> Edit</th>    
        </tr>
       </thead>     
  <tbody>
<?php
$result_clinic = mysqli_query($con, "SELECT * FROM `dr_clinic_tbl` WHERE `dr_id` = '$table_dr_id'");
$sl_no=1;
while ($clinic = mysqli_fetch_array($result_clinic))
{
?>
 <tr id="<?php echo $clinic['clinic_id'];?>">
      <td style="display:none;"><?php echo $clinic['clinic_id']; ?></td>
      <td style="display:none;"><?php echo $clinic['dr_id']; ?></td>
      <td class="readonly-bg"><?php echo $sl_no; ?> </td>  
      <td class="readonly-bg"><?php echo  $clinic['clinic_name']; ?> </td>  
      <td class="readonly-bg"><?php echo  $clinic['clinic_address']; ?> </td> 
      <td class="readonly-bg"><?php echo  $clinic['clinic_phone']; ?> </td>
      <td><a class="table-action-EditClinic navbar-link" style="cursor:pointer;"><i class="fa fa-pencil"></i> Edit</a></td>
 </tr>
 <?php
	$sl_no++;
}
?>
</tbody>
</table>    
<!---------------------------------------- Form for Edit clinic ------------------------->
<form id="formEditClinic" action="ajax_clinic_update.php" title="Update selected row">  

 <label style="display:none;">Clinic_id</label>
 <label style="display:none;">Dr_id</label>
 <label style="margin-right:43px;">#</label>
 <label style="margin-right:97px">Clinic Name</label>
 <label style="margin-right:130px;">Address</label>
 <label style="margin-right:32px;">Phone</label>
 <br />
    <input type="hidden" name="hidden_clinic_id" id="hidden_clinic_id" value="<?php echo $clinic['emp_clinicf_id']; ?>" rel="0"/> 
	<input type="hidden" name="hidden_dr_id" id="hidden_dr_id" value="<?php echo $clinic['dr_id']; ?>" rel="1"/>   
    <input type="text" style="width:45px;  margin-right:10px;" name="sl_no" id="sl_no" value="<?php echo $sl_no;?>" disabled rel="2" />        
    <input type="text" style="width:190px; margin-right:10px;" name="clinic_name" id="clinic_name" rel="3" />
    <input type="text" style="width:190px; margin-right:10px;" name="clinic_address" id="clinic_address" rel="4" />
    <input type="text" style="width:110px; margin-right:10px;" name="clinic_phone" id="clinic_phone" rel="5" />  
 <br /> 
    <span class="datafield" style="display:none" rel="6"><a class="table-action-EditClinic navbar-link"><i class="fa fa-pencil"></i> Edit</a></span>
    <br />
    <button id="formEditClinicCancel" type="button">Cancel</button>      
    <button id="formEditClinicOk"     type="submit">Confirm</button>                  
</form>

<!---------------------------------------- Form for new clinic---------------------------->
<form id="formNewClinic" action="#"> 
<label id="lblAddError1" style="display:none" class="error"></label>
 <div id="processing_message1" style="display:none" title="Processing">Please wait while processing....</div>
 
 <label style="display:none;">Clinic_id</label>
 <label style="display:none;">Dr_id</label>
 <label style="margin-right:43px;">#</label>
 <label style="margin-right:97px">Clinic Name</label>
 <label style="margin-right:290px;">Address</label>
 <label style="margin-right:32px;">Phone</label>
 <br />
    <input type="hidden" name="hidden_clinic_id" id="hidden_clinic_id" value="<?php echo $clinic['emp_clinicf_id']; ?>" rel="0"/> 
	<input type="hidden" name="hidden_dr_id" id="hidden_dr_id" value="<?php echo $table_dr_id; ?>" rel="1"/>   
    <input type="text" style="width:45px;  margin-right:10px;" name="sl_no" id="sl_no" value="<?php echo $sl_no;?>" disabled rel="2" />        
    <input type="text" style="width:190px; margin-right:10px;" name="clinic_name" id="clinic_name" rel="3" />
    <input type="text" style="width:350px; margin-right:10px;" name="clinic_address" id="clinic_address" rel="4" />
    <input type="text" style="width:110px; margin-right:10px;" name="clinic_phone" id="clinic_phone" rel="5" />  
    <br/ >
    <span class="datafield" style="display:none" rel="6"><a class="table-action-EditClinic">Edit</a></span>
    <br/ >
    <button id="btnAddNewRowCancel1" type="button">Cancel</button>      
    <button id="btnAddNewRowOk1" type="submit">Confirm</button> 
   </form> 
<button id="btnDeleteRow1">Delete</button> <button id="btnAddNewRow1">Add</button>
</div> <!------------------------------------------- END clinic -------------------------------------------->   

<?php } ?>
<div class="clear"></div>
</div>
<?php require_once("footer.php"); ?> 
<?php require_once("script_bootstrap_datatable.php"); ?>     
<script type="text/javascript">
 $(document).ready(function() {
    
 /*----------------------------------START CLINIC dataeditable ---------------------------------------------------------*/
$('#clinic_table').dataTable( {	        		

        "bJQueryUI": true,
		"bPaginate": true,
		"bProcessing": true,
        "bStateSave": true,
		"bBootstrap": true,
		"fnPreDrawCallback": function( oSettings ) {		
		  $('.dataTables_filter input').addClass('form-control input-sm');
		  $('.dataTables_filter input').attr('placeholder', 'Search');	
		  $('.dataTables_filter input').css('height', '33px');
		  //$('.dataTables_filter input').css('margin-right', '15px');
		  $('.dataTables_length select').addClass('form-control input-sm');
		  //$('.dataTables_length label').addClass('form-control input-sm');
		  //$('.dataTables_length label').css('width', '400px');
		  $('.dataTables_length select').css('height', '33px');	
		  $('.dataTables_length select').css('margin-right', '3px');	
		  $('.dataTables_length select').css('margin-bottom', '10px');
		  $('.dataTables_length select').css('float', 'left');
	   }
       }).makeEditable({
		   
		 aoTableActions: [
		                	{
								 sAction: "EditClinic",
								 sAddNewRowFormId:  "formEditClinic",
								 sAddNewRowOkButtonId: "formEditClinicOk",
								 sAddNewRowCancelButtonId: "formEditClinicCancel",
								 sServerActionURL: "ajax_clinic_update.php",
								 oFormOptions: { 
								 title: 'Edit Clinic Information',
								 autoOpen: false, 
								 modal: true,
								 resizable: false,
				                 draggable: true,
								 cssclass: 'required', 
								 width:'auto',
								 height: 'auto', }
								}
						], 
		sAddURL:           "ajax_clinic_add.php",
        sDeleteURL:        "ajax_clinic_delete.php",
		sUpdateURL:        "ajax_clinic_update.php",
		
		sAddNewRowFormId:  "formNewClinic",	
		sAddNewRowButtonId: "btnAddNewRow1",
		sDeleteRowButtonId: "btnDeleteRow1",
		sAddNewRowOkButtonId: "btnAddNewRowOk1",
		sAddNewRowCancelButtonId: "btnAddNewRowCancel1",		
		
		
		oAddNewRowButtonOptions: { 
				label: "Add...",
				icons: {primary:'ui-icon-plus'}
				},
	    oDeleteRowButtonOptions: { 
				label: "Remove",
				icons: {primary:'ui-icon-trash'}
				},
		oAddNewRowOkButtonOptions: {
				label: "Confirm",
                icons: { primary: 'ui-icon-check' },
				name: "action",
				value: "add-new"
				},
        oAddNewRowCancelButtonOptions: { 
				label: "Cancel",
				class: "back-class",
				name: "action",
				value: "cancel-add",
				icons: { primary: 'ui-icon-close' }
				},
        oAddNewRowFormOptions: {
				title: 'Add new Clinic Information',
				resizable: false,
				draggable: true,
				modal: true,
				width:'auto',
				height: 'auto',
				cssclass: 'required',
				}, 		
	
			aoColumns: [
                    	null,                    				
						null,
						null,                    				
						null,
						null,                    				
					   ],
					   
	fnShowError: function (message, action) {
                        switch (action) {
                            case "update":
                                jAlert(message, "Update failed");
                                break;
                            case "delete":
                                jAlert(message, "Delete failed");
                                break;
                            case "add":
                                $("#lblAddError1").html(message);
                                $("#lblAddError1").show();
                                break;
                        }
                    },
                    fnStartProcessingMode: function () {
                        $("#processing_message1").dialog();
						
                    },
                    fnEndProcessingMode: function () {
                        $("#processing_message1").dialog("close");    
						window.location.reload();
						
                    },
					
                    fnOnDeleting: function (tr, id, fnDeleteRow) {
                        jConfirm('Please confirm that you want to delete selected Clinic', 'Confirm Delete', function (r) {
                            if (r) {
                                fnDeleteRow(id);
                            }
                        });
                        return false;
                    },
				fnOnEditing: function(input)
                             {  
                                    cell= input.parents("tr")
                                               .children("td:first")
                                               .text();
                                    return true
                            },
                oUpdateParameters: {
                                cell: function(){ return cell; } 
                        }

    });
 
 var qTable = $('#clinic_table').dataTable(); 
  qTable.fnSetColumnVis( 0, false );  // Hide the first column after initialisation
  qTable.fnSetColumnVis( 1, false );   // Hide the second column after initialisation

event.preventDefault();
  
});	
 
 </script>
</body>
</html>
<?php } ob_flush(); ?>