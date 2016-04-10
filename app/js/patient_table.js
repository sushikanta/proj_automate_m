// JavaScript Document - patient_table

$(document).ready(function() {	
    
  $('#p_list_table').dataTable( {  
  
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
		  $('.dataTables_length select').addClass('form-control input-sm');
		  $('.dataTables_length select').css('height', '33px');	
		  $('.dataTables_length select').css('margin-right', '3px');	
		  $('.dataTables_length select').css('margin-bottom', '10px');
		  $('.dataTables_length select').css('float', 'left');  }
	   		
				
     } ).makeEditable({
		
        sDeleteURL:   "ajax_patient_registration_delete.php",
		sUpdateURL:   "ajax_patient_table_update.php",
			
		sAddNewRowFormId:  "formPatient_list",
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
					
						{
							tooltip: 'Click to update',
							loadtext: 'loading...',
							cssclass: 'required',
							width: '50%',
							type: 'select',
							onblur: 'cancel',
							submit: 'ok',
							event: 'click',
							data: "{'1':'Pending','5':'Delivered','6':'Blocked','11':'Report Available', '12':'Report Return' }",
							},				  
						
						{							
							tooltip: 'Click to update',
							loadtext: 'loading...',
							cssclass: 'required',
							onblur: 'cancel',
							submit: 'ok',
							width: '50%',
							event: 'click',
							oValidationOptions : 
										   {     rules:{ value: { required: true, number: true, minlength: 1 } },
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
								
								setTimeout('window.location.reload()', 1000);
                                break;
                            case "delete":
                                jAlert(message, "Delete failed");
								setTimeout('window.location.reload()', 1000);
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
						 window.location.reload();
                    },
					
				/*fnOnEditing: function(input)
				{ 	
					$("#trace").append("Updating cell with value " + input.val());
					return true;
				},
            			fnOnEdited: function(status)
				{ 	
					$("#trace").append("Edit action finished. Status - " + status);
				},
				*/
					
					
					
                    fnOnDeleting: function (tr, id, fnDeleteRow) {
                        jConfirm('Please confirm that you want to delete selected row', 'Confirm Delete', function (r) {
                            if (r) {
                               fnDeleteRow(id);
                            }
                        });
                        return false;
                    }
    } );
	
} );
 
