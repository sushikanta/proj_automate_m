$(document).ready(function() {				
 				
// Discount table - editable datatable

$('#disc_table').dataTable( {        

		"bJQueryUI": true,
		"bPaginate": true,
		"bProcessing": true,
        "bStateSave": true,
		"bBootstrap": true,
		"bAutoWidth": false,		

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
			
				
     } ).makeEditable({
		
        sDeleteURL:   "ajax_patient_registration_delete.php",
			
		sAddNewRowFormId:  "formNewDisc",
		sAddNewRowButtonId: "btnAddNewRow",	
		sDeleteRowButtonId: "btnDeleteRow",
	
		   
		oDeleteRowButtonOptions: {
                                label: "Remove",
                                icons: { primary: 'ui-icon-trash' }
		},
			
		aoColumns: [
					null,
					null,
					null,
					null,
					null,
					null,
					null,
					null,
					null,
						{
							tooltip: 'Click to update status',
							loadtext: 'loading...',
							cssclass: 'required',
							width: '80%',
							type: 'select',
							onblur: 'cancel',
							submit: 'OK',
							event: 'click',
							loadurl: 'custom_status_patient_table.php',
							sUpdateURL: "CustomUpdateReceipt_status.php"
							},				  
						null,
						{							
							tooltip: 'Click to update balance',
							loadtext: 'loading...',
							cssclass: 'required',
							onblur: 'cancel',
							submit: 'OK',
							width: '70%',
							event: 'click',
							sUpdateURL: "custom_update_balance_amount.php",
							oValidationOptions : 
										   {     rules:{ value: { required: true, minlength: 1 } },
											 messages: { value: { minlength: "Min. 1 digit" } }						  
		                                   },
						},
						
				  null,  
				  null,
				],
					
	fnShowError: function (message, action) {
                        switch (action) {
                            case "update":
                                jAlert(message, "Update failed");
								setTimeout('window.location.reload()', 800);
                                break;
                            case "delete":
                                jAlert(message, "Delete failed");
								setTimeout('window.location.reload()', 1500);
                                break;
                            case "add":
                                $("#lblAddError").html(message);
                                $("#lblAddError").show();
                                break;
                        }
                    },
                    fnStartProcessingMode: function () {
                        $("#processing_message").dialog();
						
						
                    },
                    fnEndProcessingMode: function () {
                        $("#processing_message").dialog("close");    
						 //window.location.reload();
                    },
					
                    fnOnDeleting: function (tr, id, fnDeleteRow) {
                        jConfirm('Please confirm that you want to delete selected row', 'Confirm Delete', function (r) {
                            if (r) {
                               fnDeleteRow(id);
                            }
                        });
                        return false;
                    }
    } );
	 var qTable = $('#disc_table').dataTable(); 
  qTable.fnSetColumnVis( 0, false );  // Hide the first column after initialisation


	
	

}); 