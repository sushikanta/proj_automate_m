$(document).ready(function() {

if($('#clinic_yes').is(':checked'))   // show/Hide Emp Experience panel if button is checked as Yes/No
      { $('#dr_clinic_infoPanel').show(); }
 else { $('#dr_clinic_infoPanel').hide(); }			
 			
 
if ($('#family_yes').is(':checked'))    // show/Hide Empl Temporary address div if button is checked as Yes/No
	   { $('#dr_family_infoPanel').show(); }
 else  { $('#dr_family_infoPanel').hide(); }

// CLICK on Has clinic? buttons
  $("#clinic_yes, #clinic_no, #family_yes, #family_no").click(function () {
	  
	if ($('input[name=dr_clinicOption][value=Yes]').prop("checked") && $('input[name=dr_familyOption][value=Yes]').prop("checked")) 
	   { $('#dr_clinic_infoPanel').slideDown("fast");
		 $('#dr_family_infoPanel').slideDown("fast"); }
else if ($('input[name=dr_clinicOption][value=Yes]').prop("checked") && $('input[name=dr_familyOption][value=No]').prop("checked")) 
       { $('#dr_clinic_infoPanel').slideDown("fast");
		 $('#dr_family_infoPanel').slideUp("fast"); }
else if ($('input[name=dr_clinicOption][value=No]').prop("checked") && $('input[name=dr_familyOption][value=Yes]').prop("checked")) 
       { $('#dr_clinic_infoPanel').slideUp("fast");
		 $('#dr_family_infoPanel').slideDown("fast"); }
else if ($('input[name=dr_clinicOption][value=No]').prop("checked") && $('input[name=dr_familyOption][value=No]').prop("checked")) 
       { $('#dr_clinic_infoPanel').slideUp("fast");
		 $('#dr_family_infoPanel').slideUp("fast"); }
  });     

$( "#family_dob, #family_dob_edit" ).removeClass('hasDatepicker').datepicker({   //family member date of birth
changeMonth: true,
changeYear: true,
yearRange: "-100:+0", // Setting yearRange of 120 years ago
dateFormat: "dd-M-yy",
});

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
								 title: 'Edit Clinic information',
								 autoOpen: false, 
								 modal: true,
								 resizable: false,
				                 draggable: true,
								 cssclass: 'required', 
								 width:'auto',
								 height: 'auto',
								 //position: { my: "top", at: "centre", of: window }								 
								  }
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
				title: 'Add new Clinic information',
				resizable: false,
				draggable: true,
				modal: true,
				hide: 'fade', 
				width:'auto',
				height: 'auto',
				cssclass: 'required',
				position: { my: "top", at: "centre", of: window },
				overflow: 'visible',
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
 
 var qTable = $('#clinic_table').dataTable(); 
  qTable.fnSetColumnVis( 0, false );  // Hide the first column after initialisation
  qTable.fnSetColumnVis( 1, false );   // Hide the second column after initialisation
		
/*----------------------------------START Family dataeditable ---------------------------------------------------------*/
$('#family_table').dataTable( {	       		

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
			
				
     } ).makeEditable({
		 
		 aoTableActions: [
								{
								 sAction: "EditFamily",
								 sAddNewRowFormId:  "formEditFamily",
								 sAddNewRowOkButtonId: "formEditFamilyOk",
								 sAddNewRowCancelButtonId: "formEditFamilyCancel",
								 sServerActionURL: "ajax_family_update.php",
								 oFormOptions: { 
								 autoOpen: false, 
								 modal: true,
								 resizable: false,
				                 draggable: true, 
								 width:'auto',
								 height:'auto',
								 position: { my: "top", at: "centre", of: window }	
								  }
								}
						], 
		 
		 
		 
		sAddURL:           "ajax_family_add.php",
        sDeleteURL:        "ajax_family_delete.php",
		sUpdateURL:        "ajax_family_update.php",
		
		sAddNewRowFormId:  "formNewFamily",			
		sAddNewRowButtonId: "btnAddNewRow2",
		sDeleteRowButtonId: "btnDeleteRow2",
		sAddNewRowOkButtonId: "btnAddNewRowOk2",
		sAddNewRowCancelButtonId: "btnAddNewRowCancel2",		
		
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
				title: 'Add Dear ones info',
				resizable: false,
				draggable: true, 
				modal: true,
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
						//window.location.reload();
						
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
 
 var oTable = $('#family_table').dataTable(); 
  oTable.fnSetColumnVis( 0, false );  // Hide the first column after initialisation
  oTable.fnSetColumnVis( 1, false );   // Hide the second column after initialisation
  
  
  $('emp_submit').submit(function(e){
e.preventDefault();
});
 


event.preventDefault();
}); 