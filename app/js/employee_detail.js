$(document).ready(function() {
 
  if ($('#check_address_yes').is(':checked')) {   // show/Hide Empl Temporary address div if button is checked as Yes/No
		 $('#emp_tempAddress_div').show();		 
	     }
		 else
		 {
			$('#emp_tempAddress_div').hide();		
			 }

 $("#check_address_yes, #check_address_no").click(function () {			// CLICK on Temp Address ? buttons
	  if ($('input[name=check_present_address][value=1]').prop("checked")) {
		  $('#emp_tempAddress_div').slideDown("fast");	
	     }
	  else if ($('input[name=check_present_address][value=2]').prop("checked")) {
		  $('#emp_tempAddress_div').slideUp("fast");	
	     }
	 
  });   

$( "#emp_dob" ).datepicker({   // Employee date of birth
changeMonth: true,
changeYear: true,
yearRange: "-100:+0", // Setting yearRange of 10 years ago
dateFormat: "dd-M-yy",
});

$( "#emp_joining_date" ).datepicker({   //
changeMonth: true,
changeYear: true,
yearRange: "-10:+1", // Setting yearRange of 10 years ago
dateFormat: "dd-M-yy",
});

/* --------------------------------------Start Qualification --------------------------------------------------*/	
		
$('#qualf_table').dataTable( {	

        "bJQueryUI": true,
		"bPaginate": true,
		"bProcessing": true,
        "bStateSave": true,
		"bBootstrap": true,
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
			
				
     } ).makeEditable({
		 
		 
		 aoTableActions: [
								{
								 sAction: "EditQualf",
								 sServerActionURL: "ajax_qualf_update.php",
								 oFormOptions: { 
								 autoOpen: false, 
								 modal: true,
								 resizable: false,
				                 draggable: true, 
								 width:'auto',
								 height: 'auto',
								 backdrop: 'static',				
				                 position: { my: "top", at: "centre", of: window }								 
								  }
								}
						], 
		 
		 
		 
		sAddURL:           "ajax_qualf_add.php",
        sDeleteURL:        "ajax_qualf_delete.php",
		sUpdateURL:        "ajax_qualf_update.php",
		
		sAddNewRowFormId:  "formNew_qualf",			
		sAddNewRowButtonId: "btnAddNewRow1",
		sAddNewRowOkButtonId: "btnAddNewRowOk1",
		sAddNewRowCancelButtonId: "btnAddNewRowCancel1",
		sDeleteRowButtonId: "btnDeleteRow1",
		
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
				title: 'Add new experience',
				resizable: false,
				draggable: true,
				autoOpen: false, 
				modal: true,
				//hide: 'fade', 
				width:'auto',
				height: 'auto',
				backdrop: 'static',				
				position: { my: "top", at: "centre", of: window }		

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
                        jConfirm('Please confirm that you want to delete selected row', 'Confirm Delete', function (r) {
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


    } );
	
  var qTable = $('#qualf_table').dataTable(); 
  qTable.fnSetColumnVis( 0, false );  // Hide the first column after initialisation
  qTable.fnSetColumnVis( 1, false );   // Hide the second column after initialisation
		
/* --------------------------------------End Qualification - Editable --------------------------------------------------*/	

/* --------------------------------------Start Exerience - Editable --------------------------------------------------*/	

$('#exp_table').dataTable( {	       		

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
		 
		 
		 aoTableActions: [
								{
								 sAction: "EditData",
								 sServerActionURL: "ajax_exper_update.php",
								 oFormOptions: { 
								 autoOpen: false, 
								 modal: true,
								 resizable: false,
				                 draggable: true, 
								 width:'auto',
								 height:'auto',
								 backdrop: 'static',
								 cssclass: 'required',				
				                 position: { my: "top", at: "centre", of: window }	
								  }
								}
						], 
		 
		 
		 
		sAddURL:           "ajax_exper_add.php",
        sDeleteURL:        "ajax_exper_delete.php",
		sUpdateURL:        "ajax_exper_update.php",
		
		sAddNewRowFormId:  "formNew_experience",			
		sAddNewRowButtonId: "btnAddNewRow2",
		sAddNewRowOkButtonId: "btnAddNewRowOk2",
		sAddNewRowCancelButtonId: "btnAddNewRowCancel2",
		sDeleteRowButtonId: "btnDeleteRow2",
		
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
				title: 'Add new experience',
				autoOpen: false,
				modal: true,
				resizable: false,
				draggable: true,
				hide: 'fade', 
				width:'auto',
				height: 'auto',	
				cssclass: 'required',				
				position: { my: "top", at: "centre", of: window }	
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
					
                    fnOnDeleting: function (tr, id, fnDeleteRow) {
                        jConfirm('Please confirm that you want to delete selected row', 'Confirm Delete', function (r) {
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


    } );
 
 var oTable = $('#exp_table').dataTable(); 
  oTable.fnSetColumnVis( 0, false );  // Hide the first column after initialisation
  oTable.fnSetColumnVis( 1, false );   // Hide the second column after initialisation
  
$("#joined_date, #last_date" ).removeClass('hasDatepicker').datepicker({   // for new record
changeMonth: true,
changeYear: true,
yearRange: "-10:+0", // Setting yearRange of 10 years ago
dateFormat: "dd-M-yy",
onSelect: function () {
    var start = $('#joined_date').datepicker('getDate');
    var end   = $('#last_date').datepicker('getDate');
    if(!start || !end)
        return;
    var diff = ((end - start)/1000/60/60/24/365).toFixed(3);
	$('#total_year').val(diff);  
	}
});

$("#joined_date_edit, #last_date_edit" ).removeClass('hasDatepicker').datepicker({   // for editing form
changeMonth: true,
changeYear: true,
yearRange: "-10:+0", // Setting yearRange of 10 years ago
dateFormat: "dd-M-yy",
onSelect: function () {
    var start = $('#joined_date_edit').datepicker('getDate');
    var end   = $('#last_date_edit').datepicker('getDate');
    if(!start || !end)
        return;
    var diff_edit = ((end - start)/1000/60/60/24/365).toFixed(3);
	$('#total_year_edit').val(diff_edit);  
	},
});		

 /* --------------------------------------End Experience - Editable --------------------------------------------------*/	  
  
$('emp_submit').submit(function(e){
e.preventDefault();
});
 
} );






