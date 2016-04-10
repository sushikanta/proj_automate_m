$(document).ready(function() {

  // OFFICIAL
  $('#office_tbl').dataTable( {

        "bJQueryUI": true,
		"bPaginate": false,
		"bFilter": false,
		"bInfo": false,
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
		  $('.dataTables_length select').css('float', 'left');
		  }

     }).makeEditable({

       // sAddURL:              "emp_family_ajax_add.php",
       // sDeleteURL:           "emp_family_ajax_del.php",
		sUpdateURL: 		   "emp_official_ajax_edit.php",

		sAddNewRowFormId:     "formOffice",
		sAddNewRowButtonId: "btnAddNewRowO",
		sDeleteRowButtonId: "btnDeleteRowO",
		//sAddDeleteToolbarSelector: ".dataTables_length",


		aoColumns: [
					null,
					{
					  tooltip: 'Click to update price',
					  loadtext: 'loading...',
					  indicator: 'saving...',
					  type: 'text',
					  onblur: 'cancel',
					  submit: 'ok',
					  event: 'click',
					  width: '50%',

					},
					{

					  tooltip: 'Click to update Designation',
					  loadtext: 'loading...',
					  indicator: 'saving...',
					  cssclass: 'required',
					  width: '80%',
					  bAutoWidth: false,
					  type: 'select',
					  onblur: 'cancel',
					  submit: 'ok',
					  event: 'click',
     				  loadurl: "emp_position_list_ajax.php",
					},
					{

					  tooltip: 'Click to update Department',
					  loadtext: 'loading...',
					  indicator: 'saving...',
					  cssclass: 'required',
					  width: '80%',
					  bAutoWidth: false,
					  type: 'select',
					  onblur: 'cancel',
					  submit: 'ok',
					  event: 'click',
     				  loadurl: "emp_department_list_ajax.php",
					},
					{

					  tooltip: 'Click to update Reporting position',
					  loadtext: 'loading...',
					  indicator: 'saving...',
					  cssclass: 'required',
					  width: '80%',
					  bAutoWidth: false,
					  type: 'select',
					  onblur: 'cancel',
					  submit: 'ok',
					  event: 'click',
     				  loadurl: "emp_position_list_ajax.php",
					},

					{
					  tooltip: 'Click to update JOined date',
					  loadtext: 'loading...',
					  indicator: 'saving...',
					  type: 'text',
					  onblur: 'cancel',
					  submit: 'ok',
					  event: 'click',
					  width: '50%',
					  oValidationOptions :
										   {     rules:{ value: { required: true, date: true } },
											 messages: { value: {  } }
		                                   },

					},

					{
					  tooltip: 'Click to update Salary',
					  loadtext: 'loading...',
					  indicator: 'saving...',
					  type: 'text',
					  onblur: 'cancel',
					  submit: 'ok',
					  event: 'click',
					  width: '50%',
					  oValidationOptions :
										   {     rules:{ value: { required: true, number: true, minlength: 1 } },
											 messages: { value: { minlength: "Min. 1 Number" } }
		                                   },

					},
					{
					  tooltip: 'Click to update Annual CTC',
					  loadtext: 'loading...',
					  indicator: 'saving...',
					  type: 'text',
					  onblur: 'cancel',
					  submit: 'ok',
					  event: 'click',
					  width: '50%',
					  oValidationOptions :
										   {     rules:{ value: { required: true, number: true, minlength: 1 } },
											 messages: { value: { minlength: "Min. 1 Number" } }
		                                   },

					},
					null,
					/*{
					  tooltip: 'Click to update Status',
					  indicator: 'saving...',
					  loadtext: 'loading...',
							cssclass: 'required',
							width: '50%',
							type: 'select',
							onblur: 'cancel',
							submit: 'ok',
							event: 'click',
							data: "{'1':'Active','2':'Relieved'}",
							},*/

				  ],
    });

  // FAMILY
  $('#family_tbl').dataTable( {

        "bJQueryUI": true,
		"bPaginate": false,
		"bFilter": false,
		"bInfo": false,
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
		  $('.dataTables_length select').css('float', 'left');
		  }

     }).makeEditable({

        sAddURL:              "emp_family_ajax_add.php",
        sDeleteURL:           "emp_family_ajax_del.php",
		sUpdateURL: 		   "emp_family_ajax_edit.php",

		sAddNewRowFormId:     "formFamily",
		sAddNewRowButtonId: "btnAddNewRowF",
		sDeleteRowButtonId: "btnDeleteRowF",
		//sAddDeleteToolbarSelector: ".dataTables_length",

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
				resizable: false,
				draggable: false,
				autoOpen: false,
				modal: true,
				width: '45%',
				maxHeight: 550,
				cssclass: 'required',
				overflow: 'scroll',
				minimalTopSpacingOfModalbox: 40,
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
								// window.location.reload();
                                break;
                            case "delete":
                                jAlert(message, "Delete failed");
								// window.location.reload();
                                break;
                            case "add":
                                jAlert(message, "Delete failed");
                                break;
                        }
                    },
                    fnStartProcessingMode: function () {
                        $("#processing_messageF").dialog();

                    },
                    fnEndProcessingMode: function () {
                        $("#processing_messageF").dialog("close");
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

 // QUALIFICATION
  $('#qualf_tbl').dataTable( {

        "bJQueryUI": true,
		"bPaginate": false,
		"bFilter": false,
		"bInfo": false,
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
		  $('.dataTables_length select').css('float', 'left');
		  }

     }).makeEditable({

        sAddURL:              "emp_qualf_ajax_add.php",
        sDeleteURL:           "emp_qualf_ajax_del.php",
		//sUpdateURL: 		   "emp_family_ajax_edit.php",

		sAddNewRowFormId:     "formQualf",
		sAddNewRowButtonId: "btnAddNewRowQ",
		sDeleteRowButtonId: "btnDeleteRowQ",
		sAddNewRowOkButtonId: "btnAddNewRowOkQ",
		sAddNewRowCancelButtonId: "btnAddNewRowCancelQ",
		//sAddDeleteToolbarSelector: ".dataTables_length",

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
				resizable: false,
				draggable: false,
				autoOpen: false,
				modal: true,
				width: '55%',
				maxHeight: 550,
				cssclass: 'required',
				overflow: 'scroll',
				minimalTopSpacingOfModalbox: 40,
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
							//	window.location.reload();
                                break;
                            case "delete":
                                jAlert(message, "Delete failed");
							//	window.location.reload();
                                break;
                            case "add":
                               jAlert(message, "Delete failed");
							//	window.location.reload();
                                break;
                        }
                    },
                    fnStartProcessingMode: function () {
                        $("#processing_messageQ").dialog();

                    },
                    fnEndProcessingMode: function () {
                        $("#processing_messageQ").dialog("close");
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


	// EXPERIENCE
  $('#exp_tbl').dataTable( {

        "bJQueryUI": true,
		"bPaginate": false,
		"bFilter": false,
		"bInfo": false,
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
		  $('.dataTables_length select').css('float', 'left');
		  }

     }).makeEditable({

        sAddURL:              "emp_exp_ajax_add.php",
        sDeleteURL:           "emp_exp_ajax_del.php",
		//sUpdateURL: 		   "emp_family_ajax_edit.php",

		sAddNewRowFormId:     "formExp",
		sAddNewRowButtonId: "btnAddNewRowE",
		sDeleteRowButtonId: "btnDeleteRowE",
		sAddNewRowOkButtonId: "btnAddNewRowOkE",
		sAddNewRowCancelButtonId: "btnAddNewRowCancelE",
		//sAddDeleteToolbarSelector: ".dataTables_length",

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
				resizable: false,
				draggable: false,
				autoOpen: false,
				modal: true,
				width: '55%',
				maxHeight: 550,
				cssclass: 'required',
				overflow: 'scroll',
				minimalTopSpacingOfModalbox: 40,
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
							//	window.location.reload();
                                break;
                            case "delete":
                                jAlert(message, "Delete failed");
							//	window.location.reload();
                                break;
                            case "add":
                               jAlert(message, "Delete failed");
							//	window.location.reload();
                                break;
                        }
                    },
                    fnStartProcessingMode: function () {
                        $("#processing_messageQ").dialog();

                    },
                    fnEndProcessingMode: function () {
                        $("#processing_messageQ").dialog("close");
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


	// letter SENT
  $('#letter_tbl').dataTable( {

        "bJQueryUI": true,
		"bPaginate": false,
		"bFilter": false,
		"bInfo": false,
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
		  $('.dataTables_length select').css('float', 'left');
		  }

     }).makeEditable({

        sAddURL:              "emp_letter_ajax_add.php",
        sDeleteURL:           "emp_letter_ajax_del.php",
		//sUpdateURL: 		   "emp_family_ajax_edit.php",

		sAddNewRowFormId:     "formLetter",
		sAddNewRowButtonId: "btnAddNewRowL",
		sDeleteRowButtonId: "btnDeleteRowL",
		sAddNewRowOkButtonId: "btnAddNewRowOkL",
		sAddNewRowCancelButtonId: "btnAddNewRowCancelL",
		//sAddDeleteToolbarSelector: ".dataTables_length",

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
				resizable: false,
				draggable: false,
				autoOpen: false,
				modal: true,
				width: '55%',
				maxHeight: 550,
				cssclass: 'required',
				overflow: 'scroll',
				minimalTopSpacingOfModalbox: 40,
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
							//	window.location.reload();
                                break;
                            case "delete":
                                jAlert(message, "Delete failed");
							//	window.location.reload();
                                break;
                            case "add":
                                jAlert(message, "Delete failed");
							//	window.location.reload();
                                break;
                        }
                    },
                    fnStartProcessingMode: function () {
                        $("#processing_messageQ").dialog();

                    },
                    fnEndProcessingMode: function () {
                        $("#processing_messageQ").dialog("close");
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



	// letter SENT
  $('#exit_tbl').dataTable( {

        "bJQueryUI": true,
		"bPaginate": false,
		"bFilter": false,
		"bInfo": false,
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
		  $('.dataTables_length select').css('float', 'left');
		  }

     }).makeEditable({

        sAddURL:              "emp_exit_ajax_add.php",
        sDeleteURL:           "emp_exit_ajax_del.php",
		//sUpdateURL: 		   "emp_family_ajax_edit.php",

		sAddNewRowFormId:     "formExit",
		sAddNewRowButtonId: "btnAddNewRowX",
		sDeleteRowButtonId: "btnDeleteRowX",
		sAddNewRowOkButtonId: "btnAddNewRowOkX",
		sAddNewRowCancelButtonId: "btnAddNewRowCancelX",
		//sAddDeleteToolbarSelector: ".dataTables_length",

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
				resizable: false,
				draggable: false,
				autoOpen: false,
				modal: true,
				width: '55%',
				maxHeight: 550,
				cssclass: 'required',
				overflow: 'scroll',
				minimalTopSpacingOfModalbox: 40,
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
							//	window.location.reload();
                                break;
                            case "delete":
                                jAlert(message, "Delete failed");
							//	window.location.reload();
                                break;
                            case "add":
                                jAlert(message, "Delete failed");
							//	window.location.reload();
                                break;
                        }
                    },
                    fnStartProcessingMode: function () {
                        $("#processing_messageQ").dialog();

                    },
                    fnEndProcessingMode: function () {
                        $("#processing_messageQ").dialog("close");
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




// datepicker - DATE
	$( "#fdob" ).removeClass('hasDatepicker').datepicker({   //family member date of birth
		changeMonth: true,
		changeYear: true,
		yearRange: "-100:+0", // Setting yearRange of 100 years ago
		dateFormat: "dd-mm-yy",
		});
	$( "#passing_date, #exit_date, #join_date" ).removeClass('hasDatepicker').datepicker({   //family member date of birth
		changeMonth: true,
		changeYear: true,
		yearRange: "-20:+0", // Setting yearRange of 100 years ago
		dateFormat: "dd-mm-yy",
		});

	$( "#sent_date, #relieve_date" ).removeClass('hasDatepicker').datepicker({   //family member date of birth
		changeMonth: true,
		changeYear: true,
		yearRange: "-5:+0", // Setting yearRange of 100 years ago
		dateFormat: "dd-mm-yy",
		});



// VALIDATION - FAMILY
$("#formFamily").validate({
	ignore: "",
	onkeyup: true,
	onblur: true,
rules: {
	relation: {required: true},
	name: {required: true},
	occupation: {required: true},
	fdob:{required: true},
},
 	highlight: function(element) {
        $(element).parents('div.form-control-group').removeClass('has-success');
        $(element).parents('div.form-control-group').addClass('has-error');
    },
    unhighlight: function(element) {
        $(element).parents('div.form-control-group').removeClass('has-error');
        $(element).parents('div.form-control-group').addClass('has-success');
    }

});

// VALIDATION - QUALIFICATION
$("#formQualf").validate({
	ignore: "",
	onkeyup: true,
	onblur: true,
rules: {
	course: {required: true},
	faculty: {required: true},
	university: {required: true},
	institute: {required: true},
	mark_obt: {required: true, digits: true},
	total_mark: {required: true, digits: true},
	grade: {required: true},
	result: {required: true},
	duration_y: {required: true, digits: true},
	duration_m: {required: true, digits: true},
},
 	highlight: function(element) {
        $(element).parents('div.form-control-group').removeClass('has-success');
        $(element).parents('div.form-control-group').addClass('has-error');
    },
    unhighlight: function(element) {
        $(element).parents('div.form-control-group').removeClass('has-error');
        $(element).parents('div.form-control-group').addClass('has-success');
    }
});




});

