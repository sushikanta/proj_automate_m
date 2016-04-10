	$(document).ready(function() {

/*-------------------------------------------- START Autocomplete Permanent State/District/Pin -----------------------------------*/    		
		$('#permanent_state').autocomplete({
		  source:'autocomplete_state.php', 
		  minLength:1,
		  focus: function( event, ui ) {
				  $( "#permanent_state" ).val(ui.item.label);
				  return false; },
		  change: function (event, ui){   
					if (ui.item == null) 
					  { $('#hidden_permanent_state').val("");
						return false; }
				   else
					  { $('#hidden_permanent_state').val(ui.item.state_id);
					  return false; } }
		});
	
		$("#permanent_district").autocomplete({    
          source: function(request, response) {
          $.ajax({
						 url: "autocomplete_district.php",
					dataType: "json",
						data: { term: request.term,
								state: $("#hidden_permanent_state").val() },
					 success: function(data) { response(data); }
				}); },
		  focus: function( event, ui ) {
                  $( "#permanent_district").val(ui.item.label);
                  return false; },
		 change: function (event, ui){   
				  if (ui.item == null) 
				     { $('#hidden_permanent_district').val("");
					   return false; }
				  else 
				     { $('#hidden_permanent_district').val(ui.item.district_id);
					   return false; } }
        });  

	
/*-------------------------------------------- START Autocomplete for Present State/District/Pin -----------------------------------*/    		
		$('#present_state').autocomplete({
		  source:'autocomplete_state.php', 
		  minLength:1,
		  focus: function( event, ui ) {
				  $( "#present_state" ).val(ui.item.label);
				  return false; },
		  change: function (event, ui){   
					if (ui.item == null) 
					  { $('#hidden_present_state').val("");
						return false; }
				   else
					  { $('#hidden_present_state').val(ui.item.state_id);
					  return false; } }
		});
		  

		$("#present_district").autocomplete({    
          source: function(request, response) {
          $.ajax({
						 url: "autocomplete_district.php",
					dataType: "json",
						data: { term: request.term,
								state: $("#hidden_present_state").val() },
					 success: function(data) { response(data); }
				}); },
		  focus: function( event, ui ) {
                  $( "#present_district").val(ui.item.label);
                  return false; },
		 change: function (event, ui){   
				  if (ui.item == null) 
				     { $('#hidden_present_district').val("");
					   return false; }
				  else 
				     { $('#hidden_present_district').val(ui.item.district_id);
					   return false; } }
        });  
		

/* -------------SHOW/HIDE on click/unclick--------------*/
	
	  if($('#same_address_yes').is(':checked'))  
			{ $('#presentAddress_div').hide(); }
	   else { $('#presentAddress_div').show(); } 			
				  
	  $("#same_address_yes, #same_address_no").click(function () {
			if( $('input[name=same_address][value=1]').prop("checked")) {
				$('#presentAddress_div').hide(); }
	  else if ( $('input[name=same_address][value=2]').prop("checked")) {
				$('#presentAddress_div').show(); }	 
		});
	  
	  
	/* -------------SHOW/HIDE on Select/unselect of Marital status --------------*/
	
		  if ($('#emp_marital option:eq(0)').prop('selected'))
				{  
				  $('#spause_span').hide();
				  $('#motherFather_span').show();		
				}
				
			 
			// 1 - single
			if ($('#emp_marital option:eq(1)').prop('selected'))
				{ $('#spause_span').hide(); 
				  $('#motherFather_span').show();
				  }
			
			// 2 -  Married
			if ($('#emp_marital option:eq(2)').prop('selected'))
				{ $('#spause_span').show(); 
				  $('#motherFather_span').hide(); }
			
			// 3 -divorcee
			if ($('#emp_marital option:eq(3)').prop('selected'))
				{ $('#spause_span').hide(); 
				  $('#motherFather_span').show(); }
		   
			// 4 - widow
			if ($('#emp_marital option:eq(4)').prop('selected'))
				{ $('#spause_span').show();
				  $('#motherFather_span').hide(); }
				  
			 // 5 - widower
			if ($('#emp_marital option:eq(5)').prop('selected'))
				{ $('#spause_span').show();
				  $('#motherFather_span').hide(); }
			 
		  
		  //On change function 	   
		  $('#emp_marital').change(function() {	
				  
			//No Select at marital box		
			if ($('#emp_marital option:eq(0)').prop('selected'))					
				{ 
				
				$('#spause_span').hide();
				  $('#motherFather_span').show();	}
			 
			// 1 - single
			if ($('#emp_marital option:eq(1)').prop('selected'))
				{ $('#spause_span').hide(); 
				  $('#motherFather_span').show();
				  }
			
			// 2 -  Married
			if ($('#emp_marital option:eq(2)').prop('selected'))
				{ $('#spause_span').show(); 
				  $('#motherFather_span').hide(); }
			
			// 3 -divorcee
			if ($('#emp_marital option:eq(3)').prop('selected'))
				{ $('#spause_span').hide(); 
				  $('#motherFather_span').show(); }
		   
			// 4 - widow
			if ($('#emp_marital option:eq(4)').prop('selected'))
				{ $('#spause_span').show();
				  $('#motherFather_span').hide(); }
				  
			 // 5 - widower
			if ($('#emp_marital option:eq(5)').prop('selected'))
				{ $('#spause_span').show();
				  $('#motherFather_span').hide(); }
			 
		  }) 

 
	  
	  
	  
$( "#emp_dob" ).removeClass('hasDatepicker').datepicker({   // Employee date of birth
		changeMonth: true,
		changeYear: true,
		yearRange: "-100:+0", // Setting yearRange of 100 years ago
		dateFormat: "dd-M-yy",
		});

$( "#emp_joining_date" ).removeClass('hasDatepicker').datepicker({   //family member date of birth
		changeMonth: true,
		changeYear: true,
		yearRange: "-10:+0", // Setting yearRange of 10 years ago
		dateFormat: "dd-M-yy",
		});

$('#qualf_table').dataTable( {	

        "bJQueryUI": true,
		"bPaginate": false,
		"bProcessing": true,
        "bStateSave": true,
		"bBootstrap": true,
		"bFilter":false,
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
				 resizable: false,
				                 draggable: true, 
								 width:'auto',
								 height:'auto',
								 backdrop: 'static',
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


    } );
	
  var qTable = $('#qualf_table').dataTable(); 
  qTable.fnSetColumnVis( 0, false );  // Hide the first column after initialisation
  qTable.fnSetColumnVis( 1, false );   // Hide the second column after initialisation
		
	$('#exp_table').dataTable( {	       		

        "bJQueryUI": true,
		"bPaginate": false,
		"bProcessing": true,
        "bStateSave": true,
		"bBootstrap": true,
		"bAutoWidth": false,
		"bFilter":false,
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
			
				
     } ).makeEditable({
		 
		 
		 aoTableActions: [
								{
								 sAction: "ExpEdit",
								 sServerActionURL: "ajax_exper_update.php",
								 oFormOptions: { 
								 autoOpen: false, 
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
				title: 'Add new experience',
				autoOpen: false,
				modal: true,
				 resizable: false,
				                 draggable: true, 
								 width:'auto',
								 height:'auto',
								 backdrop: 'static',
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
                                $("#lblAddError2").html(message);
                                $("#lblAddError2").show();
                                break;
                        }
                    },
                    fnStartProcessingMode: function () {
                        $("#processing_message2").dialog();
						
                    },
                    fnEndProcessingMode: function () {
                        $("#processing_message2").dialog("close");    
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
				
    } );
 
 var oTable = $('#exp_table').dataTable(); 
  oTable.fnSetColumnVis( 0, false );  // Hide the first column after initialisation
  oTable.fnSetColumnVis( 1, false );   // Hide the second column after initialisation
  

$( "#emp_joining_date" ).removeClass('hasDatepicker').datepicker({   //family member date of birth
		changeMonth: true,
		changeYear: true,
		yearRange: "-5:+0", // Setting yearRange of 100 years ago
		dateFormat: "dd-mm-yy",
		});


$("#joined_date, #last_date" ).removeClass('hasDatepicker').datepicker({   // for new record
changeMonth: true,
changeYear: true,
yearRange: "-50:+0", // Setting yearRange of 10 years ago
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
yearRange: "-50:+0", // Setting yearRange of 10 years ago
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
		
/*----------------------Start LETTER---------------------------------------*/	
		
	$('#letter_table').dataTable( {        

		"bJQueryUI": true,
		"bPaginate": false,
		"bProcessing": true,
        "bStateSave": true,
		"bBootstrap": true,
		"bAutoWidth": false,
		"bFilter":false,
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
			
				
     } ).makeEditable({
		 
		 aoTableActions: [
								{
								 sAction: "EditLetter",
								 sServerActionURL: "ajax_emp_letter_update.php",
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
		 
		sAddURL:              "ajax_emp_letter_add.php",
        sDeleteURL:           "ajax_emp_letter_delete.php",
		sUpdateURL:           "ajax_emp_letter_update.php",
		
		sAddNewRowFormId:     "formNewLetter",
		sAddNewRowButtonId: "btnAddNewRow3",
		sDeleteRowButtonId: "btnDeleteRow3",
		sAddNewRowOkButtonId: "btnAddNewRowOk3",
		sAddNewRowCancelButtonId: "btnAddNewRowCancel3",
		   
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
				label: "Close",
				class: "back-class",
				name: "action",
				value: "cancel-add",
				icons: { primary: 'ui-icon-close' }
				},
        oAddNewRowFormOptions: {
				title: 'Add new Department',
				autoOpen: false,
				modal: true,
				resizable: false,
				draggable: true,
				hide: 'fade', 
				width:'auto',
				height:'auto',	
				cssclass: 'required',
				}, 
		
	
		aoColumns: [
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
		});
		

$( "#letter_date, #letter_date_edit" ).removeClass('hasDatepicker').datepicker({   // Employee date of birth
changeMonth: true,
changeYear: true,
yearRange: "-5:+0", // Setting yearRange of 5 years ago
dateFormat: "dd-M-yy",
});		


var uTable = $('#letter_table').dataTable(); 
    uTable.fnSetColumnVis( 0, false );  // Hide the first column after initialisation
    uTable.fnSetColumnVis( 1, false );   // Hide the 2nd column after initialisation
    //oTable.fnSetColumnVis( 3, false );   // Hide the fourth column after initialisation	
		
		
	});